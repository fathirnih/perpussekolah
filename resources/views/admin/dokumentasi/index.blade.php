@extends('layouts.admin', ['title' => 'Dokumentasi Perpustakaan'])

@section('content')
<div class="mb-5 flex items-center justify-between">
    <h2 class="text-2xl font-bold">Dokumentasi Perpustakaan</h2>
    <a href="{{ route('admin.dokumentasi.create') }}" class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-800">
        Tambah Dokumentasi
    </a>
</div>

@if(session('success'))
    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">{{ session('success') }}</div>
@endif

<div class="overflow-x-auto rounded-xl border bg-white">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-3 text-left">Foto</th>
                <th class="px-4 py-3 text-left">Judul</th>
                <th class="px-4 py-3 text-left">Tanggal</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Urutan</th>
                <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($daftarDokumentasi as $item)
            <tr class="border-t align-top">
                <td class="px-4 py-3">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="h-16 w-24 rounded border object-cover">
                    @else
                        <div class="flex h-16 w-24 items-center justify-center rounded border border-dashed text-xs text-slate-400">No Image</div>
                    @endif
                </td>
                <td class="px-4 py-3">
                    <p class="font-semibold text-slate-800">{{ $item->judul }}</p>
                    <p class="mt-1 line-clamp-2 text-xs text-slate-500">{{ $item->deskripsi ?: '-' }}</p>
                </td>
                <td class="px-4 py-3">{{ optional($item->tanggal_kegiatan)->format('d-m-Y') ?: '-' }}</td>
                <td class="px-4 py-3">
                    @if($item->is_published)
                        <span class="rounded-full bg-emerald-100 px-2 py-1 text-xs font-semibold text-emerald-700">Published</span>
                    @else
                        <span class="rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-700">Draft</span>
                    @endif
                </td>
                <td class="px-4 py-3">{{ $item->urutan }}</td>
                <td class="px-4 py-3">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.dokumentasi.edit', $item) }}" class="rounded border px-2 py-1">Edit</a>
                        <form method="POST" action="{{ route('admin.dokumentasi.destroy', $item) }}" onsubmit="return confirm('Hapus dokumentasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="rounded border border-rose-200 bg-rose-50 px-2 py-1 text-rose-700">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="px-4 py-6 text-center text-slate-500">Belum ada dokumentasi kegiatan.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
