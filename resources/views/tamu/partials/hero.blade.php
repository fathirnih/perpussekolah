@php
    $isSiswaPage = request()->routeIs('siswa.*');
@endphp

<div class="relative overflow-hidden rounded-2xl border border-sky-100 bg-gradient-to-br from-sky-800 via-sky-700 to-cyan-700 p-6 text-white shadow-sm md:p-8">
    <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10"></div>
    <div class="pointer-events-none absolute -bottom-14 left-1/3 h-40 w-40 rounded-full bg-cyan-200/20"></div>

    <p class="inline-flex rounded-full border border-white/30 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide">
        Perpustakaan Sekolah
    </p>
    <h1 class="mt-4 text-3xl font-black leading-tight md:text-5xl">
        Ruang Belajar, Ruang Berkarya, Ruang Literasi Siswa
    </h1>
    <p class="mt-4 max-w-2xl text-sky-100">
        Temukan buku pelajaran, referensi, fiksi, dan koleksi literasi sekolah dalam satu katalog.
        Siswa dapat melihat detail buku sebelum mengajukan peminjaman.
    </p>

    <div class="mt-6 flex flex-wrap gap-3">
        <a href="{{ $isSiswaPage ? route('siswa.katalog') : route('katalog') }}" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-sky-800 transition hover:bg-sky-50">
            Jelajahi Katalog
        </a>
        <a href="{{ $isSiswaPage ? route('siswa.informasi') : route('informasi') }}" class="rounded-lg border border-white/40 bg-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/20">
            Lihat Layanan
        </a>
        @if($isSiswaPage)
            <a href="{{ route('siswa.peminjaman.index') }}" class="rounded-lg border border-white/40 bg-transparent px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10">
                Ajukan Peminjaman
            </a>
        @else
            <a href="{{ route('login.siswa') }}" class="rounded-lg border border-white/40 bg-transparent px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10">
                Login
            </a>
        @endif
    </div>
</div>

<div class="rounded-2xl border border-amber-200 bg-gradient-to-b from-amber-50 to-orange-50 p-6 shadow-sm md:p-8">
    <h2 class="text-lg font-bold text-amber-900">Akses Layanan Perpustakaan</h2>
    <ul class="mt-3 space-y-2 text-sm text-amber-900/90">
        <li>- Siswa tidak perlu daftar mandiri.</li>
        <li>- Akun dibuat oleh admin sekolah.</li>
        <li>- Password awal diatur oleh admin.</li>
        <li>- Verifikasi pinjam dan kembali oleh petugas.</li>
    </ul>
    <a href="{{ route('kontak') }}" class="mt-4 inline-flex rounded-lg border border-amber-300 px-3 py-2 text-xs font-semibold text-amber-900 transition hover:bg-amber-100">
        Butuh bantuan? Hubungi petugas
    </a>
</div>
