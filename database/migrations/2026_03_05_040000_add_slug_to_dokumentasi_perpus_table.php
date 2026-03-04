<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dokumentasi_perpus', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('judul');
        });

        $used = [];
        $rows = DB::table('dokumentasi_perpus')->select('id', 'judul')->get();

        foreach ($rows as $row) {
            $base = Str::slug((string) $row->judul);
            $baseSlug = $base !== '' ? $base : 'dokumentasi-' . $row->id;
            $slug = $baseSlug;
            $counter = 1;

            while (in_array($slug, $used, true) || DB::table('dokumentasi_perpus')->where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            DB::table('dokumentasi_perpus')->where('id', $row->id)->update(['slug' => $slug]);
            $used[] = $slug;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumentasi_perpus', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
