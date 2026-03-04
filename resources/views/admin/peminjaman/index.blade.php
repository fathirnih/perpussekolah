@extends('layouts.admin', ['title' => 'Peminjaman'])

@section('content')
<div class="mb-5 flex flex-wrap items-center justify-between gap-3">
    <h2 class="text-2xl font-bold">Peminjaman</h2>
    <div class="flex items-center gap-2">
        <form method="GET" class="flex items-center gap-2">
            <select name="status" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <option value="semua" @selected($status === 'semua')>Semua</option>
                <option value="menunggu" @selected($status === 'menunggu')>Menunggu</option>
                <option value="dipinjam" @selected($status === 'dipinjam')>Dipinjam</option>
                <option value="terlambat" @selected($status === 'terlambat')>Terlambat</option>
                <option value="selesai" @selected($status === 'selesai')>Selesai</option>
                <option value="ditolak" @selected($status === 'ditolak')>Ditolak</option>
            </select>
            <button class="rounded-lg bg-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-300">Filter</button>
        </form>
        <a href="{{ route('admin.peminjaman.create') }}" class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-800">
            Tambah Peminjaman
        </a>
    </div>
</div>

@if(session('success'))
    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">{{ session('error') }}</div>
@endif

<div class="overflow-x-auto rounded-xl border bg-white">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-3 text-left">ID</th>
                <th class="px-4 py-3 text-left">Kode</th>
                <th class="px-4 py-3 text-left">Siswa ID</th>
                <th class="px-4 py-3 text-left">Petugas ID</th>
                <th class="px-4 py-3 text-left">Tanggal Pinjam</th>
                <th class="px-4 py-3 text-left">Jatuh Tempo</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Pengajuan Kembali</th>
                <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($daftarPeminjaman as $item)
            <tr class="border-t align-top">
                <td class="px-4 py-3">{{ $item->id }}</td>
                <td class="px-4 py-3">{{ $item->kode_peminjaman }}</td>
                <td class="px-4 py-3">{{ $item->siswa_id }}</td>
                <td class="px-4 py-3">{{ $item->petugas_id ?? '-' }}</td>
                <td class="px-4 py-3">{{ optional($item->tanggal_pinjam)->format('d M Y') ?: '-' }}</td>
                <td class="px-4 py-3">{{ optional($item->tanggal_jatuh_tempo)->format('d M Y') ?: '-' }}</td>
                <td class="px-4 py-3">{{ ucfirst($item->status) }}</td>
                <td class="px-4 py-3">{{ $item->pengajuan_pengembalian ? 'Ya' : 'Tidak' }}</td>
                <td class="px-4 py-3">
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.peminjaman.show', $item) }}" class="rounded border px-2 py-1">Detail</a>
                        <a href="{{ route('admin.peminjaman.edit', $item) }}" class="rounded border px-2 py-1">Edit</a>
                        <form method="POST" action="{{ route('admin.peminjaman.destroy', $item) }}" onsubmit="return confirm('Hapus data peminjaman ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="rounded border border-rose-200 bg-rose-50 px-2 py-1 text-rose-700">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td class="px-4 py-6 text-center text-slate-500" colspan="9">Belum ada data peminjaman.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $daftarPeminjaman->links() }}</div>
@endsection
