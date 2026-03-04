<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TamuController extends Controller
{
    public function beranda(Request $request)
    {
        $data = $this->ambilDataKatalog($request);
        $config = $this->halamanConfig($request, 'beranda');

        return view('tamu.beranda', $data + $config);
    }

    public function katalog(Request $request)
    {
        $data = $this->ambilDataKatalog($request);
        $config = $this->halamanConfig($request, 'katalog');

        return view('tamu.katalog', $data + $config);
    }

    public function informasi(Request $request)
    {
        $data = $this->ambilDataKatalog($request);
        $config = $this->halamanConfig($request, 'informasi');

        return view('tamu.informasi', $data + $config);
    }

    public function kontak(Request $request)
    {
        $config = $this->halamanConfig($request, 'kontak');

        return view('tamu.kontak', $config);
    }

    private function ambilDataKatalog(Request $request): array
    {
        $q = trim((string) $request->query('q', ''));
        $penulis = trim((string) $request->query('penulis', ''));
        $kategori = trim((string) $request->query('kategori', ''));
        $rak = trim((string) $request->query('rak', ''));
        $status = trim((string) $request->query('status', 'semua'));

        $statistik = [
            'total_buku' => 0,
            'total_kategori' => 0,
            'buku_tersedia' => 0,
        ];

        $katalog = collect();
        $daftarKategori = collect();
        $daftarPenulis = collect();
        $daftarRak = collect();
        $jumlahHasil = 0;

        if (Schema::hasTable('buku')) {
            if (Schema::hasTable('kategori_buku')) {
                $daftarKategori = DB::table('kategori_buku')
                    ->orderBy('nama_kategori')
                    ->pluck('nama_kategori');
            }

            $daftarPenulis = DB::table('buku')
                ->whereNotNull('penulis')
                ->where('penulis', '!=', '')
                ->orderBy('penulis')
                ->distinct()
                ->pluck('penulis');

            if (Schema::hasTable('rak')) {
                $daftarRak = DB::table('rak')
                    ->orderBy('nomor_rak')
                    ->pluck('nomor_rak');
            }

            $katalog = DB::table('buku')
                ->leftJoin('rak', 'rak.id', '=', 'buku.rak_id')
                ->leftJoin('kategori_buku', 'kategori_buku.id', '=', 'buku.kategori_buku_id')
                ->select(
                    'buku.kode_buku',
                    'buku.judul',
                    'buku.penulis',
                    'buku.tahun_terbit',
                    'buku.gambar_sampul',
                    'buku.stok_tersedia',
                    'rak.nomor_rak',
                    'kategori_buku.nama_kategori'
                )
                ->when($q !== '', function ($query) use ($q) {
                    $query->where(function ($nested) use ($q) {
                        $nested->where('buku.judul', 'like', "%{$q}%")
                            ->orWhere('buku.penulis', 'like', "%{$q}%")
                            ->orWhere('kategori_buku.nama_kategori', 'like', "%{$q}%");
                    });
                })
                ->when($kategori !== '', function ($query) use ($kategori) {
                    $query->where('kategori_buku.nama_kategori', $kategori);
                })
                ->when($penulis !== '', function ($query) use ($penulis) {
                    $query->where('buku.penulis', $penulis);
                })
                ->when($rak !== '', function ($query) use ($rak) {
                    $query->where('rak.nomor_rak', $rak);
                })
                ->when($status === 'tersedia', function ($query) {
                    $query->where('buku.stok_tersedia', '>', 0);
                })
                ->when($status === 'dipinjam', function ($query) {
                    $query->where('buku.stok_tersedia', '<=', 0);
                })
                ->orderBy('buku.judul')
                ->paginate(9)
                ->withQueryString();

            $jumlahHasil = $katalog->total();
            $statistik['total_buku'] = DB::table('buku')->count();
            $statistik['buku_tersedia'] = DB::table('buku')->where('stok_tersedia', '>', 0)->count();

            if (Schema::hasTable('kategori_buku')) {
                $statistik['total_kategori'] = DB::table('kategori_buku')->count();
            }
        }

        $layanan = [
            'Jam layanan Senin - Kamis: 07.00 - 16.30',
            'Jumat: 07.00 - 15.00',
            'Maksimal pinjam mengikuti kebijakan sekolah',
            'Pengembalian diverifikasi oleh petugas perpustakaan',
        ];

        return compact('q', 'penulis', 'kategori', 'rak', 'status', 'katalog', 'statistik', 'layanan', 'daftarKategori', 'daftarPenulis', 'daftarRak', 'jumlahHasil');
    }

    private function halamanConfig(Request $request, string $menu): array
    {
        $isSiswa = $request->routeIs('siswa.*');

        if ($isSiswa) {
            $titles = [
                'beranda' => 'Beranda - Siswa',
                'katalog' => 'Katalog - Siswa',
                'informasi' => 'Informasi - Siswa',
                'kontak' => 'Kontak - Siswa',
            ];

            return [
                'layout' => 'layouts.siswa',
                'title' => $titles[$menu] ?? 'Portal Siswa',
                'activeMenu' => $menu,
                'actionUrl' => $menu === 'katalog' ? route('siswa.katalog') : null,
                'showStatus' => $menu === 'katalog',
            ];
        }

        $titles = [
            'beranda' => 'Beranda - Perpustakaan Sekolah',
            'katalog' => 'Katalog - Perpustakaan Sekolah',
            'informasi' => 'Informasi - Perpustakaan Sekolah',
            'kontak' => 'Kontak - Perpustakaan Sekolah',
        ];

        return [
            'layout' => 'layouts.app',
            'title' => $titles[$menu] ?? 'Perpustakaan Sekolah',
            'activeMenu' => $menu,
            'actionUrl' => $menu === 'katalog' ? route('katalog') : null,
            'showStatus' => false,
        ];
    }
}
