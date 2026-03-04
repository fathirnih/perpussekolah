@extends('layouts.app', ['title' => 'Katalog - Perpustakaan Sekolah'])

@section('content')
<section class="rounded-2xl border border-sky-100 bg-white p-6 shadow-sm md:p-8">
    @include('tamu.partials.filter-katalog')
    @include('tamu.partials.tabel-katalog')
</section>
@endsection
