@extends($layout ?? 'layouts.app', ['title' => $title ?? 'Detail Galeri', 'activeMenu' => $activeMenu ?? 'galeri'])

@section('content')
@php
    $heroImage = $dokumentasiItem->foto ? asset('storage/' . $dokumentasiItem->foto) : asset('images/perpus/perpus-smekda.jpeg');
    $estimatedReadMinutes = max(1, (int) ceil(str_word_count(strip_tags($dokumentasiItem->deskripsi ?? '')) / 160));
@endphp

<section class="mb-5 border-b border-slate-200 pb-4">
    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">
        <a href="{{ $galeriUrl }}" class="hover:text-slate-700">Galeri</a>
        <span class="mx-1">/</span>
        <span>Detail Artikel</span>
    </p>
</section>

<section class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_320px]">
    <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="p-6 md:p-8">
            <p class="inline-flex rounded-full bg-sky-50 px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-sky-700">
                Dokumentasi Perpustakaan
            </p>
            <h1 class="mt-3 text-3xl font-black leading-tight text-slate-900 md:text-4xl">{{ $dokumentasiItem->judul }}</h1>
            <div class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500">
                <span>{{ optional($dokumentasiItem->tanggal_kegiatan)->format('d F Y') ?: '-' }}</span>
                <span>Admin Perpustakaan</span>
                <span>{{ $estimatedReadMinutes }} menit baca</span>
            </div>
        </div>

        <figure class="border-y border-slate-200 bg-slate-100">
            <img src="{{ $heroImage }}" alt="{{ $dokumentasiItem->judul }}" class="h-72 w-full object-cover md:h-[430px]">
            <figcaption class="px-6 py-3 text-xs text-slate-500 md:px-8">
                Dokumentasi kegiatan perpustakaan sekolah.
            </figcaption>
        </figure>

        <div class="p-6 md:p-8">
            <div class="prose prose-slate max-w-none leading-8">
                {!! nl2br(e($dokumentasiItem->deskripsi ?: 'Belum ada deskripsi kegiatan.')) !!}
            </div>

            <div class="mt-8 border-t border-slate-200 pt-5">
                <a href="{{ $galeriUrl }}" class="inline-flex rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Kembali ke Galeri
                </a>
            </div>
        </div>
    </article>

    <aside class="space-y-4">
        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-lg font-black text-slate-900">Tentang Artikel</h2>
            <p class="mt-2 text-sm leading-7 text-slate-600">
                Konten ini adalah dokumentasi kegiatan perpustakaan yang dipublikasikan untuk siswa dan pengunjung.
            </p>
        </section>

        @if($dokumentasiLain->isNotEmpty())
            <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-lg font-black text-slate-900">Artikel Terkait</h2>
                <div class="mt-3 space-y-3">
                    @foreach($dokumentasiLain as $item)
                        @php
                            $detailUrl = request()->routeIs('siswa.*')
                                ? (!empty($item->slug) ? route('siswa.galeri.detail', $item) : route('siswa.galeri.detail.id', $item->id))
                                : (!empty($item->slug) ? route('galeri.detail', $item) : route('galeri.detail.id', $item->id));
                            $thumb = $item->foto ? asset('storage/' . $item->foto) : asset('images/perpus/perpus-smekda.jpeg');
                        @endphp
                        <a href="{{ $detailUrl }}" class="block rounded-lg border border-slate-200 p-2.5 transition hover:bg-slate-50">
                            <div class="grid grid-cols-[88px_1fr] gap-3">
                                <img src="{{ $thumb }}" alt="{{ $item->judul }}" class="h-20 w-full rounded-md object-cover">
                                <div>
                                    <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">{{ optional($item->tanggal_kegiatan)->format('d M Y') ?: '-' }}</p>
                                    <p class="mt-1 line-clamp-2 text-sm font-bold leading-5 text-slate-900">{{ $item->judul }}</p>
                                    <p class="mt-1 line-clamp-2 text-xs text-slate-600">{{ \Illuminate\Support\Str::words($item->deskripsi ?: '', 10) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </aside>
</section>
@endsection
