<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->foreign('kategori_buku_id')->references('id')->on('kategori_buku')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('rak_id')->references('id')->on('rak')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->foreign('siswa_id')->references('id')->on('siswa')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('petugas_id')->references('id')->on('petugas')->cascadeOnUpdate()->nullOnDelete();
        });

        Schema::table('detail_peminjaman', function (Blueprint $table) {
            $table->foreign('peminjaman_id')->references('id')->on('peminjaman')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('buku_id')->references('id')->on('buku')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_peminjaman', function (Blueprint $table) {
            $table->dropForeign(['peminjaman_id']);
            $table->dropForeign(['buku_id']);
        });

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['petugas_id']);
        });

        Schema::table('buku', function (Blueprint $table) {
            $table->dropForeign(['kategori_buku_id']);
            $table->dropForeign(['rak_id']);
        });
    }
};
