<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class SiswaDashboardController extends Controller
{
    public function index(Request $request)
    {
        $auth = $request->session()->get('siswa_auth');
        $siswaId = $auth['id'] ?? null;

        $ringkasan = [
            'total' => Peminjaman::where('siswa_id', $siswaId)->count(),
            'menunggu' => Peminjaman::where('siswa_id', $siswaId)->where('status', 'menunggu')->count(),
            'dipinjam' => Peminjaman::where('siswa_id', $siswaId)->where('status', 'dipinjam')->count(),
            'selesai' => Peminjaman::where('siswa_id', $siswaId)->where('status', 'selesai')->count(),
        ];

        $riwayat = Peminjaman::with('detailPeminjaman.buku')
            ->where('siswa_id', $siswaId)
            ->latest()
            ->limit(10)
            ->get();

        return view('siswa.dashboard', compact('ringkasan', 'riwayat', 'auth'));
    }
}
