@extends($layout ?? 'layouts.app', ['title' => $title ?? 'Katalog - Perpustakaan Sekolah', 'activeMenu' => $activeMenu ?? null])

@section('content')
<section class="rounded-2xl border border-sky-100 bg-white p-6 shadow-sm md:p-8">
    @include('tamu.partials.filter-katalog', ['actionUrl' => $actionUrl ?? route('katalog')])
    @include('tamu.partials.tabel-katalog')
</section>
@endsection
