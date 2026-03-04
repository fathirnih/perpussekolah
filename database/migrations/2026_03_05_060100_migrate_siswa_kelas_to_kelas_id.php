<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('siswa') || ! Schema::hasTable('kelas')) {
            return;
        }

        Schema::table('siswa', function (Blueprint $table) {
            if (! Schema::hasColumn('siswa', 'kelas_id')) {
                $table->unsignedBigInteger('kelas_id')->nullable()->after('nama');
            }
        });

        if (Schema::hasColumn('siswa', 'kelas')) {
            $nilaiKelas = DB::table('siswa')
                ->whereNotNull('kelas')
                ->where('kelas', '!=', '')
                ->distinct()
                ->pluck('kelas');

            foreach ($nilaiKelas as $namaKelas) {
                $kelasId = DB::table('kelas')->where('nama_kelas', $namaKelas)->value('id');
                if (! $kelasId) {
                    $kelasId = DB::table('kelas')->insertGetId([
                        'nama_kelas' => $namaKelas,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('siswa')
                    ->where('kelas', $namaKelas)
                    ->update(['kelas_id' => $kelasId]);
            }
        }

        Schema::table('siswa', function (Blueprint $table) {
            if (Schema::hasColumn('siswa', 'kelas')) {
                $table->dropColumn('kelas');
            }
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->foreign('kelas_id')->references('id')->on('kelas')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('siswa')) {
            return;
        }

        Schema::table('siswa', function (Blueprint $table) {
            if (! Schema::hasColumn('siswa', 'kelas')) {
                $table->string('kelas')->nullable()->after('nama');
            }
        });

        if (Schema::hasTable('kelas') && Schema::hasColumn('siswa', 'kelas_id')) {
            $baris = DB::table('siswa')
                ->leftJoin('kelas', 'kelas.id', '=', 'siswa.kelas_id')
                ->select('siswa.id as siswa_id', 'kelas.nama_kelas')
                ->get();

            foreach ($baris as $item) {
                DB::table('siswa')
                    ->where('id', $item->siswa_id)
                    ->update(['kelas' => $item->nama_kelas ?? null]);
            }
        }

        Schema::table('siswa', function (Blueprint $table) {
            if (Schema::hasColumn('siswa', 'kelas_id')) {
                $table->dropForeign(['kelas_id']);
                $table->dropColumn('kelas_id');
            }
        });
    }
};

