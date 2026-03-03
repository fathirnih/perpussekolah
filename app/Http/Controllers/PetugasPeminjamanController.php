<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetugasPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $status = (string) $request->query('status', 'semua');

        $daftarPeminjaman = Peminjaman::with(['siswa', 'detailPeminjaman.buku', 'petugas'])
            ->when($status !== 'semua', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('petugas.peminjaman.index', compact('daftarPeminjaman', 'status'));
    }

    public function proses(Peminjaman $peminjaman, Request $request)
    {
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman ini tidak dalam status menunggu.');
        }

        DB::transaction(function () use ($peminjaman, $request): void {
            $peminjaman->load('detailPeminjaman');

            foreach ($peminjaman->detailPeminjaman as $detail) {
                $buku = Buku::lockForUpdate()->findOrFail($detail->buku_id);

                if ($buku->stok_tersedia < $detail->qty) {
                    throw new \RuntimeException("Stok buku '{$buku->judul}' tidak mencukupi.");
                }
            }

            foreach ($peminjaman->detailPeminjaman as $detail) {
                $buku = Buku::lockForUpdate()->findOrFail($detail->buku_id);
                $buku->decrement('stok_tersedia', $detail->qty);
            }

            $auth = $request->session()->get('internal_auth');

            $peminjaman->update([
                'status' => 'dipinjam',
                'petugas_id' => $auth['tipe'] === 'petugas' ? ($auth['id'] ?? null) : $peminjaman->petugas_id,
            ]);
        });

        return back()->with('success', 'Peminjaman berhasil diproses.');
    }

    public function kembalikan(Peminjaman $peminjaman, Request $request)
    {
        if (! in_array($peminjaman->status, ['dipinjam', 'terlambat'], true)) {
            return back()->with('error', 'Status peminjaman tidak bisa dikembalikan.');
        }

        DB::transaction(function () use ($peminjaman, $request): void {
            $peminjaman->load('detailPeminjaman');

            foreach ($peminjaman->detailPeminjaman as $detail) {
                if ($detail->status_item === 'kembali') {
                    continue;
                }

                $buku = Buku::lockForUpdate()->findOrFail($detail->buku_id);
                $buku->increment('stok_tersedia', $detail->qty);

                $detail->update([
                    'status_item' => 'kembali',
                    'tanggal_kembali' => now()->toDateString(),
                ]);
            }

            $auth = $request->session()->get('internal_auth');

            $peminjaman->update([
                'status' => 'selesai',
                'petugas_id' => $auth['tipe'] === 'petugas' ? ($auth['id'] ?? null) : $peminjaman->petugas_id,
            ]);
        });

        return back()->with('success', 'Pengembalian berhasil diproses.');
    }
}
