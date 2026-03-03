@extends('layouts.app', ['title' => 'Beranda - Perpustakaan Sekolah'])

@section('content')
<section class="grid gap-6 md:grid-cols-[1.2fr_0.8fr]">
    @include('tamu.partials.hero')
</section>

@include('tamu.partials.statistik')
@endsection
