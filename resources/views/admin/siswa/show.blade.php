@extends('layouts.admin', ['title' => 'Detail Siswa'])
@section('content')
<div class="mb-5 flex items-center justify-between">
    <h2 class="text-2xl font-bold">Detail Siswa</h2>
    <a href="{{ route('admin.siswa.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">Kembali</a>
</div>

<div class="rounded-xl border bg-white p-5">
    <div class="mb-4 flex justify-center">
        <div class="text-center">
            @if($siswa->foto_profil)
                <div class="inline-flex aspect-square overflow-hidden rounded-full border border-slate-200 bg-slate-50" style="width: 9rem; height: 9rem;">
                    <img src="{{ asset('storage/' . $siswa->foto_profil) }}" alt="Foto profil {{ $siswa->nama }}" class="h-full w-full object-cover object-center">
                </div>
            @else
                <div class="inline-flex aspect-square items-center justify-center rounded-full border bg-slate-50 text-sm text-slate-400" style="width: 9rem; height: 9rem;">Belum ada foto</div>
            @endif
        </div>
    </div>

    <div class="grid gap-3 text-sm md:grid-cols-2">
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">NISN:</span> {{ $siswa->nisn }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Nama:</span> {{ $siswa->nama }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Kelas:</span> {{ $siswa->kelas->nama_kelas ?? '-' }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Email:</span> {{ $siswa->email ?: '-' }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">No HP:</span> {{ $siswa->no_hp ?: '-' }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Dibuat:</span> {{ optional($siswa->created_at)->format('d M Y H:i') ?: '-' }}</div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 md:col-span-2"><span class="font-semibold">Alamat:</span> {{ $siswa->alamat ?: '-' }}</div>
    </div>
</div>
@endsection
