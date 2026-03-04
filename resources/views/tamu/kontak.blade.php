@extends($layout ?? 'layouts.app', ['title' => $title ?? 'Kontak - Perpustakaan Sekolah', 'activeMenu' => $activeMenu ?? null])

@section('content')
<section class="rounded-2xl border border-sky-100 bg-white p-6 shadow-sm md:p-8">
    <h1 class="text-3xl font-black text-sky-900">Kontak Perpustakaan</h1>
    <p class="mt-2 text-slate-600">Hubungi petugas perpustakaan sekolah untuk bantuan layanan.</p>

    <div class="mt-6 grid gap-4 md:grid-cols-2">
        <article class="rounded-xl border border-slate-200 p-4">
            <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Alamat</h2>
            <p class="mt-2 text-sm text-slate-700">Perpustakaan Sekolah<br>Jalan Syekh Ibrahim Musa No.mor 26, Ganting, Padang Panjang Timur, Padang Panjang City, West Sumatra</p>
        </article>
        <article class="rounded-xl border border-slate-200 p-4">
            <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Kontak</h2>
            <p class="mt-2 text-sm text-slate-700">Email: perpustakaan@sekolah.sch.id<br>Telepon: (021) 000000</p>
        </article>
    </div>
    <p class="mt-4 text-xs text-slate-400">Silakan sesuaikan data kontak sesuai kondisi sekolah.</p>
</section>
@endsection
