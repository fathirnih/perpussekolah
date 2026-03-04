@extends($layout ?? 'layouts.app', ['title' => $title ?? 'Kontak - Perpustakaan Sekolah', 'activeMenu' => $activeMenu ?? null])

@section('content')
@php
    $alamatPerpus = 'SMKN 2 Padang Panjang, Jalan Syekh Ibrahim Musa No.26, Ganting, Padang Panjang Timur, Padang Panjang City, West Sumatra';
    $emailPerpus = 'perpustakaan@sekolah.sch.id';
    $telPerpus = '(021) 000000';
    $qMap = urlencode($alamatPerpus);
@endphp

<section class="overflow-hidden rounded-2xl border border-sky-100 bg-white shadow-sm">
    <div class="grid gap-5 p-6 md:grid-cols-[1.2fr_0.8fr] md:p-8">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-sky-700">Kontak Perpustakaan</p>
            <h1 class="mt-2 text-3xl font-black text-sky-900 md:text-4xl">Hubungi Petugas Perpustakaan SMKN 2 Padang Panjang</h1>
            <p class="mt-3 max-w-2xl text-slate-600">Silakan hubungi kami untuk informasi peminjaman, pengembalian buku, dan bantuan pencarian koleksi perpustakaan.</p>

            <div class="mt-5 grid gap-3 sm:grid-cols-2">
                <a href="tel:021000000" class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100">Telepon Langsung</a>
                <a href="mailto:{{ $emailPerpus }}" class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100">Kirim Email</a>
            </div>
        </div>
    </div>

    <div class="grid gap-0 border-t border-slate-200 md:grid-cols-2">
        <article class="border-b border-slate-200 p-5 md:border-b-0 md:border-r">
            <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Alamat</h2>
            <p class="mt-2 text-sm leading-7 text-slate-700">{{ $alamatPerpus }}</p>
        </article>
        <article class="p-5">
            <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Kontak Resmi</h2>
            <p class="mt-2 text-sm leading-7 text-slate-700">Email: {{ $emailPerpus }}<br>Telepon: {{ $telPerpus }}</p>
        </article>
    </div>
</section>
@endsection
