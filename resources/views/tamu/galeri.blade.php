@extends($layout ?? 'layouts.app', ['title' => $title ?? 'Galeri - Perpustakaan Sekolah', 'activeMenu' => $activeMenu ?? 'galeri'])

@section('content')
@php
    $items = collect(method_exists($dokumentasiGaleri, 'items') ? $dokumentasiGaleri->items() : $dokumentasiGaleri);
    $headline = $items->first();
    $pendamping = $items->slice(1, 3);
    $beritaList = $items;

    $detailUrl = function ($item) {
        return request()->routeIs('siswa.*')
            ? (!empty($item->slug) ? route('siswa.galeri.detail', $item) : route('siswa.galeri.detail.id', $item->id))
            : (!empty($item->slug) ? route('galeri.detail', $item) : route('galeri.detail.id', $item->id));
    };

    $imageUrl = function ($item) {
        return $item->foto ? asset('storage/' . $item->foto) : asset('images/perpus/perpus-smekda.jpeg');
    };
@endphp

<section class="mb-6 border-b border-slate-200 pb-4">
    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-rose-600">Portal Galeri</p>
    <h1 class="mt-2 text-3xl font-black text-slate-900 md:text-4xl">Galeri Kegiatan Perpustakaan</h1>
    <p class="mt-2 text-slate-600">Dokumentasi kegiatan literasi, layanan, dan aktivitas siswa di perpustakaan sekolah.</p>

    <form id="galeriSearchForm" method="GET" action="{{ request()->routeIs('siswa.*') ? route('siswa.galeri') : route('galeri') }}" class="mt-4 flex justify-end">
        <div class="w-full max-w-md">
        <input
            id="galeriSearchInput"
            type="text"
            name="q"
            value="{{ $q ?? '' }}"
            placeholder="Cari judul atau isi berita dokumentasi"
            class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm"
        >
        </div>
    </form>
</section>

@if($headline)
    <section class="mb-8 grid gap-5 lg:grid-cols-[1.2fr_0.8fr]">
        <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <a href="{{ $detailUrl($headline) }}" class="block">
                <img src="{{ $imageUrl($headline) }}" alt="{{ $headline->judul }}" class="h-72 w-full object-cover md:h-[420px]">
            </a>
            <div class="p-6">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Headline | {{ optional($headline->tanggal_kegiatan)->format('d F Y') ?: '-' }}</p>
                <h2 class="mt-2 text-2xl font-black leading-tight text-slate-900">
                    <a href="{{ $detailUrl($headline) }}" class="hover:text-sky-700">{{ $headline->judul }}</a>
                </h2>
                <p class="mt-3 text-slate-700">{{ \Illuminate\Support\Str::limit($headline->deskripsi ?: 'Belum ada deskripsi kegiatan.', 220) }}</p>
                <a href="{{ $detailUrl($headline) }}" class="mt-4 inline-flex rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Baca Selengkapnya</a>
            </div>
        </article>

        <div class="space-y-4">
            @forelse($pendamping as $item)
                <article class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                    <a href="{{ $detailUrl($item) }}" class="grid md:grid-cols-[140px_1fr] lg:grid-cols-[120px_1fr]">
                        <img src="{{ $imageUrl($item) }}" alt="{{ $item->judul }}" class="h-full min-h-[120px] w-full object-cover">
                        <div class="p-4">
                            <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">{{ optional($item->tanggal_kegiatan)->format('d M Y') ?: '-' }}</p>
                            <h3 class="mt-1 line-clamp-2 text-lg font-bold leading-tight text-slate-900">{{ $item->judul }}</h3>
                            <p class="mt-2 line-clamp-2 text-sm text-slate-600">{{ $item->deskripsi ?: 'Belum ada deskripsi kegiatan.' }}</p>
                        </div>
                    </a>
                </article>
            @empty
                <article class="rounded-xl border border-dashed border-slate-300 bg-white p-6 text-sm text-slate-500">
                    Belum ada dokumentasi pendamping.
                </article>
            @endforelse
        </div>
    </section>
@endif

<section class="grid gap-6 lg:grid-cols-[1fr_320px]">
    <div>
        <div class="mb-4 flex items-center justify-between border-b border-slate-200 pb-3">
            <h2 class="text-2xl font-black text-slate-900">Semua Artikel Galeri</h2>
            <span class="text-sm font-semibold text-slate-500">Total: {{ method_exists($dokumentasiGaleri, 'total') ? $dokumentasiGaleri->total() : $items->count() }}</span>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            @forelse($beritaList as $item)
                <article class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                    <a href="{{ $detailUrl($item) }}" class="block">
                        <img src="{{ $imageUrl($item) }}" alt="{{ $item->judul }}" class="h-44 w-full object-cover">
                    </a>
                    <div class="p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">{{ optional($item->tanggal_kegiatan)->format('d M Y') ?: '-' }}</p>
                        <h3 class="mt-1 line-clamp-2 text-lg font-bold leading-tight text-slate-900">
                            <a href="{{ $detailUrl($item) }}" class="hover:text-sky-700">{{ $item->judul }}</a>
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
            <h3 class="text-lg font-black text-slate-900">Tentang Galeri</h3>
            <p class="mt-2 text-sm text-slate-600">Galeri ini menampilkan dokumentasi kegiatan perpustakaan yang telah dipublikasikan admin sekolah.</p>
        </section>

        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-black text-slate-900">Navigasi Cepat</h3>
            <div class="mt-3 space-y-2 text-sm">
                <a href="{{ request()->routeIs('siswa.*') ? route('siswa.beranda') : route('beranda') }}" class="block rounded-md border border-slate-200 px-3 py-2 text-slate-700 hover:bg-slate-50">Beranda</a>
                <a href="{{ request()->routeIs('siswa.*') ? route('siswa.katalog') : route('katalog') }}" class="block rounded-md border border-slate-200 px-3 py-2 text-slate-700 hover:bg-slate-50">Katalog Buku</a>
                <a href="{{ request()->routeIs('siswa.*') ? route('siswa.informasi') : route('informasi') }}" class="block rounded-md border border-slate-200 px-3 py-2 text-slate-700 hover:bg-slate-50">Informasi Layanan</a>
            </div>
        </section>
    </aside>
</section>

@if(method_exists($dokumentasiGaleri, 'links'))
    <div class="mt-6 rounded-lg border border-slate-200 bg-white px-3 py-2">
        {{ $dokumentasiGaleri->onEachSide(1)->links() }}
    </div>
@endif

<script>
    (() => {
        const form = document.getElementById('galeriSearchForm');
        const input = document.getElementById('galeriSearchInput');
        if (!form || !input) return;

        let timer = null;
        input.addEventListener('input', () => {
            clearTimeout(timer);
            timer = setTimeout(() => form.submit(), 350);
        });
    })();
</script>
@endsection
