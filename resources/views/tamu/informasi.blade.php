@extends($layout ?? 'layouts.app', ['title' => $title ?? 'Informasi - Perpustakaan Sekolah', 'activeMenu' => $activeMenu ?? null])

@section('content')
@php
    $isSiswaPage = request()->routeIs('siswa.*');
    $routeKatalog = $isSiswaPage ? route('siswa.katalog') : route('katalog');
    $routeKontak = $isSiswaPage ? route('siswa.kontak') : route('kontak');
@endphp

<section class="relative left-1/2 right-1/2 w-screen -translate-x-1/2 overflow-hidden shadow-sm">
    <div class="relative h-[320px] md:h-[460px]">
        <img
            src="{{ asset('images/perpus/perpus-smekda.jpeg') }}"
            alt="Perpustakaan SMKN 2 Padang Panjang"
            class="absolute inset-0 h-full w-full object-cover"
            onerror="this.onerror=null;this.src='{{ asset('images/logo-sekolah.jpeg') }}';"
        >
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/75 via-slate-900/45 to-slate-900/25"></div>
        <div class="absolute inset-0 flex items-end">
            <div class="w-full px-6 pb-6 md:px-10 md:pb-10">
                <p class="inline-flex rounded-full bg-white/20 px-3 py-1 text-xs font-semibold uppercase tracking-[0.14em] text-sky-100">Informasi Perpustakaan</p>
                <h1 class="mt-3 text-3xl font-black text-white md:text-4xl">Layanan Perpustakaan SMKN 2 Padang Panjang</h1>
                <p class="mt-3 max-w-2xl text-slate-100">
                    Halaman ini memuat informasi penting layanan perpustakaan, jam operasional, akses lokasi, dan panduan untuk siswa maupun pengunjung.
                </p>
                <div class="mt-5 flex flex-wrap gap-2">
                    <a href="{{ $routeKatalog }}" class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-800">Buka Katalog</a>
                    <a href="{{ $routeKontak }}" class="rounded-lg border border-white/60 bg-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/20">Kontak Perpustakaan</a>
                </div>
            </div>
        </div>
    </div>
</section>

@php
    $alamatPerpus = 'SMKN 2 Padang Panjang, Jalan Syekh Ibrahim Musa No.26, Ganting, Padang Panjang Timur';
    $qMap = urlencode($alamatPerpus);
@endphp

<section class="relative left-1/2 right-1/2 mt-8 w-screen -translate-x-1/2 overflow-hidden bg-white">
    <div class="relative h-[320px] md:h-[460px]">
        <iframe
            src="https://maps.google.com/maps?q={{ $qMap }}&t=&z=15&ie=UTF8&iwloc=&output=embed"
            class="h-full w-full border-0"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Lokasi Perpustakaan SMKN 2 Padang Panjang"
        ></iframe>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-slate-900/20 to-transparent"></div>
        <div class="absolute inset-0 flex items-end">
            <div class="w-full px-5 pb-5 text-white md:px-10 md:pb-10">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-100">Lokasi Perpustakaan</p>
                <h2 class="mt-2 max-w-4xl text-2xl font-black leading-tight md:text-4xl">Akses Langsung ke Perpustakaan SMKN 2 Padang Panjang</h2>
                <p class="mt-2 max-w-3xl text-sm text-slate-100 md:text-lg">{{ $alamatPerpus }}</p>
                <a
                    href="https://www.google.com/maps/search/?api=1&query={{ $qMap }}"
                    target="_blank"
                    rel="noopener"
                    class="mt-4 inline-flex rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-slate-100"
                >
                    Buka di Google Maps
                </a>
            </div>
        </div>
    </div>
</section>

@include('tamu.partials.informasi')
@endsection
