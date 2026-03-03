@extends('layouts.app', ['title' => 'Informasi - Perpustakaan Sekolah'])

@section('content')
<section class="rounded-2xl border border-sky-100 bg-white p-6 shadow-sm md:p-8">
    <h1 class="text-3xl font-black text-sky-900">Informasi Layanan</h1>
    <p class="mt-2 text-slate-600">
        Informasi umum perpustakaan untuk siswa, guru, dan petugas.
    </p>
</section>

@include('tamu.partials.informasi')
@endsection
