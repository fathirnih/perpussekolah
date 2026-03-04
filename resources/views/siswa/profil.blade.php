@extends('layouts.siswa', ['title' => 'Profil Siswa'])

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Profil Siswa</h2>
    <p class="mt-1 text-sm text-slate-600">Kelola data akun dan foto profil kamu.</p>
</div>

@if(session('success'))
    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('siswa.profil.update') }}" enctype="multipart/form-data" class="rounded-xl border bg-white p-5">
    @csrf
    @method('PUT')

    <div class="grid gap-4 md:grid-cols-[220px_1fr]">
        <div>
            @if($siswa->foto_profil)
                <img src="{{ asset('storage/' . $siswa->foto_profil) }}" alt="Foto profil siswa" class="h-48 w-full rounded-lg border object-cover">
            @else
                <div class="flex h-48 w-full items-center justify-center rounded-lg border bg-slate-50 text-sm text-slate-400">Belum ada foto</div>
            @endif
            <label class="mt-3 block text-sm font-medium">Foto Profil</label>
            <input type="file" name="foto_profil" accept=".jpg,.jpeg,.png,.webp" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div><label class="mb-1 block text-sm font-medium">NISN</label><input value="{{ $siswa->nisn }}" class="w-full rounded-lg border border-slate-300 bg-slate-100 px-3 py-2" disabled></div>
            <div>
                <label class="mb-1 block text-sm font-medium">Nama</label>
                <input value="{{ $siswa->nama }}" class="w-full rounded-lg border border-slate-300 bg-slate-100 px-3 py-2" disabled>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Kelas</label>
                <input value="{{ $siswa->kelas->nama_kelas ?? '-' }}" class="w-full rounded-lg border border-slate-300 bg-slate-100 px-3 py-2" disabled>
            </div>
            <div><label class="mb-1 block text-sm font-medium">Email</label><input type="email" name="email" value="{{ old('email', $siswa->email) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2"></div>
            <div><label class="mb-1 block text-sm font-medium">No HP</label><input name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2"></div>
            <div><label class="mb-1 block text-sm font-medium">Password Baru</label><input type="password" name="password" class="w-full rounded-lg border border-slate-300 px-3 py-2"></div>
            <div class="md:col-span-2"><label class="mb-1 block text-sm font-medium">Alamat</label><textarea name="alamat" class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('alamat', $siswa->alamat) }}</textarea></div>
        </div>
    </div>

    @if($errors->any())
        <div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
            <ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="mt-6">
        <button class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white">Simpan Perubahan</button>
    </div>
</form>
@endsection
