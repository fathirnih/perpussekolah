@extends('layouts.admin', ['title' => 'Detail Buku'])

@section('content')
<div class="mb-5 flex items-center justify-between">
    <h2 class="text-2xl font-bold">Detail Buku</h2>
    <a href="{{ route('admin.buku.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
        Kembali
    </a>
</div>

<div class="rounded-xl border bg-white p-5">
    <div class="grid gap-6 md:grid-cols-[220px_1fr]">
        <div>
            @if($buku->gambar_sampul)
                <img src="{{ asset('storage/' . $buku->gambar_sampul) }}" alt="{{ $buku->judul }}" class="h-72 w-full rounded-lg object-cover">
            @else
                <div class="flex h-72 items-center justify-center rounded-lg border bg-slate-50 text-sm text-slate-400">Tanpa Sampul</div>
            @endif
        </div>
        <div class="space-y-2 text-sm">
            <p><span class="font-semibold">Kode Buku:</span> {{ $buku->kode_buku }}</p>
            <p><span class="font-semibold">ISBN:</span> {{ $buku->isbn ?? '-' }}</p>
            <p><span class="font-semibold">Judul:</span> {{ $buku->judul }}</p>
            <p><span class="font-semibold">Penulis:</span> {{ $buku->penulis }}</p>
            <p><span class="font-semibold">Penerbit:</span> {{ $buku->penerbit ?? '-' }}</p>
            <p><span class="font-semibold">Tahun:</span> {{ $buku->tahun_terbit ?? '-' }}</p>
            <p><span class="font-semibold">Kategori:</span> {{ $buku->kategori->nama_kategori ?? '-' }}</p>
            <p><span class="font-semibold">Rak:</span> {{ $buku->rak->nomor_rak ?? '-' }}</p>
            <p><span class="font-semibold">Stok:</span> {{ $buku->stok_tersedia }}/{{ $buku->stok_total }}</p>
        </div>
    </div>
</div>
@endsection
