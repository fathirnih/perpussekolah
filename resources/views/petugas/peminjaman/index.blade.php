@extends('layouts.petugas', ['title' => 'Peminjaman'])

@section('content')
<div class="mb-5 flex flex-wrap items-center justify-between gap-3">
    <h2 class="text-2xl font-bold">Peminjaman</h2>
    <form method="GET" class="flex items-center gap-2">
        <select name="status" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <option value="semua" @selected($status === 'semua')>Semua</option>
            <option value="menunggu" @selected($status === 'menunggu')>Menunggu</option>
            <option value="dipinjam" @selected($status === 'dipinjam')>Dipinjam</option>
            <option value="terlambat" @selected($status === 'terlambat')>Terlambat</option>
            <option value="selesai" @selected($status === 'selesai')>Selesai</option>
        </select>
        <button class="rounded-lg bg-sky-700 px-3 py-2 text-sm font-semibold text-white">Filter</button>
    </form>
</div>

@if(session('success'))<div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">{{ session('success') }}</div>@endif
@if(session('error'))<div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">{{ session('error') }}</div>@endif

<div class="overflow-x-auto rounded-xl border bg-white">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50"><tr><th class="px-4 py-3 text-left">Kode</th><th class="px-4 py-3 text-left">Siswa</th><th class="px-4 py-3 text-left">Buku</th><th class="px-4 py-3 text-left">Status</th><th class="px-4 py-3 text-left">Aksi</th></tr></thead>
        <tbody>
        @forelse($daftarPeminjaman as $item)
            <tr class="border-t align-top">
                <td class="px-4 py-3">{{ $item->kode_peminjaman }}</td>
                <td class="px-4 py-3">{{ $item->siswa->nama ?? '-' }}</td>
                <td class="px-4 py-3">
                    <ul class="space-y-1">
                        @foreach($item->detailPeminjaman as $detail)
                            <li>{{ $detail->buku->judul ?? '-' }} ({{ $detail->qty }})</li>
                        @endforeach
                    </ul>
                </td>
                <td class="px-4 py-3">{{ ucfirst($item->status) }}</td>
                <td class="px-4 py-3">
                    <div class="flex flex-wrap gap-2">
                        @if($item->status === 'menunggu')
                            <form method="POST" action="{{ route('petugas.peminjaman.proses', $item) }}">
                                @csrf
                                <button class="rounded border border-sky-200 bg-sky-50 px-2 py-1 text-sky-700">Proses Pinjam</button>
                            </form>
                        @endif
                        @if(in_array($item->status, ['dipinjam', 'terlambat'], true))
                            <form method="POST" action="{{ route('petugas.peminjaman.kembalikan', $item) }}">
                                @csrf
                                <button class="rounded border border-emerald-200 bg-emerald-50 px-2 py-1 text-emerald-700">Proses Kembali</button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr><td class="px-4 py-6 text-center text-slate-500" colspan="5">Tidak ada data peminjaman.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $daftarPeminjaman->links() }}</div>
@endsection
