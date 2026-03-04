<?php

namespace Database\Seeders;

use App\Models\KategoriBuku;
use Illuminate\Database\Seeder;

class KategoriBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriList = [
            [
                'nama_kategori' => 'Buku Pelajaran',
                'keterangan' => 'Buku sesuai kurikulum (Matematika, Bahasa Indonesia, IPA, IPS, dan lainnya) untuk belajar di kelas.',
            ],
            [
                'nama_kategori' => 'Buku Referensi',
                'keterangan' => 'Kamus, ensiklopedia, atlas, dan teori tambahan. Umumnya dibaca di tempat.',
            ],
            [
                'nama_kategori' => 'Buku Fiksi',
                'keterangan' => 'Novel remaja, cerpen, komik edukatif, dan dongeng untuk hiburan serta minat baca.',
            ],
            [
                'nama_kategori' => 'Buku Nonfiksi',
                'keterangan' => 'Biografi, motivasi, sejarah, dan sains populer.',
            ],
            [
                'nama_kategori' => 'Buku Keagamaan',
                'keterangan' => 'Al-Quran dan tafsir, fiqih, akhlak, serta buku agama lain sesuai kebutuhan sekolah.',
            ],
            [
                'nama_kategori' => 'Majalah & Koran',
                'keterangan' => 'Majalah pendidikan dan koran harian, biasanya edisi terbaru.',
            ],
        ];

        foreach ($kategoriList as $kategori) {
            KategoriBuku::updateOrCreate(
                ['nama_kategori' => $kategori['nama_kategori']],
                ['keterangan' => $kategori['keterangan']]
            );
        }
    }
}
