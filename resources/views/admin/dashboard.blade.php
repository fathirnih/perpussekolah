@extends('layouts.admin', ['title' => 'Dashboard Admin'])

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Dashboard Admin</h2>
    <p class="mt-1 text-sm text-slate-600">Ringkasan data utama perpustakaan sekolah.</p>
</div>

<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
    <article class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Admin</p>
        <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($ringkasan['admin'] ?? 0, 0, ',', '.') }}</p>
    </article>
    <article class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Petugas</p>
        <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($ringkasan['petugas'] ?? 0, 0, ',', '.') }}</p>
    </article>
    <article class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Siswa</p>
        <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($ringkasan['siswa'] ?? 0, 0, ',', '.') }}</p>
    </article>
    <article class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Buku</p>
        <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($ringkasan['buku'] ?? 0, 0, ',', '.') }}</p>
    </article>
    <article class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Peminjaman</p>
        <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($ringkasan['peminjaman'] ?? 0, 0, ',', '.') }}</p>
    </article>
</div>
@endsection
