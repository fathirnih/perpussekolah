<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftarKelas = [
            'X RPL 1',
            'X RPL 2',
            'X TKJ 1',
            'XI RPL 1',
            'XI TKJ 1',
            'XII RPL 1',
        ];

        foreach ($daftarKelas as $namaKelas) {
            Kelas::updateOrCreate(
                ['nama_kelas' => $namaKelas],
                ['nama_kelas' => $namaKelas]
            );
        }
    }
}

