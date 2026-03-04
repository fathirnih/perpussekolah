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
        $tingkat = ['X', 'XI', 'XII'];
        $basis = ['RPL 1', 'RPL 2', 'TKJ 1', 'TKJ 2', 'DKV 1', 'DKV 2', 'DKV 3', 'PSPT'];

        $daftarKelas = [];
        foreach ($tingkat as $level) {
            foreach ($basis as $nama) {
                $daftarKelas[] = $level . ' ' . $nama;
            }
        }

        foreach ($daftarKelas as $namaKelas) {
            Kelas::query()->updateOrCreate(
                ['nama_kelas' => $namaKelas],
                ['nama_kelas' => $namaKelas]
            );
        }

        $kelasValid = Kelas::query()->whereIn('nama_kelas', $daftarKelas)->pluck('id');
        $kelasDefaultId = Kelas::query()->where('nama_kelas', 'X RPL 1')->value('id');

        if ($kelasDefaultId) {
            \App\Models\Siswa::query()
                ->where(function ($query) use ($kelasValid) {
                    $query->whereNull('kelas_id')
                        ->orWhereNotIn('kelas_id', $kelasValid);
                })
                ->update(['kelas_id' => $kelasDefaultId]);
        }

        Kelas::query()->whereNotIn('nama_kelas', $daftarKelas)->delete();
    }
}
