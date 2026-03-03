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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku')->unique();
            $table->string('isbn')->nullable();
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit')->nullable();
            $table->unsignedSmallInteger('tahun_terbit')->nullable();
            $table->unsignedBigInteger('kategori_buku_id');
            $table->unsignedBigInteger('rak_id');
            $table->unsignedInteger('stok_total')->default(0);
            $table->unsignedInteger('stok_tersedia')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
