<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Petugas;
use App\Models\Peminjaman;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $status = (string) $request->query('status', 'semua');

        $daftarPeminjaman = Peminjaman::query()
            ->when($status !== 'semua', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.peminjaman.index', compact('daftarPeminjaman', 'status'));
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['siswa', 'petugas', 'detailPeminjaman.buku.kategori', 'detailPeminjaman.buku.rak']);

        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    public function create()
    {
        $daftarSiswa = Siswa::query()->orderBy('nama')->get(['id', 'nama', 'kelas']);
        $daftarPetugas = Petugas::query()->orderBy('nama')->get(['id', 'nama']);
        $daftarBuku = Buku::query()
            ->orderBy('judul')
            ->get(['id', 'judul', 'kode_buku', 'stok_tersedia']);
        $kodeDefault = $this->generateKode();

        return view('admin.peminjaman.create', compact('daftarSiswa', 'daftarPetugas', 'daftarBuku', 'kodeDefault'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePeminjaman($request);
        $hasilError = $this->simpanPeminjaman(null, $validated);
        if ($hasilError !== null) {
            return back()->withInput()->with('error', $hasilError);
        }
        return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan oleh admin.');
    }

    public function edit(Peminjaman $peminjaman)
    {
        $peminjaman->load('detailPeminjaman');
        $daftarSiswa = Siswa::query()->orderBy('nama')->get(['id', 'nama', 'kelas']);
        $daftarPetugas = Petugas::query()->orderBy('nama')->get(['id', 'nama']);
        $daftarBuku = Buku::query()
            ->orderBy('judul')
            ->get(['id', 'judul', 'kode_buku', 'stok_tersedia']);

        return view('admin.peminjaman.edit', compact('peminjaman', 'daftarSiswa', 'daftarPetugas', 'daftarBuku'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validated = $this->validatePeminjaman($request, $peminjaman);
        $hasilError = $this->simpanPeminjaman($peminjaman, $validated);
        if ($hasilError !== null) {
            return back()->withInput()->with('error', $hasilError);
        }

        return redirect()->route('admin.peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman): void {
            $peminjaman->load('detailPeminjaman.buku');

            if ($this->isStatusAktifPinjam($peminjaman->status)) {
                foreach ($peminjaman->detailPeminjaman as $detail) {
                    if ($detail->buku) {
                        $detail->buku->increment('stok_tersedia', (int) $detail->qty);
                    }
                }
            }

            $peminjaman->detailPeminjaman()->delete();
            $peminjaman->delete();
        });

        return redirect()->route('admin.peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }

    private function generateKode(): string
    {
        return 'ADM-PJM-' . now()->format('YmdHis') . '-' . random_int(100, 999);
    }

    private function validatePeminjaman(Request $request, ?Peminjaman $peminjaman = null): array
    {
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

        $request->merge([
            'items' => $items,
            'pengajuan_pengembalian' => $request->boolean('pengajuan_pengembalian'),
        ]);

        $kodeRule = ['required', 'string', 'max:100', Rule::unique('peminjaman', 'kode_peminjaman')];
        if ($peminjaman) {
            $kodeRule = ['required', 'string', 'max:100', Rule::unique('peminjaman', 'kode_peminjaman')->ignore($peminjaman->id)];
        }

        return $request->validate([
            'kode_peminjaman' => $kodeRule,
            'siswa_id' => ['required', 'integer', 'exists:siswa,id'],
            'petugas_id' => ['nullable', 'integer', 'exists:petugas,id'],
            'tanggal_pinjam' => ['required', 'date'],
            'tanggal_jatuh_tempo' => ['required', 'date', 'after_or_equal:tanggal_pinjam'],
            'status' => ['required', Rule::in(['menunggu', 'dipinjam', 'selesai', 'terlambat', 'ditolak'])],
            'pengajuan_pengembalian' => ['nullable', 'boolean'],
            'items' => ['required', 'array', 'min:1', 'max:10'],
            'items.*.buku_id' => ['required', 'integer', 'distinct', 'exists:buku,id'],
            'items.*.qty' => ['required', 'integer', 'min:1', 'max:5'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ]);
    }

    private function simpanPeminjaman(?Peminjaman $peminjaman, array $validated): ?string
    {
        try {
            DB::transaction(function () use ($peminjaman, $validated): void {
                $isEdit = $peminjaman !== null;
                $statusLamaAktif = $isEdit ? $this->isStatusAktifPinjam($peminjaman->status) : false;
                $statusBaruAktif = $this->isStatusAktifPinjam($validated['status']);

                if ($isEdit) {
                    $peminjaman->load('detailPeminjaman.buku');

                    if ($statusLamaAktif) {
                        foreach ($peminjaman->detailPeminjaman as $detailLama) {
                            if ($detailLama->buku) {
                                $detailLama->buku->increment('stok_tersedia', (int) $detailLama->qty);
                            }
                        }
                    }

                    $peminjaman->detailPeminjaman()->delete();
                }

                $stokBuku = Buku::query()
                    ->whereIn('id', collect($validated['items'])->pluck('buku_id')->all())
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                if ($statusBaruAktif) {
                    foreach ($validated['items'] as $item) {
                        $buku = $stokBuku->get((int) $item['buku_id']);
                        if (! $buku || $buku->stok_tersedia < (int) $item['qty']) {
                            $judul = $buku->judul ?? 'Buku';
                            throw new \RuntimeException("Stok buku '{$judul}' tidak mencukupi.");
                        }
                    }
                }

                if (! $isEdit) {
                    $peminjaman = new Peminjaman();
                }

                $peminjaman->fill([
                    'kode_peminjaman' => $validated['kode_peminjaman'],
                    'siswa_id' => (int) $validated['siswa_id'],
                    'petugas_id' => ! empty($validated['petugas_id']) ? (int) $validated['petugas_id'] : null,
                    'tanggal_pinjam' => $validated['tanggal_pinjam'],
                    'tanggal_jatuh_tempo' => $validated['tanggal_jatuh_tempo'],
                    'status' => $validated['status'],
                    'catatan' => blank($validated['catatan'] ?? null) ? null : $validated['catatan'],
                    'pengajuan_pengembalian' => (bool) ($validated['pengajuan_pengembalian'] ?? false),
                ]);
                $peminjaman->save();

                foreach ($validated['items'] as $item) {
                    $buku = $stokBuku->get((int) $item['buku_id']);
                    $qty = (int) $item['qty'];
                    $statusItem = $validated['status'] === 'selesai' ? 'kembali' : 'dipinjam';

                    DetailPeminjaman::create([
                        'peminjaman_id' => $peminjaman->id,
                        'buku_id' => (int) $item['buku_id'],
                        'qty' => $qty,
                        'status_item' => $statusItem,
                        'tanggal_kembali' => $statusItem === 'kembali' ? now()->toDateString() : null,
                    ]);

                    if ($statusBaruAktif && $buku) {
                        $buku->decrement('stok_tersedia', $qty);
                    }
                }
            });
        } catch (\RuntimeException $exception) {
            return $exception->getMessage();
        }

        return null;
    }

    private function isStatusAktifPinjam(string $status): bool
    {
        return in_array($status, ['dipinjam', 'terlambat'], true);
    }
}
