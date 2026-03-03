<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::updateOrCreate(
            ['nisn' => '1234567890'],
            [
                'nama' => 'Siswa Contoh',
                'kelas' => '10-A',
                'email' => 'siswa@perpus.test',
                'password' => 'password',
                'is_registered' => true,
                'no_hp' => '081298765432',
                'alamat' => 'Alamat Siswa',
            ]
        );
    }
}
