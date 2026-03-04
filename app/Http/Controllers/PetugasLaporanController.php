<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PetugasLaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalMulai = $request->query('dari', now()->startOfMonth()->toDateString());
        $tanggalSelesai = $request->query('sampai', now()->toDateString());

        $query = Peminjaman::with(['siswa', 'petugas'])
            ->whereBetween('tanggal_pinjam', [$tanggalMulai, $tanggalSelesai]);

        $daftar = (clone $query)->latest()->paginate(15)->withQueryString();

        $ringkasan = [
            'total' => (clone $query)->count(),
            'menunggu' => (clone $query)->where('status', 'menunggu')->count(),
            'dipinjam' => (clone $query)->where('status', 'dipinjam')->count(),
            'selesai' => (clone $query)->where('status', 'selesai')->count(),
            'terlambat' => (clone $query)->where('status', 'terlambat')->count(),
        ];

        return view('petugas.laporan.index', compact('daftar', 'ringkasan', 'tanggalMulai', 'tanggalSelesai'));
    }
}
