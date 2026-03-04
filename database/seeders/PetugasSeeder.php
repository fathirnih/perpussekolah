<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Petugas::updateOrCreate(
            ['email' => 'petugas@perpus.test'],
            [
                'nama' => 'Petugas Perpustakaan',
                'password' => 'password',
                'no_hp' => '081234567890',
                'alamat' => 'Ruang Perpustakaan Sekolah',
            ]
        );
    }
}
