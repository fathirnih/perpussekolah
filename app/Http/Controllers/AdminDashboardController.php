<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Petugas;
use App\Models\Peminjaman;
use App\Models\Siswa;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $ringkasan = [
            'admin' => User::count(),
            'petugas' => Petugas::count(),
            'siswa' => Siswa::count(),
            'buku' => Buku::count(),
            'peminjaman' => Peminjaman::count(),
        ];

        return view('admin.dashboard', compact('ringkasan'));
    }
}
