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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 10)->unique();
            $table->string('nama');
            $table->string('kelas');
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->boolean('is_registered')->default(false);
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
