@extends('layouts.admin', ['title' => 'Data Buku'])

@section('content')
<div class="mb-5 flex items-center justify-between">
    <h2 class="text-2xl font-bold">Data Buku</h2>
    <a href="{{ route('admin.buku.create') }}" class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-800">
        Tambah Buku
    </a>
</div>

@if(session('success'))
    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto rounded-xl border bg-white">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50 text-slate-600">
            <tr>
                <th class="px-4 py-3 text-left">Sampul</th>
                <th class="px-4 py-3 text-left">Kode</th>
                <th class="px-4 py-3 text-left">Judul</th>
                <th class="px-4 py-3 text-left">Kategori</th>
                <th class="px-4 py-3 text-left">Rak</th>
                <th class="px-4 py-3 text-left">Stok</th>
                <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($daftarBuku as $buku)
                <tr class="border-t">
                    <td class="px-4 py-3">
                        @if($buku->gambar_sampul)
                            <img src="{{ asset('storage/' . $buku->gambar_sampul) }}" alt="{{ $buku->judul }}" class="h-14 w-10 rounded object-cover">
                        @else
                            <div class="flex h-14 w-10 items-center justify-center rounded border border-dashed border-slate-300 bg-slate-50 text-[10px] text-slate-400">
                                No Cover
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $buku->kode_buku }}</td>
                    <td class="px-4 py-3">{{ $buku->judul }}</td>
                    <td class="px-4 py-3">{{ $buku->kategori->nama_kategori ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $buku->rak->nomor_rak ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $buku->stok_tersedia }}/{{ $buku->stok_total }}</td>
                    <td class="px-4 py-3">
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('admin.buku.show', $buku) }}" class="rounded border px-2 py-1">Detail</a>
                            <a href="{{ route('admin.buku.edit', $buku) }}" class="rounded border px-2 py-1">Edit</a>
                            <form method="POST" action="{{ route('admin.buku.destroy', $buku) }}" onsubmit="return confirm('Hapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="rounded border border-rose-200 bg-rose-50 px-2 py-1 text-rose-700">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-6 text-center text-slate-500">Belum ada data buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
