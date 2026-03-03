<section class="mt-6 grid gap-4 md:grid-cols-3">
    <div class="rounded-xl border border-sky-100 bg-white p-5 shadow-sm">
        <p class="text-sm text-slate-500">Total Buku</p>
        <p class="mt-2 text-3xl font-bold text-sky-900">{{ number_format($statistik['total_buku'] ?? 0, 0, ',', '.') }}</p>
    </div>
    <div class="rounded-xl border border-sky-100 bg-white p-5 shadow-sm">
        <p class="text-sm text-slate-500">Total Kategori</p>
        <p class="mt-2 text-3xl font-bold text-sky-900">{{ number_format($statistik['total_kategori'] ?? 0, 0, ',', '.') }}</p>
    </div>
    <div class="rounded-xl border border-sky-100 bg-white p-5 shadow-sm">
        <p class="text-sm text-slate-500">Buku Tersedia</p>
        <p class="mt-2 text-3xl font-bold text-sky-900">{{ number_format($statistik['buku_tersedia'] ?? 0, 0, ',', '.') }}</p>
    </div>
</section>
