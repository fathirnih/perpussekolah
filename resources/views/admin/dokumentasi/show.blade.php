@extends('layouts.admin', ['title' => 'Detail Dokumentasi'])

@section('content')
<div class="mb-5 flex items-center justify-between">
    <h2 class="text-2xl font-bold">Detail Dokumentasi</h2>
    <div class="flex gap-2">
        <a href="{{ route('admin.dokumentasi.edit', $dokumentasi) }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">Edit</a>
        <a href="{{ route('admin.dokumentasi.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">Kembali</a>
    </div>
</div>

<section class="rounded-xl border bg-white p-5">
    <div class="grid gap-4 md:grid-cols-[220px_1fr]">
        <div>
            @if($dokumentasi->foto)
                <img src="{{ asset('storage/' . $dokumentasi->foto) }}" alt="{{ $dokumentasi->judul }}" class="h-32 w-full rounded-lg border object-cover">
            @else
                <div class="flex h-32 w-full items-center justify-center rounded-lg border border-dashed bg-slate-50 text-sm text-slate-400">No Image</div>
            @endif
        </div>

        <div class="grid gap-3 text-sm md:grid-cols-2">
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">ID:</span> {{ $dokumentasi->id }}</div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Slug:</span> {{ $dokumentasi->slug ?: '-' }}</div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 md:col-span-2"><span class="font-semibold">Judul:</span> {{ $dokumentasi->judul }}</div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Tanggal Kegiatan:</span> {{ optional($dokumentasi->tanggal_kegiatan)->format('d M Y') ?: '-' }}</div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Urutan:</span> {{ $dokumentasi->urutan }}</div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Status Publish:</span> {{ $dokumentasi->is_published ? 'Published' : 'Draft' }}</div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Dibuat:</span> {{ optional($dokumentasi->created_at)->format('d M Y H:i') ?: '-' }}</div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Diubah:</span> {{ optional($dokumentasi->updated_at)->format('d M Y H:i') ?: '-' }}</div>
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 md:col-span-2">
                <span class="font-semibold">Deskripsi:</span> {{ $dokumentasi->deskripsi ?: '-' }}
            </div>
        </div>
    </div>
</section>
@endsection
