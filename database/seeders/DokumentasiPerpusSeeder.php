<?php

namespace Database\Seeders;

use App\Models\DokumentasiPerpus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DokumentasiPerpusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'judul' => 'Literasi Pagi Bersama',
                'tanggal_kegiatan' => '2026-03-03',
                'deskripsi' => 'Siswa membaca buku nonpelajaran selama 15 menit sebelum pembelajaran dimulai untuk meningkatkan kebiasaan membaca harian.',
                'urutan' => 1,
                'is_published' => true,
            ],
            [
                'judul' => 'Kunjungan Kelas ke Perpustakaan',
                'tanggal_kegiatan' => '2026-03-04',
                'deskripsi' => 'Sosialisasi tata tertib perpustakaan, pengenalan rak koleksi, serta cara mencari buku berdasarkan kategori.',
                'urutan' => 2,
                'is_published' => true,
            ],
            [
                'judul' => 'Bimbingan Peminjaman Buku',
                'tanggal_kegiatan' => '2026-03-05',
                'deskripsi' => 'Petugas membimbing siswa memilih buku dan memahami alur peminjaman serta pengembalian sesuai ketentuan.',
                'urutan' => 3,
                'is_published' => true,
            ],
            [
                'judul' => 'Pojok Referensi Tugas',
                'tanggal_kegiatan' => '2026-03-06',
                'deskripsi' => 'Pemanfaatan kamus, atlas, dan ensiklopedia untuk membantu penyusunan tugas proyek dan presentasi siswa.',
                'urutan' => 4,
                'is_published' => true,
            ],
            [
                'judul' => 'Rekomendasi Buku Mingguan',
                'tanggal_kegiatan' => '2026-03-07',
                'deskripsi' => 'Guru dan pustakawan menampilkan buku pilihan mingguan untuk memperluas minat baca di berbagai kategori.',
                'urutan' => 5,
                'is_published' => true,
            ],
            [
                'judul' => 'Pendampingan Ruang Baca',
                'tanggal_kegiatan' => '2026-03-08',
                'deskripsi' => 'Kegiatan membaca mandiri dan diskusi ringan agar siswa lebih nyaman memanfaatkan perpustakaan sebagai ruang belajar.',
                'urutan' => 6,
                'is_published' => true,
            ],
        ];

        foreach ($items as $index => $item) {
            $filename = 'dokumentasi-perpus/dokumentasi-' . ($index + 1) . '.svg';
            $slug = Str::slug($item['judul']);

            if (! Storage::disk('public')->exists($filename)) {
                Storage::disk('public')->put($filename, $this->placeholderSvg($item['judul']));
            }

            DokumentasiPerpus::updateOrCreate(
                [
                    'judul' => $item['judul'],
                    'tanggal_kegiatan' => $item['tanggal_kegiatan'],
                ],
                $item + ['slug' => $slug, 'foto' => $filename]
            );
        }
    }

    private function placeholderSvg(string $judul): string
    {
        $judulEscaped = htmlspecialchars($judul, ENT_QUOTES, 'UTF-8');

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="800" viewBox="0 0 1200 800">
  <defs>
    <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="#0f172a"/>
      <stop offset="100%" stop-color="#1d4ed8"/>
    </linearGradient>
  </defs>
  <rect width="1200" height="800" fill="url(#bg)"/>
  <rect x="40" y="40" width="1120" height="720" rx="22" fill="rgba(255,255,255,0.08)" stroke="rgba(255,255,255,0.3)"/>
  <text x="70" y="120" fill="#e2e8f0" font-family="Arial, sans-serif" font-size="30" font-weight="700">DOKUMENTASI PERPUSTAKAAN</text>
  <foreignObject x="70" y="180" width="1060" height="520">
    <div xmlns="http://www.w3.org/1999/xhtml" style="font-family: Arial, sans-serif; color: #ffffff; font-size: 64px; font-weight: 700; line-height: 1.25;">
      {$judulEscaped}
    </div>
  </foreignObject>
  <text x="70" y="740" fill="#cbd5e1" font-family="Arial, sans-serif" font-size="24">Seeded by DokumentasiPerpusSeeder</text>
</svg>
SVG;
    }
}
