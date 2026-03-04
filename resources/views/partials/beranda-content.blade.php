@php
    $isSiswaPage = request()->routeIs('siswa.*');
    $dokumen = collect($dokumentasi ?? []);

    $headline = $dokumen->first();
    $headlinePendamping = $dokumen->slice(1, 2);
    $beritaTerbaru = $dokumen->slice(3, 6);

    $routeGaleri = $isSiswaPage ? route('siswa.galeri') : route('galeri');
    $routeKatalog = $isSiswaPage ? route('siswa.katalog') : route('katalog');
    $detailRouteName = $isSiswaPage ? 'siswa.galeri.detail' : 'galeri.detail';
    $detailFallbackRouteName = $isSiswaPage ? 'siswa.galeri.detail.id' : 'galeri.detail.id';

    $linkDetail = function ($item) use ($detailRouteName, $detailFallbackRouteName) {
        if (!empty($item->slug)) {
            return route($detailRouteName, $item);
        }

        return route($detailFallbackRouteName, $item->id);
    };
@endphp

<section class="relative -mt-2 mb-10 overflow-hidden bg-white">
    <div class="relative">
        <img
            src="{{ asset('images/perpus/perpus-smekda.jpeg') }}"
            alt="SMK Negeri 2 Padang Panjang"
            class="h-[320px] w-full object-cover md:h-[460px]"
            onerror="this.onerror=null;this.src='{{ asset('images/logo-sekolah.jpeg') }}';"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-black/15 to-white/10"></div>
        <div class="absolute inset-x-0 bottom-0 mx-5 mb-5 text-white md:mx-10 md:mb-10">
            <p class="inline-block border-b-2 border-amber-300 pb-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-100">Perpustakaan Sekolah</p>
            <h1 class="mt-2 text-3xl font-black uppercase drop-shadow md:text-6xl">Selamat Datang</h1>
            <p class="mt-2 text-2xl font-semibold text-amber-200 drop-shadow md:text-5xl">SMK Negeri 2 Padang Panjang</p>
            <p class="mt-4 max-w-3xl text-sm text-slate-100 drop-shadow md:text-xl">Jalan Syekh Ibrahim Musa No.26, Ganting, Padang Panjang Timur</p>
        </div>
    </div>
</section>

<section class="mb-6 border-b border-slate-200 pb-4">
    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-rose-600">Portal Berita Perpustakaan</p>
    <h1 class="mt-2 text-3xl font-black text-slate-900 md:text-4xl">Berita dan Dokumentasi Kegiatan Perpustakaan</h1>
    <p class="mt-2 text-slate-600">Informasi terbaru seputar aktivitas literasi, layanan perpustakaan, dan kegiatan siswa SMK Negeri 2 Padang Panjang.</p>
</section>

@if($headline)
    <section class="mb-8 grid gap-5 lg:grid-cols-[1.2fr_0.8fr]">
        <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <a href="{{ $linkDetail($headline) }}" class="block">
                <img
                    src="{{ $headline->foto ? asset('storage/' . $headline->foto) : asset('images/perpus/perpus-smekda.jpeg') }}"
                    alt="{{ $headline->judul }}"
                    class="h-72 w-full object-cover md:h-[420px]"
                >
            </a>
            <div class="p-6">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Headline | {{ optional($headline->tanggal_kegiatan)->format('d F Y') ?: '-' }}</p>
                <h2 class="mt-2 text-2xl font-black leading-tight text-slate-900">
                    <a href="{{ $linkDetail($headline) }}" class="hover:text-sky-700">{{ $headline->judul }}</a>
                </h2>
                <p class="mt-3 text-slate-700">{{ \Illuminate\Support\Str::limit($headline->deskripsi ?: 'Belum ada deskripsi kegiatan.', 220) }}</p>
                <a href="{{ $linkDetail($headline) }}" class="mt-4 inline-flex rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Baca Selengkapnya</a>
            </div>
        </article>

        <div class="space-y-4">
            @forelse($headlinePendamping as $item)
                <article class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                    <a href="{{ $linkDetail($item) }}" class="grid md:grid-cols-[140px_1fr] lg:grid-cols-[120px_1fr]">
                        <img src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('images/perpus/perpus-smekda.jpeg') }}" alt="{{ $item->judul }}" class="h-full min-h-[120px] w-full object-cover">
                        <div class="p-4">
                            <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">{{ optional($item->tanggal_kegiatan)->format('d M Y') ?: '-' }}</p>
                            <h3 class="mt-1 line-clamp-2 text-lg font-bold leading-tight text-slate-900">{{ $item->judul }}</h3>
                            <p class="mt-2 line-clamp-2 text-sm text-slate-600">{{ $item->deskripsi ?: 'Belum ada deskripsi kegiatan.' }}</p>
                        </div>
                    </a>
                </article>
            @empty
                <article class="rounded-xl border border-dashed border-slate-300 bg-white p-6 text-sm text-slate-500">
                    Belum ada dokumentasi tambahan untuk headline.
                </article>
            @endforelse

            <a href="{{ $routeGaleri }}" class="inline-flex w-full items-center justify-center rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                Lihat Semua Berita Galeri
            </a>
        </div>
    </section>
@endif

<section class="grid gap-6 lg:grid-cols-[1fr_320px]">
    <div>
        <div class="mb-4 flex items-center justify-between border-b border-slate-200 pb-3">
            <h2 class="text-2xl font-black text-slate-900">Berita Terbaru</h2>
            <a href="{{ $routeGaleri }}" class="text-sm font-semibold text-sky-700 hover:text-sky-900">Arsip Galeri</a>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            @forelse($beritaTerbaru as $item)
                <article class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                    <a href="{{ $linkDetail($item) }}" class="block">
                        <img src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('images/perpus/perpus-smekda.jpeg') }}" alt="{{ $item->judul }}" class="h-44 w-full object-cover">
                    </a>
                    <div class="p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">{{ optional($item->tanggal_kegiatan)->format('d M Y') ?: '-' }}</p>
                        <h3 class="mt-1 line-clamp-2 text-lg font-bold leading-tight text-slate-900">
                            <a href="{{ $linkDetail($item) }}" class="hover:text-sky-700">{{ $item->judul }}</a>
                        </h3>
                        <p class="mt-2 line-clamp-3 text-sm text-slate-600">{{ $item->deskripsi ?: 'Belum ada deskripsi kegiatan.' }}</p>
                    </div>
                </article>
            @empty
                <article class="rounded-xl border border-dashed border-slate-300 bg-white p-6 text-sm text-slate-500 md:col-span-2">
                    Belum ada dokumentasi yang dipublikasikan.
                </article>
            @endforelse
        </div>
    </div>

    <aside class="space-y-4">
        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-black text-slate-900">Ringkasan Perpustakaan</h3>
            <div class="mt-3 space-y-2 text-sm text-slate-700">
                <p><span class="font-semibold">Total Buku:</span> {{ number_format($statistik['total_buku'] ?? 0, 0, ',', '.') }}</p>
                <p><span class="font-semibold">Kategori Aktif:</span> {{ number_format($statistik['total_kategori'] ?? 0, 0, ',', '.') }}</p>
                <p><span class="font-semibold">Buku Tersedia:</span> {{ number_format($statistik['buku_tersedia'] ?? 0, 0, ',', '.') }}</p>
            </div>
            <a href="{{ $routeKatalog }}" class="mt-4 inline-flex w-full items-center justify-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                Buka Katalog
            </a>
        </section>

        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-black text-slate-900">Layanan Cepat</h3>
            <ul class="mt-3 space-y-2 text-sm text-slate-700">
                @forelse(($layanan ?? []) as $item)
                    <li class="rounded-md bg-slate-50 px-3 py-2">{{ $item }}</li>
                @empty
                    <li class="text-slate-500">Belum ada info layanan.</li>
                @endforelse
            </ul>
        </section>
    </aside>
</section>
