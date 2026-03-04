<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaPeminjamanController extends Controller
{
    public function indexPeminjaman(Request $request)
    {
        $siswaId = $this->siswaId($request);

        $daftarBuku = Buku::query()
            ->with(['kategori', 'rak'])
            ->orderBy('judul')
            ->get();

        $riwayat = Peminjaman::with('detailPeminjaman.buku')
            ->where('siswa_id', $siswaId)
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('siswa.peminjaman.index', compact('daftarBuku', 'riwayat'));
    }

    public function storePeminjaman(Request $request)
    {
        $siswaId = $this->siswaId($request);

        $items = collect($request->input('items', []))
            ->map(function ($item): array {
                return [
                    'buku_id' => $item['buku_id'] ?? null,
                    'qty' => $item['qty'] ?? 1,
                ];
            })
            ->filter(fn (array $item): bool => filled($item['buku_id']))
            ->values()
            ->all();

        $request->merge(['items' => $items]);

        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1', 'max:5'],
            'items.*.buku_id' => ['required', 'integer', 'distinct', 'exists:buku,id'],
            'items.*.qty' => ['required', 'integer', 'min:1', 'max:3'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ]);

        DB::transaction(function () use ($validated, $siswaId): void {
            $peminjaman = Peminjaman::create([
                'kode_peminjaman' => $this->generateKode(),
                'siswa_id' => $siswaId,
                'tanggal_pinjam' => now()->toDateString(),
                'tanggal_jatuh_tempo' => now()->addDays(7)->toDateString(),
                'status' => 'menunggu',
                'catatan' => blank($validated['catatan'] ?? null) ? null : $validated['catatan'],
                'pengajuan_pengembalian' => false,
            ]);

            foreach ($validated['items'] as $item) {
                DetailPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'buku_id' => (int) $item['buku_id'],
                    'qty' => (int) $item['qty'],
                    'status_item' => 'dipinjam',
                ]);
            }
        });

        return redirect()
            ->route('siswa.peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil dibuat. Menunggu proses petugas.');
    }

    public function indexPengembalian(Request $request)
    {
        $siswaId = $this->siswaId($request);

        $daftarDipinjam = Peminjaman::with('detailPeminjaman.buku')
            ->where('siswa_id', $siswaId)
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('siswa.pengembalian.index', compact('daftarDipinjam'));
    }

    public function ajukanPengembalian(Peminjaman $peminjaman, Request $request)
    {
        $siswaId = $this->siswaId($request);

        if ((int) $peminjaman->siswa_id !== (int) $siswaId) {
            abort(403);
        }

        if (! in_array($peminjaman->status, ['dipinjam', 'terlambat'], true)) {
            return back()->with('error', 'Status peminjaman ini tidak bisa diajukan untuk pengembalian.');
        }

        if ($peminjaman->pengajuan_pengembalian) {
            return back()->with('error', 'Pengajuan pengembalian untuk transaksi ini sudah dikirim.');
        }

        $catatanBaru = trim((string) $peminjaman->catatan);
        $tanda = 'Siswa mengajukan pengembalian pada ' . now()->format('d-m-Y H:i');
        $catatanGabung = blank($catatanBaru) ? $tanda : $catatanBaru . PHP_EOL . $tanda;

        $peminjaman->update([
            'pengajuan_pengembalian' => true,
            'catatan' => $catatanGabung,
        ]);

        return back()->with('success', 'Pengajuan pengembalian berhasil dikirim. Menunggu proses petugas.');
    }

    private function siswaId(Request $request): int
    {
        return (int) ($request->session()->get('siswa_auth.id') ?? 0);
    }

    private function generateKode(): string
    {
        return 'PJM-' . now()->format('YmdHis') . '-' . random_int(100, 999);
    }
}
