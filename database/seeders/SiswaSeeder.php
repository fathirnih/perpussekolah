<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = Kelas::query()->where('nama_kelas', 'X RPL 1')->first();
        if (! $kelas) {
            $kelas = Kelas::query()->create(['nama_kelas' => 'X RPL 1']);
        }

        Siswa::updateOrCreate(
            ['nisn' => '1234567890'],
            [
                'nama' => 'Siswa Contoh',
                'kelas_id' => $kelas->id,
                'email' => 'siswa@perpus.test',
                'password' => 'password',
                'is_registered' => true,
                'no_hp' => '081298765432',
                'alamat' => 'Alamat Siswa',
            ]
        );
    }
}
