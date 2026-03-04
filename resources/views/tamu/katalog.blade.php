@extends($layout ?? 'layouts.app', ['title' => $title ?? 'Katalog - Perpustakaan Sekolah', 'activeMenu' => $activeMenu ?? null])

@section('content')
<section class="space-y-5">
    <header class="border-b border-slate-200 pb-4">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-sky-700">Katalog Perpustakaan</p>
        <h1 class="mt-2 text-3xl font-black text-slate-900 md:text-4xl">Temukan Buku Sesuai Kebutuhan Belajar</h1>
        <p class="mt-2 text-slate-600">Gunakan filter kategori, rak, penulis, dan kata kunci untuk menemukan koleksi perpustakaan dengan cepat.</p>
    </header>

    @php
        $isSiswaPage = request()->routeIs('siswa.*');
        $linkPeminjaman = $isSiswaPage ? route('siswa.peminjaman.index') : route('login.siswa');
        $labelAksi = $isSiswaPage ? 'Buka Menu Peminjaman' : 'Login untuk Meminjam';
    @endphp

    <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm md:p-5">
        <div class="mb-3 flex items-center justify-between border-b border-slate-100 pb-3">
            <h2 class="text-xl font-black text-slate-900">Alur Peminjaman Buku</h2>
            <a href="{{ $linkPeminjaman }}" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50">{{ $labelAksi }}</a>
        </div>
        <div class="grid gap-3 md:grid-cols-3">
            <article class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Langkah 1</p>
                <h3 class="mt-1 text-base font-bold text-slate-900">Cari Buku di Katalog</h3>
                <p class="mt-1 text-sm text-slate-600">Gunakan search dan filter untuk menemukan judul yang ingin dipinjam.</p>
            </article>
            <article class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Langkah 2</p>
                <h3 class="mt-1 text-base font-bold text-slate-900">Ajukan Peminjaman</h3>
                <p class="mt-1 text-sm text-slate-600">Masuk sebagai siswa lalu ajukan buku pilihan pada menu peminjaman.</p>
            </article>
            <article class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Langkah 3</p>
                <h3 class="mt-1 text-base font-bold text-slate-900">Ambil dan Kembalikan Tepat Waktu</h3>
                <p class="mt-1 text-sm text-slate-600">Petugas memproses pengajuan dan siswa melakukan pengembalian sesuai aturan.</p>
            </article>
        </div>
    </section>

    @include('tamu.partials.filter-katalog', ['actionUrl' => $actionUrl ?? route('katalog')])
    @include('tamu.partials.tabel-katalog')
</section>
@endsection
