@extends($layout ?? 'layouts.app', ['title' => $title ?? 'Beranda - Perpustakaan Sekolah', 'activeMenu' => $activeMenu ?? null])

@section('content')
@include('partials.beranda-content')
@endsection
