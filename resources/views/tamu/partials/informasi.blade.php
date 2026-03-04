@php
    $layananList = collect($layanan ?? []);
@endphp

<section id="informasi" class="mt-8 space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm md:p-6">
        <div class="mb-4 flex items-center justify-between border-b border-slate-100 pb-3">
            <h2 class="text-2xl font-black text-slate-900">Informasi Layanan</h2>
            <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Update Terbaru</span>
        </div>

        <div class="grid gap-3 md:grid-cols-2">
            @forelse($layananList as $index => $item)
                <article class="rounded-xl border border-slate-200 bg-slate-50 p-4 transition hover:bg-white hover:shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Info {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</p>
                    <p class="mt-2 text-sm leading-7 text-slate-700">{{ $item }}</p>
                </article>
            @empty
                <article class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-4 text-sm text-slate-500 md:col-span-2">
                    Belum ada informasi layanan yang dipublikasikan.
                </article>
            @endforelse
        </div>
    </div>

    <div class="grid gap-4 lg:grid-cols-2">
        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-black text-slate-900">Ketentuan Singkat Pengguna</h3>
            <ul class="mt-3 space-y-2 text-sm text-slate-700">
                <li class="rounded-md bg-slate-50 px-3 py-2">Gunakan akun siswa untuk mengajukan peminjaman buku.</li>
                <li class="rounded-md bg-slate-50 px-3 py-2">Jaga kondisi buku saat dipinjam dan kembalikan tepat waktu.</li>
                <li class="rounded-md bg-slate-50 px-3 py-2">Buku referensi tertentu dibaca di tempat sesuai aturan perpustakaan.</li>
                <li class="rounded-md bg-slate-50 px-3 py-2">Hubungi petugas jika butuh bantuan pencarian koleksi.</li>
            </ul>
        </section>

        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-black text-slate-900">FAQ Cepat</h3>
            <div class="mt-3 space-y-3 text-sm text-slate-700">
                <article class="rounded-md border border-slate-200 p-3">
                    <p class="font-semibold text-slate-900">Bagaimana cara mencari buku?</p>
                    <p class="mt-1 text-slate-600">Buka menu katalog, lalu gunakan pencarian judul dan filter kategori/rak.</p>
                </article>
                <article class="rounded-md border border-slate-200 p-3">
                    <p class="font-semibold text-slate-900">Apakah semua buku bisa dipinjam?</p>
                    <p class="mt-1 text-slate-600">Tidak semua. Beberapa koleksi referensi hanya dapat dibaca di perpustakaan.</p>
                </article>
                <article class="rounded-md border border-slate-200 p-3">
                    <p class="font-semibold text-slate-900">Di mana melihat status ketersediaan?</p>
                    <p class="mt-1 text-slate-600">Status buku bisa dilihat pada detail buku di halaman katalog.</p>
                </article>
            </div>
        </section>
    </div>
</section>
