@extends('layouts.admin', ['title' => 'Rak'])
@section('content')
<div class="mb-5 flex items-center justify-between">
    <h2 class="text-2xl font-bold">Rak</h2>
    <a href="{{ route('admin.rak.create') }}" class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white">Tambah Rak</a>
</div>
@if(session('success'))<div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">{{ session('success') }}</div>@endif
<div class="overflow-x-auto rounded-xl border bg-white">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50"><tr><th class="px-4 py-3 text-left">Nomor Rak</th><th class="px-4 py-3 text-left">Keterangan</th><th class="px-4 py-3 text-left">Aksi</th></tr></thead>
        <tbody>
        @forelse($daftarRak as $item)
            <tr class="border-t"><td class="px-4 py-3">{{ $item->nomor_rak }}</td><td class="px-4 py-3">{{ $item->keterangan ?? '-' }}</td><td class="px-4 py-3"><div class="flex gap-2"><a href="{{ route('admin.rak.edit', $item) }}" class="rounded border px-2 py-1">Edit</a><form method="POST" action="{{ route('admin.rak.destroy', $item) }}" onsubmit="return confirm('Hapus rak ini?')">@csrf @method('DELETE')<button class="rounded border border-rose-200 bg-rose-50 px-2 py-1 text-rose-700">Hapus</button></form></div></td></tr>
        @empty
            <tr><td class="px-4 py-6 text-center text-slate-500" colspan="3">Belum ada data rak.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
