@extends('layouts.petugas', ['title' => 'Laporan Petugas'])

@section('content')
<div class="mb-5 flex flex-wrap items-end justify-between gap-3">
    <div>
        <h2 class="text-2xl font-bold">Laporan Peminjaman</h2>
        <p class="text-sm text-slate-600">Laporan transaksi per periode.</p>
    </div>
    <form method="GET" class="flex flex-wrap items-end gap-2">
        <div>
            <label class="mb-1 block text-xs font-medium text-slate-500">Dari</label>
            <input type="date" name="dari" value="{{ $tanggalMulai }}" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
        </div>
        <div>
            <label class="mb-1 block text-xs font-medium text-slate-500">Sampai</label>
            <input type="date" name="sampai" value="{{ $tanggalSelesai }}" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
        </div>
        <button class="rounded-lg bg-sky-700 px-3 py-2 text-sm font-semibold text-white">Terapkan</button>
    </form>
</div>

<div class="mb-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
    <article class="rounded-xl border border-slate-200 bg-white p-4"><p class="text-xs uppercase text-slate-500">Total</p><p class="mt-2 text-2xl font-bold">{{ number_format($ringkasan['total'], 0, ',', '.') }}</p></article>
    <article class="rounded-xl border border-slate-200 bg-white p-4"><p class="text-xs uppercase text-slate-500">Menunggu</p><p class="mt-2 text-2xl font-bold">{{ number_format($ringkasan['menunggu'], 0, ',', '.') }}</p></article>
    <article class="rounded-xl border border-slate-200 bg-white p-4"><p class="text-xs uppercase text-slate-500">Dipinjam</p><p class="mt-2 text-2xl font-bold">{{ number_format($ringkasan['dipinjam'], 0, ',', '.') }}</p></article>
    <article class="rounded-xl border border-slate-200 bg-white p-4"><p class="text-xs uppercase text-slate-500">Selesai</p><p class="mt-2 text-2xl font-bold">{{ number_format($ringkasan['selesai'], 0, ',', '.') }}</p></article>
    <article class="rounded-xl border border-slate-200 bg-white p-4"><p class="text-xs uppercase text-slate-500">Terlambat</p><p class="mt-2 text-2xl font-bold">{{ number_format($ringkasan['terlambat'], 0, ',', '.') }}</p></article>
</div>

<div class="overflow-x-auto rounded-xl border bg-white">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50"><tr><th class="px-4 py-3 text-left">Kode</th><th class="px-4 py-3 text-left">Siswa</th><th class="px-4 py-3 text-left">Tanggal Pinjam</th><th class="px-4 py-3 text-left">Status</th><th class="px-4 py-3 text-left">Petugas</th></tr></thead>
        <tbody>
        @forelse($daftar as $item)
            <tr class="border-t"><td class="px-4 py-3">{{ $item->kode_peminjaman }}</td><td class="px-4 py-3">{{ $item->siswa->nama ?? '-' }}</td><td class="px-4 py-3">{{ optional($item->tanggal_pinjam)->format('d-m-Y') }}</td><td class="px-4 py-3">{{ ucfirst($item->status) }}</td><td class="px-4 py-3">{{ $item->petugas->nama ?? '-' }}</td></tr>
        @empty
            <tr><td class="px-4 py-6 text-center text-slate-500" colspan="5">Tidak ada data untuk periode ini.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $daftar->links() }}</div>
@endsection
