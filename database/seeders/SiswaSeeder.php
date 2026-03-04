<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasList = Kelas::query()
            ->orderBy('nama_kelas')
            ->get(['id', 'nama_kelas']);

        if ($kelasList->isEmpty()) {
            return;
        }

        DB::transaction(function () use ($kelasList): void {
            DB::table('detail_peminjaman')->delete();
            DB::table('peminjaman')->delete();
            Siswa::query()->delete();

            $nomorNisn = 2300001;

            foreach ($kelasList as $kelas) {
                for ($urutan = 1; $urutan <= 25; $urutan++) {
                    Siswa::query()->create([
                        'nisn' => (string) $nomorNisn,
                        'nama' => 'Siswa ' . $kelas->nama_kelas . ' ' . str_pad((string) $urutan, 2, '0', STR_PAD_LEFT),
                        'kelas_id' => $kelas->id,
                        'email' => null,
                        'password' => 'password',
                        'is_registered' => false,
                        'no_hp' => null,
                        'alamat' => null,
                    ]);

                    $nomorNisn++;
                }
            }
        });
    }
}
