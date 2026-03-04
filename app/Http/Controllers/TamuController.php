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

        return view('tamu.beranda', $data + [
            'layout' => 'layouts.app',
            'title' => 'Beranda - Perpustakaan Sekolah',
            'activeMenu' => 'beranda',
        ]);
    }

    public function katalog(Request $request)
    {
        $data = $this->ambilDataKatalog($request);

        return view('tamu.katalog', $data + [
            'layout' => 'layouts.app',
            'title' => 'Katalog - Perpustakaan Sekolah',
            'activeMenu' => 'katalog',
            'actionUrl' => route('katalog'),
        ]);
    }

    public function informasi(Request $request)
    {
        $data = $this->ambilDataKatalog($request);

        return view('tamu.informasi', $data + [
            'layout' => 'layouts.app',
            'title' => 'Informasi - Perpustakaan Sekolah',
            'activeMenu' => 'informasi',
        ]);
    }

    public function kontak()
    {
        return view('tamu.kontak', [
            'layout' => 'layouts.app',
            'title' => 'Kontak - Perpustakaan Sekolah',
            'activeMenu' => 'kontak',
        ]);
    }

    private function ambilDataKatalog(Request $request): array
    {
        $q = trim((string) $request->query('q', ''));
        $kategori = trim((string) $request->query('kategori', ''));
        $status = trim((string) $request->query('status', 'semua'));

        $statistik = [
            'total_buku' => 0,
            'total_kategori' => 0,
            'buku_tersedia' => 0,
        ];

        $katalog = collect();
        $daftarKategori = collect();
        $jumlahHasil = 0;

        if (Schema::hasTable('buku')) {
            if (Schema::hasTable('kategori_buku')) {
                $daftarKategori = DB::table('kategori_buku')
                    ->orderBy('nama_kategori')
                    ->pluck('nama_kategori');
            }

            $katalog = DB::table('buku')
                ->leftJoin('rak', 'rak.id', '=', 'buku.rak_id')
                ->leftJoin('kategori_buku', 'kategori_buku.id', '=', 'buku.kategori_buku_id')
                ->select(
                    'buku.judul',
                    'buku.penulis',
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
                ->when($status === 'tersedia', function ($query) {
                    $query->where('buku.stok_tersedia', '>', 0);
                })
                ->when($status === 'dipinjam', function ($query) {
                    $query->where('buku.stok_tersedia', '<=', 0);
                })
                ->orderBy('buku.judul')
                ->limit(12)
                ->get();

            $jumlahHasil = $katalog->count();
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

        return compact('q', 'kategori', 'status', 'katalog', 'statistik', 'layanan', 'daftarKategori', 'jumlahHasil');
    }
}
