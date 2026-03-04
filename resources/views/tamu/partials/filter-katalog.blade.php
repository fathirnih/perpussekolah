<div class="flex flex-col justify-between gap-3 md:flex-row md:items-end">
    @php
        $actionUrl = $actionUrl ?? route('katalog');
    @endphp
    <div>
        <h2 class="text-2xl font-bold text-sky-900">Katalog Buku</h2>
        <p class="mt-1 text-sm text-slate-600">
            Pencarian terbuka tanpa login. Menampilkan {{ number_format($jumlahHasil ?? 0, 0, ',', '.') }} hasil.
        </p>
    </div>
    <form method="GET" action="{{ $actionUrl }}" class="grid w-full gap-2 md:w-[680px] md:grid-cols-[1.6fr_1fr_1fr_auto_auto]">
        <input
            name="q"
            value="{{ $q ?? '' }}"
            placeholder="Cari judul, penulis, atau kategori"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none ring-sky-300 focus:ring"
        >
        <select name="kategori" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none ring-sky-300 focus:ring">
            <option value="">Semua Kategori</option>
            @foreach(($daftarKategori ?? []) as $item)
                <option value="{{ $item }}" @selected(($kategori ?? '') === $item)>{{ $item }}</option>
            @endforeach
        </select>
        <select name="status" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none ring-sky-300 focus:ring">
            <option value="semua" @selected(($status ?? 'semua') === 'semua')>Semua Status</option>
            <option value="tersedia" @selected(($status ?? '') === 'tersedia')>Hanya Tersedia</option>
            <option value="dipinjam" @selected(($status ?? '') === 'dipinjam')>Sedang Dipinjam</option>
        </select>
        <button class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-800">
            Cari
        </button>
        <a href="{{ $actionUrl }}" class="rounded-lg border border-slate-300 px-4 py-2 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">
            Reset
        </a>
    </form>
</div>
