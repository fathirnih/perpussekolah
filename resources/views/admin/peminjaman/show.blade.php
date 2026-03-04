@extends('layouts.admin', ['title' => 'Detail Peminjaman'])

@section('content')
<div class="mb-5 flex items-center justify-between">
    <h2 class="text-2xl font-bold">Detail Peminjaman</h2>
    <div class="flex gap-2">
        <a href="{{ route('admin.peminjaman.edit', $peminjaman) }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
            Edit
        </a>
        <a href="{{ route('admin.peminjaman.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
            Kembali
        </a>
    </div>
</div>

<section class="rounded-xl border bg-white p-5">
    <div class="grid gap-3 text-sm md:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">ID:</span> {{ $peminjaman->id }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Kode:</span> {{ $peminjaman->kode_peminjaman }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Siswa ID:</span> {{ $peminjaman->siswa_id }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Nama Siswa:</span> {{ $peminjaman->siswa->nama ?? '-' }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Petugas ID:</span> {{ $peminjaman->petugas_id ?? '-' }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Nama Petugas:</span> {{ $peminjaman->petugas->nama ?? '-' }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Tanggal Pinjam:</span> {{ optional($peminjaman->tanggal_pinjam)->format('d M Y') ?: '-' }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Jatuh Tempo:</span> {{ optional($peminjaman->tanggal_jatuh_tempo)->format('d M Y') ?: '-' }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Status:</span> {{ ucfirst($peminjaman->status) }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Pengajuan Pengembalian:</span> {{ $peminjaman->pengajuan_pengembalian ? 'Ya' : 'Tidak' }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Dibuat:</span> {{ optional($peminjaman->created_at)->format('d M Y H:i') ?: '-' }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Diubah:</span> {{ optional($peminjaman->updated_at)->format('d M Y H:i') ?: '-' }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 md:col-span-2 xl:col-span-3">
            <span class="font-semibold">Catatan:</span> {{ $peminjaman->catatan ?: '-' }}
        </div>
    </div>
</section>

<section class="mt-5 rounded-xl border bg-white p-5">
    <h3 class="mb-3 text-lg font-bold">Detail Item Buku</h3>
    <div class="overflow-x-auto rounded-lg border">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-3 py-2 text-left">Detail ID</th>
                    <th class="px-3 py-2 text-left">Buku ID</th>
                    <th class="px-3 py-2 text-left">Judul Buku</th>
                    <th class="px-3 py-2 text-left">Kategori</th>
                    <th class="px-3 py-2 text-left">Rak</th>
                    <th class="px-3 py-2 text-left">Qty</th>
                    <th class="px-3 py-2 text-left">Status Item</th>
                    <th class="px-3 py-2 text-left">Tanggal Kembali</th>
                    <th class="px-3 py-2 text-left">Denda</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman->detailPeminjaman as $detail)
                    <tr class="border-t">
                        <td class="px-3 py-2">{{ $detail->id }}</td>
                        <td class="px-3 py-2">{{ $detail->buku_id }}</td>
                        <td class="px-3 py-2">{{ $detail->buku->judul ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $detail->buku->kategori->nama_kategori ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $detail->buku->rak->nomor_rak ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $detail->qty }}</td>
                        <td class="px-3 py-2">{{ ucfirst($detail->status_item) }}</td>
                        <td class="px-3 py-2">{{ optional($detail->tanggal_kembali)->format('d M Y') ?: '-' }}</td>
                        <td class="px-3 py-2">{{ number_format((float) $detail->denda, 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td class="px-3 py-4 text-center text-slate-500" colspan="9">Belum ada detail buku.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection

