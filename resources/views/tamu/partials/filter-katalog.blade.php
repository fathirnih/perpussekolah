@php
    $actionUrl = $actionUrl ?? route('katalog');
    $showStatus = $showStatus ?? true;
    $hasilTampil = isset($katalog) ? count($katalog) : 0;
    $qValue = $q ?? '';
    $penulisValue = $penulis ?? '';
    $kategoriValue = $kategori ?? '';
    $rakValue = $rak ?? '';
    $statusValue = $status ?? 'semua';
    $sortValue = $sort ?? 'judul_asc';
@endphp

<section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm md:p-5">
    <div class="mb-3 flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-3">
        <h2 class="text-lg font-black text-slate-900">Filter Katalog</h2>
        <p class="text-sm text-slate-600">Menampilkan {{ number_format($hasilTampil, 0, ',', '.') }} dari {{ number_format($jumlahHasil ?? 0, 0, ',', '.') }} buku.</p>
    </div>

    <form id="katalogFilterForm" method="GET" action="{{ $actionUrl }}" class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
        <div class="xl:col-span-2">
            <label for="katalog_q" class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Cari Buku</label>
            <input
                id="katalog_q"
                name="q"
                value="{{ $qValue }}"
                placeholder="Judul, penulis, kategori"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none ring-sky-300 focus:ring"
            >
        </div>

        <div>
            <label for="katalog_sort" class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Urutkan</label>
            <select id="katalog_sort" name="sort" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none ring-sky-300 focus:ring">
                <option value="judul_asc" @selected($sortValue === 'judul_asc')>Judul A-Z</option>
                <option value="judul_desc" @selected($sortValue === 'judul_desc')>Judul Z-A</option>
                <option value="tahun_desc" @selected($sortValue === 'tahun_desc')>Tahun Terbaru</option>
                <option value="stok_desc" @selected($sortValue === 'stok_desc')>Stok Terbanyak</option>
            </select>
        </div>

        <div>
            <label for="katalog_penulis" class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Penulis</label>
            <select id="katalog_penulis" name="penulis" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none ring-sky-300 focus:ring">
                <option value="">Semua Penulis</option>
                @foreach(($daftarPenulis ?? []) as $item)
                    <option value="{{ $item }}" @selected($penulisValue === $item)>{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="katalog_kategori" class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Kategori</label>
            <select id="katalog_kategori" name="kategori" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none ring-sky-300 focus:ring">
                <option value="">Semua Kategori</option>
                @foreach(($daftarKategori ?? []) as $item)
                    <option value="{{ $item }}" @selected($kategoriValue === $item)>{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="katalog_rak" class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Rak</label>
            <select id="katalog_rak" name="rak" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none ring-sky-300 focus:ring">
                <option value="">Semua Rak</option>
                @foreach(($daftarRak ?? []) as $item)
                    <option value="{{ $item }}" @selected($rakValue === $item)>{{ $item }}</option>
                @endforeach
            </select>
        </div>

        @if($showStatus)
            <div>
                <label for="katalog_status" class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Status</label>
                <select id="katalog_status" name="status" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none ring-sky-300 focus:ring">
                    <option value="semua" @selected($statusValue === 'semua')>Semua Status</option>
                    <option value="tersedia" @selected($statusValue === 'tersedia')>Hanya Tersedia</option>
                    <option value="dipinjam" @selected($statusValue === 'dipinjam')>Sedang Dipinjam</option>
                </select>
            </div>
        @endif

    </form>
</section>

<script>
    (() => {
        const form = document.getElementById('katalogFilterForm');
        if (!form) return;

        const textInputs = form.querySelectorAll('input[type="text"]');
        const selectInputs = form.querySelectorAll('select');
        let timer = null;

        textInputs.forEach((input) => {
            input.addEventListener('input', () => {
                clearTimeout(timer);
                timer = setTimeout(() => form.submit(), 350);
            });
        });

        selectInputs.forEach((select) => {
            select.addEventListener('change', () => form.submit());
        });
    })();
</script>
