@extends('layouts.siswa', ['title' => 'Dashboard Siswa'])

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Dashboard Siswa</h2>
    <p class="mt-1 text-sm text-slate-600">Halo, {{ $auth['nama'] ?? 'Siswa' }} ({{ $auth['kelas'] ?? '-' }}).</p>
</div>

<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <article class="rounded-xl border border-slate-200 bg-white p-4"><p class="text-xs uppercase text-slate-500">Total</p><p class="mt-2 text-2xl font-bold">{{ number_format($ringkasan['total'] ?? 0, 0, ',', '.') }}</p></article>
    <article class="rounded-xl border border-slate-200 bg-white p-4"><p class="text-xs uppercase text-slate-500">Menunggu</p><p class="mt-2 text-2xl font-bold text-amber-600">{{ number_format($ringkasan['menunggu'] ?? 0, 0, ',', '.') }}</p></article>
    <article class="rounded-xl border border-slate-200 bg-white p-4"><p class="text-xs uppercase text-slate-500">Dipinjam</p><p class="mt-2 text-2xl font-bold text-sky-700">{{ number_format($ringkasan['dipinjam'] ?? 0, 0, ',', '.') }}</p></article>
    <article class="rounded-xl border border-slate-200 bg-white p-4"><p class="text-xs uppercase text-slate-500">Selesai</p><p class="mt-2 text-2xl font-bold text-emerald-600">{{ number_format($ringkasan['selesai'] ?? 0, 0, ',', '.') }}</p></article>
</div>

<div class="mt-6 rounded-xl border bg-white p-4">
    <h3 class="mb-3 text-lg font-semibold">Riwayat Peminjaman</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50"><tr><th class="px-3 py-2 text-left">Kode</th><th class="px-3 py-2 text-left">Buku</th><th class="px-3 py-2 text-left">Status</th><th class="px-3 py-2 text-left">Tanggal</th></tr></thead>
            <tbody>
            @forelse($riwayat as $item)
                <tr class="border-t">
                    <td class="px-3 py-2">{{ $item->kode_peminjaman }}</td>
                    <td class="px-3 py-2">
                        <ul class="space-y-1">
                            @foreach($item->detailPeminjaman as $detail)
                                <li>{{ $detail->buku->judul ?? '-' }} ({{ $detail->qty }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-3 py-2">{{ ucfirst($item->status) }}</td>
                    <td class="px-3 py-2">{{ optional($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr><td class="px-3 py-4 text-center text-slate-500" colspan="4">Belum ada riwayat peminjaman.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
