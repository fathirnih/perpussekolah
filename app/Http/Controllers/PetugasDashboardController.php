<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        $ringkasan = [
            'menunggu' => Peminjaman::where('status', 'menunggu')->count(),
            'dipinjam' => Peminjaman::where('status', 'dipinjam')->count(),
            'terlambat' => Peminjaman::where('status', 'terlambat')->count(),
            'selesai' => Peminjaman::where('status', 'selesai')->count(),
        ];

        $peminjamanTerbaru = Peminjaman::with('siswa')
            ->latest()
            ->limit(8)
            ->get();

        return view('petugas.dashboard', compact('ringkasan', 'peminjamanTerbaru'));
    }
}
