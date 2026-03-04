<?php

namespace Database\Seeders;

use App\Models\Rak;
use Illuminate\Database\Seeder;

class RakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rakList = [
            ['nomor_rak' => 'A1', 'keterangan' => 'Rak Buku Pelajaran'],
            ['nomor_rak' => 'A2', 'keterangan' => 'Rak Buku Referensi'],
            ['nomor_rak' => 'B1', 'keterangan' => 'Rak Buku Fiksi'],
            ['nomor_rak' => 'B2', 'keterangan' => 'Rak Buku Nonfiksi'],
            ['nomor_rak' => 'C1', 'keterangan' => 'Rak Buku Keagamaan'],
            ['nomor_rak' => 'C2', 'keterangan' => 'Rak Majalah dan Koran'],
        ];

        foreach ($rakList as $rak) {
            Rak::updateOrCreate(
                ['nomor_rak' => $rak['nomor_rak']],
                ['keterangan' => $rak['keterangan']]
            );
        }
    }
}
