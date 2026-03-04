@extends('layouts.admin', ['title' => 'Siswa'])
@section('content')
<div class="mb-5 flex items-center justify-between">
    <h2 class="text-2xl font-bold">Siswa</h2>
    <a href="{{ route('admin.siswa.create') }}" class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white">Tambah Siswa</a>
</div>
@if(session('success'))<div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">{{ session('success') }}</div>@endif

<form id="siswaFilterForm" method="GET" action="{{ route('admin.siswa.index') }}" class="mb-4 grid gap-2 md:grid-cols-2">
    <input
        id="siswaSearchInput"
        type="text"
        name="q"
        value="{{ $q ?? '' }}"
        placeholder="Search nama atau NISN..."
        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"
    >
    <select id="siswaKelasFilter" name="kelas_id" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
        <option value="">Semua Kelas</option>
        @foreach(($daftarKelas ?? []) as $item)
            <option value="{{ $item->id }}" @selected((string) ($kelasId ?? '') === (string) $item->id)>{{ $item->nama_kelas }}</option>
        @endforeach
    </select>
</form>

<div class="overflow-x-auto rounded-xl border bg-white">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50"><tr><th class="px-4 py-3 text-left">No</th><th class="px-4 py-3 text-left">NISN</th><th class="px-4 py-3 text-left">Nama</th><th class="px-4 py-3 text-left">Kelas</th><th class="px-4 py-3 text-left">Aksi</th></tr></thead>
        <tbody>
        @forelse($daftarSiswa as $item)
            <tr class="border-t"><td class="px-4 py-3">{{ $daftarSiswa->firstItem() + $loop->index }}</td><td class="px-4 py-3">{{ $item->nisn }}</td><td class="px-4 py-3">{{ $item->nama }}</td><td class="px-4 py-3">{{ $item->kelas->nama_kelas ?? '-' }}</td><td class="px-4 py-3"><div class="flex gap-2"><a href="{{ route('admin.siswa.show', $item) }}" class="rounded border px-2 py-1">Detail</a><a href="{{ route('admin.siswa.edit', $item) }}" class="rounded border px-2 py-1">Edit</a><form method="POST" action="{{ route('admin.siswa.destroy', $item) }}" onsubmit="return confirm('Hapus siswa ini?')">@csrf @method('DELETE')<button class="rounded border border-rose-200 bg-rose-50 px-2 py-1 text-rose-700">Hapus</button></form></div></td></tr>
        @empty
            <tr><td class="px-4 py-6 text-center text-slate-500" colspan="5">Belum ada data siswa.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $daftarSiswa->links() }}</div>

<script>
    (() => {
        const form = document.getElementById('siswaFilterForm');
        const search = document.getElementById('siswaSearchInput');
        const kelasFilter = document.getElementById('siswaKelasFilter');
        if (!form || !search || !kelasFilter) return;

        let timer = null;
        let lastSearchValue = search.value;
        search.addEventListener('input', () => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                const currentValue = search.value;
                if (currentValue === lastSearchValue) return;
                lastSearchValue = currentValue;
                form.submit();
            }, 900);
        });

        kelasFilter.addEventListener('change', () => form.submit());
    })();
</script>
@endsection
