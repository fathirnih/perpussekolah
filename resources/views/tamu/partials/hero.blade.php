<div class="rounded-2xl border border-sky-100 bg-white p-6 shadow-sm md:p-8">
    <h1 class="text-3xl font-black leading-tight text-sky-900 md:text-5xl">
        Layanan Perpustakaan Sekolah untuk Semua Siswa
    </h1>
    <p class="mt-4 max-w-2xl text-slate-600">
        Jelajahi katalog buku, lihat ketersediaan stok, dan ketahui nomor rak sebelum meminjam.
        Pendaftaran akun dilakukan oleh admin sekolah.
    </p>
    <div class="mt-6 flex flex-wrap gap-3">
        <a href="{{ route('login.siswa') }}" class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-sky-800">
            Masuk Sebagai Siswa
        </a>
        <a href="{{ route('katalog') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Lihat Katalog
        </a>
    </div>
</div>

<div class="rounded-2xl border border-amber-200 bg-amber-50 p-6 shadow-sm md:p-8">
    <h2 class="text-lg font-bold text-amber-900">Informasi Akses</h2>
    <ul class="mt-3 space-y-2 text-sm text-amber-900/90">
        <li>• Siswa tidak perlu daftar mandiri</li>
        <li>• Akun dibuat oleh admin sekolah</li>
        <li>• Password awal diatur oleh admin</li>
        <li>• Verifikasi pinjam/kembali oleh petugas</li>
    </ul>
</div>
