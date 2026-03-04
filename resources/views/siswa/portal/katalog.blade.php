@extends('layouts.siswa', ['title' => 'Katalog - Siswa', 'activeMenu' => 'katalog'])

@section('content')
<section class="rounded-2xl border border-sky-100 bg-white p-6 shadow-sm md:p-8">
    @include('tamu.partials.filter-katalog', ['actionUrl' => route('siswa.katalog')])
    @include('tamu.partials.tabel-katalog')
</section>
@endsection
