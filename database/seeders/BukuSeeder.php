<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Rak;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriByNama = KategoriBuku::query()->get()->keyBy('nama_kategori');
        $rakByNomor = Rak::query()->get()->keyBy('nomor_rak');

        $bukuList = [
            [
                'kode_buku' => 'PEL-001',
                'judul' => 'Matematika Kelas X',
                'sinopsis' => 'Buku pelajaran Matematika untuk kelas X yang membahas konsep dasar aljabar, persamaan, fungsi, dan penerapannya dalam soal kontekstual.',
                'penulis' => 'Tim MGMP Matematika',
                'penerbit' => 'Pustaka Edukasi',
                'tahun_terbit' => 2024,
                'kategori' => 'Buku Pelajaran',
                'rak' => 'A1',
                'stok_total' => 10,
                'stok_tersedia' => 10,
            ],
            [
                'kode_buku' => 'PEL-002',
                'judul' => 'Bahasa Indonesia Kelas X',
                'sinopsis' => 'Materi Bahasa Indonesia kelas X meliputi teks deskripsi, eksposisi, argumentasi, serta latihan literasi untuk meningkatkan kemampuan menulis dan membaca kritis.',
                'penulis' => 'Rina Pratiwi',
                'penerbit' => 'Nusantara Belajar',
                'tahun_terbit' => 2023,
                'kategori' => 'Buku Pelajaran',
                'rak' => 'A1',
                'stok_total' => 8,
                'stok_tersedia' => 8,
            ],
            [
                'kode_buku' => 'REF-001',
                'judul' => 'Kamus Besar Bahasa Indonesia Ringkas',
                'sinopsis' => 'Kamus ringkas berisi kosakata umum bahasa Indonesia beserta makna dan contoh penggunaannya untuk membantu kegiatan belajar harian.',
                'penulis' => 'Tim Bahasa Nasional',
                'penerbit' => 'Bahasa Kita',
                'tahun_terbit' => 2022,
                'kategori' => 'Buku Referensi',
                'rak' => 'A2',
                'stok_total' => 4,
                'stok_tersedia' => 4,
            ],
            [
                'kode_buku' => 'REF-002',
                'judul' => 'Atlas Pelajar Indonesia dan Dunia',
                'sinopsis' => 'Atlas pelajar yang menyajikan peta wilayah Indonesia dan dunia, lengkap dengan informasi geografis dasar untuk pendukung pelajaran IPS dan geografi.',
                'penulis' => 'Andi Geografi',
                'penerbit' => 'Peta Ilmu',
                'tahun_terbit' => 2021,
                'kategori' => 'Buku Referensi',
                'rak' => 'A2',
                'stok_total' => 3,
                'stok_tersedia' => 3,
            ],
            [
                'kode_buku' => 'FIK-001',
                'judul' => 'Petualangan di Ujung Senja',
                'sinopsis' => 'Novel remaja tentang persahabatan dan keberanian menghadapi perubahan hidup melalui perjalanan ke desa pegunungan yang penuh kejutan.',
                'penulis' => 'Dewi Laras',
                'penerbit' => 'Bintang Remaja',
                'tahun_terbit' => 2020,
                'kategori' => 'Buku Fiksi',
                'rak' => 'B1',
                'stok_total' => 6,
                'stok_tersedia' => 6,
            ],
            [
                'kode_buku' => 'FIK-002',
                'judul' => 'Komik Sains Cerdas',
                'sinopsis' => 'Komik edukatif yang mengenalkan konsep sains sederhana melalui cerita ringan dan ilustrasi menarik agar siswa lebih mudah memahami materi.',
                'penulis' => 'Yusuf Mahendra',
                'penerbit' => 'Komik Edu',
                'tahun_terbit' => 2023,
                'kategori' => 'Buku Fiksi',
                'rak' => 'B1',
                'stok_total' => 7,
                'stok_tersedia' => 7,
            ],
            [
                'kode_buku' => 'NFK-001',
                'judul' => 'Biografi B.J. Habibie untuk Pelajar',
                'sinopsis' => 'Biografi tokoh inspiratif B.J. Habibie yang disusun untuk pelajar, menampilkan nilai kerja keras, disiplin, dan semangat inovasi.',
                'penulis' => 'Rudi Hartono',
                'penerbit' => 'Inspirasi Bangsa',
                'tahun_terbit' => 2019,
                'kategori' => 'Buku Nonfiksi',
                'rak' => 'B2',
                'stok_total' => 5,
                'stok_tersedia' => 5,
            ],
            [
                'kode_buku' => 'NFK-002',
                'judul' => 'Sains Populer: Fenomena Sehari-hari',
                'sinopsis' => 'Buku nonfiksi yang menjelaskan fenomena sains di sekitar kehidupan sehari-hari dengan bahasa sederhana dan contoh praktis.',
                'penulis' => 'Aulia Sains',
                'penerbit' => 'Cakrawala Ilmu',
                'tahun_terbit' => 2022,
                'kategori' => 'Buku Nonfiksi',
                'rak' => 'B2',
                'stok_total' => 5,
                'stok_tersedia' => 5,
            ],
            [
                'kode_buku' => 'AGM-001',
                'judul' => 'Tafsir Ringkas Juz Amma',
                'sinopsis' => 'Tafsir ringkas surah-surah pendek dalam Juz Amma yang membantu siswa memahami makna ayat dan penerapannya dalam kehidupan.',
                'penulis' => 'Ust. Ahmad Ridwan',
                'penerbit' => 'Nur Ilmu',
                'tahun_terbit' => 2021,
                'kategori' => 'Buku Keagamaan',
                'rak' => 'C1',
                'stok_total' => 6,
                'stok_tersedia' => 6,
            ],
            [
                'kode_buku' => 'AGM-002',
                'judul' => 'Akhlak Mulia untuk Remaja',
                'sinopsis' => 'Buku pembinaan karakter remaja yang membahas adab, etika pergaulan, tanggung jawab, dan pembentukan kebiasaan baik di sekolah.',
                'penulis' => 'Siti Rahma',
                'penerbit' => 'Pena Iman',
                'tahun_terbit' => 2020,
                'kategori' => 'Buku Keagamaan',
                'rak' => 'C1',
                'stok_total' => 5,
                'stok_tersedia' => 5,
            ],
            [
                'kode_buku' => 'MKR-001',
                'judul' => 'Majalah Pendidikan Edisi Januari',
                'sinopsis' => 'Majalah pendidikan berisi artikel belajar efektif, inovasi pembelajaran, dan liputan kegiatan sekolah edisi Januari.',
                'penulis' => 'Redaksi Edukasi',
                'penerbit' => 'Media Sekolah',
                'tahun_terbit' => 2026,
                'kategori' => 'Majalah & Koran',
                'rak' => 'C2',
                'stok_total' => 3,
                'stok_tersedia' => 3,
            ],
            [
                'kode_buku' => 'MKR-002',
                'judul' => 'Koran Harian Sekolah',
                'sinopsis' => 'Koran harian yang memuat berita sekolah, informasi umum, dan rubrik literasi untuk mendukung budaya baca siswa.',
                'penulis' => 'Redaksi Harian',
                'penerbit' => 'Kabar Nusantara',
                'tahun_terbit' => 2026,
                'kategori' => 'Majalah & Koran',
                'rak' => 'C2',
                'stok_total' => 2,
                'stok_tersedia' => 2,
            ],
        ];

        foreach ($bukuList as $buku) {
            $kategori = $kategoriByNama->get($buku['kategori']);
            $rak = $rakByNomor->get($buku['rak']);

            if (! $kategori || ! $rak) {
                continue;
            }

            $gambarSampul = 'buku/' . strtolower($buku['kode_buku']) . '.svg';
            if (! Storage::disk('public')->exists($gambarSampul)) {
                Storage::disk('public')->put(
                    $gambarSampul,
                    $this->placeholderSvg($buku['judul'], $buku['kode_buku'])
                );
            }

            Buku::updateOrCreate(
                ['kode_buku' => $buku['kode_buku']],
                [
                    'isbn' => null,
                    'judul' => $buku['judul'],
                    'sinopsis' => $buku['sinopsis'] ?? null,
                    'penulis' => $buku['penulis'],
                    'penerbit' => $buku['penerbit'],
                    'tahun_terbit' => $buku['tahun_terbit'],
                    'gambar_sampul' => $gambarSampul,
                    'kategori_buku_id' => $kategori->id,
                    'rak_id' => $rak->id,
                    'stok_total' => $buku['stok_total'],
                    'stok_tersedia' => $buku['stok_tersedia'],
                ]
            );
        }
    }

    private function placeholderSvg(string $judul, string $kode): string
    {
        $judulEscaped = htmlspecialchars($judul, ENT_QUOTES, 'UTF-8');
        $kodeEscaped = htmlspecialchars($kode, ENT_QUOTES, 'UTF-8');

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="360" height="540" viewBox="0 0 360 540">
  <defs>
    <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="#0ea5e9"/>
      <stop offset="100%" stop-color="#1e3a8a"/>
    </linearGradient>
  </defs>
  <rect width="360" height="540" fill="url(#bg)"/>
  <rect x="24" y="24" width="312" height="492" rx="16" fill="rgba(255,255,255,0.10)" stroke="rgba(255,255,255,0.35)"/>
  <text x="36" y="90" fill="#e0f2fe" font-family="Arial, sans-serif" font-size="18" font-weight="700">PERPUSTAKAAN SEKOLAH</text>
  <text x="36" y="142" fill="#ffffff" font-family="Arial, sans-serif" font-size="16" font-weight="700">{$kodeEscaped}</text>
  <foreignObject x="36" y="170" width="288" height="300">
    <div xmlns="http://www.w3.org/1999/xhtml" style="font-family: Arial, sans-serif; color: #ffffff; font-size: 28px; font-weight: 700; line-height: 1.3;">
      {$judulEscaped}
    </div>
  </foreignObject>
  <text x="36" y="500" fill="#e2e8f0" font-family="Arial, sans-serif" font-size="14">Seeded Cover</text>
</svg>
SVG;
    }
}
