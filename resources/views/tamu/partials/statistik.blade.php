<section class="mt-6 grid gap-4 md:grid-cols-3">
    <div class="rounded-2xl border border-sky-100 bg-white p-5 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Koleksi Buku</p>
        <p class="mt-2 text-3xl font-black text-sky-900">{{ number_format($statistik['total_buku'] ?? 0, 0, ',', '.') }}</p>
        <p class="mt-2 text-xs text-slate-500">Total judul dan eksemplar yang tercatat di perpustakaan.</p>
    </div>
    <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Kategori Aktif</p>
        <p class="mt-2 text-3xl font-black text-emerald-700">{{ number_format($statistik['total_kategori'] ?? 0, 0, ',', '.') }}</p>
        <p class="mt-2 text-xs text-slate-500">Mencakup pelajaran, referensi, fiksi, dan literasi umum.</p>
    </div>
    <div class="rounded-2xl border border-amber-100 bg-white p-5 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Siap Dipinjam</p>
        <p class="mt-2 text-3xl font-black text-amber-700">{{ number_format($statistik['buku_tersedia'] ?? 0, 0, ',', '.') }}</p>
        <p class="mt-2 text-xs text-slate-500">Buku tersedia yang bisa diajukan siswa hari ini.</p>
    </div>
</section>