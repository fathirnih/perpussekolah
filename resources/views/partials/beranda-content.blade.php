@php
    $isSiswaPage = request()->routeIs('siswa.*');
    $dokumen = collect($dokumentasi ?? []);
    $peminjamAktif = collect($topPeminjam ?? []);

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

<section class="relative left-1/2 right-1/2 -mt-2 mb-10 w-screen -translate-x-1/2 overflow-hidden bg-white">
    <div class="relative">
        <img
            src="{{ asset('images/perpus/perpus-smekda.jpeg') }}"
            alt="SMK Negeri 2 Padang Panjang"
            class="h-[320px] w-full object-cover md:h-[460px]"
            onerror="this.onerror=null;this.src='{{ asset('images/logo-sekolah.jpeg') }}';"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/55 via-slate-900/20 to-white/5"></div>
        <div class="absolute inset-0 flex items-end bg-slate-900/20 backdrop-blur-[3px]">
            <div class="w-full px-5 pb-5 text-white md:px-10 md:pb-10">
                <p class="inline-block border-b-2 border-amber-300 pb-1 text-xs font-semibold uppercase tracking-[0.22em] text-slate-100">Perpustakaan Sekolah</p>
                <h1 class="mt-2 max-w-5xl text-2xl font-black uppercase leading-tight drop-shadow md:text-5xl">Selamat Datang di Perpustakaan SMKN 2 Padang Panjang</h1>
                <p class="mt-2 max-w-4xl text-lg font-semibold text-amber-200 drop-shadow md:text-3xl">Pusat Literasi, Referensi, dan Ruang Belajar Siswa</p>
                <p class="mt-4 max-w-4xl text-sm text-slate-100 drop-shadow md:text-lg">Perpustakaan sekolah hadir untuk mendukung budaya baca, pembelajaran aktif, dan penguatan karakter melalui koleksi buku yang lengkap.</p>
            </div>
        </div>
    </div>
</section>

<section class="mb-8">
    <div class="mb-4 flex items-center justify-between border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-black text-slate-900">Layanan Perpustakaan</h2>
        <a href="{{ $routeKatalog }}" class="text-sm font-semibold text-sky-700 hover:text-sky-900">Lihat Katalog</a>
    </div>
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Layanan 01</p>
            <h3 class="mt-1 text-lg font-bold text-slate-900">Peminjaman Buku</h3>
            <p class="mt-2 text-sm text-slate-600">Siswa dapat memilih judul buku dari katalog lalu mengajukan peminjaman melalui akun siswa.</p>
        </article>
        <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Layanan 02</p>
            <h3 class="mt-1 text-lg font-bold text-slate-900">Pengembalian Buku</h3>
            <p class="mt-2 text-sm text-slate-600">Pengembalian diverifikasi petugas agar stok buku kembali tersedia untuk siswa lain.</p>
        </article>
        <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Layanan 03</p>
            <h3 class="mt-1 text-lg font-bold text-slate-900">Baca di Tempat</h3>
            <p class="mt-2 text-sm text-slate-600">Buku referensi tertentu tersedia untuk dibaca langsung di area perpustakaan sekolah.</p>
        </article>
        <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Layanan 04</p>
            <h3 class="mt-1 text-lg font-bold text-slate-900">Bantuan Literasi</h3>
            <p class="mt-2 text-sm text-slate-600">Petugas membantu pencarian buku berdasarkan mata pelajaran, penulis, kategori, dan rak.</p>
        </article>
    </div>
</section>

<section class="mb-8">
    <div class="mb-4 flex items-center justify-between border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-black text-slate-900">Apresiasi Siswa Peminjam Aktif</h2>
        <p class="text-sm font-semibold text-slate-500">Semester Berjalan</p>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        @forelse($peminjamAktif as $item)
            <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="h-12 w-12 shrink-0 overflow-hidden rounded-full border border-slate-200 bg-slate-100">
                        @if(!empty($item->foto_profil))
                            <img src="{{ asset('storage/' . $item->foto_profil) }}" alt="{{ $item->nama }}" class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full w-full items-center justify-center text-xs font-bold text-slate-500">{{ strtoupper(\Illuminate\Support\Str::substr($item->nama ?? 'S', 0, 1)) }}</div>
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-base font-bold text-slate-900">{{ $item->nama }}</p>
                        <p class="text-sm text-slate-600">{{ $item->kelas ?: 'Kelas belum diisi' }}</p>
                    </div>
                </div>

                <div class="mt-3 rounded-md bg-slate-50 px-3 py-2 text-sm">
                    <p class="text-xs text-slate-500">Total Pinjam</p>
                    <p class="font-bold text-slate-900">{{ (int) $item->total_peminjaman }} kali</p>
                </div>
            </article>
        @empty
            <article class="rounded-xl border border-dashed border-slate-300 bg-white p-6 text-sm text-slate-500 md:col-span-3">
                Data apresiasi belum tersedia. Riwayat peminjaman siswa akan ditampilkan di sini setelah ada transaksi yang diproses.
            </article>
        @endforelse
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
