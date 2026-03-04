@extends('layouts.siswa', ['title' => 'Peminjaman Buku'])

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Peminjaman Buku</h2>
    <p class="mt-1 text-sm text-slate-600">Ajukan peminjaman buku, lalu tunggu proses dari petugas.</p>
</div>

@if(session('success'))
    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">{{ session('error') }}</div>
@endif
@if($errors->any())
    <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid gap-5 lg:grid-cols-[1.1fr_1fr]">
    <section class="rounded-xl border bg-white p-5">
        <div class="mb-4 rounded-lg border border-slate-200 bg-slate-50 p-3">
            <form method="GET" action="{{ route('siswa.peminjaman.index') }}" class="grid gap-2 md:grid-cols-[1.2fr_1fr_1fr_auto_auto]">
                <input
                    type="text"
                    name="q"
                    value="{{ $q ?? '' }}"
                    placeholder="Cari judul, penulis, atau kode buku"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"
                >
                <select name="kategori" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($daftarKategori as $kategori)
                        <option value="{{ $kategori->id }}" @selected((string) ($kategoriId ?? '') === (string) $kategori->id)>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                <select name="rak" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="">Semua Rak</option>
                    @foreach($daftarRak as $rak)
                        <option value="{{ $rak->id }}" @selected((string) ($rakId ?? '') === (string) $rak->id)>
                            {{ $rak->nomor_rak }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-800">
                    Filter
                </button>
                <a href="{{ route('siswa.peminjaman.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-center text-sm font-semibold text-slate-700 hover:bg-slate-100">
                    Reset
                </a>
            </form>
            <p class="mt-2 text-xs text-slate-600">
                Menampilkan {{ $daftarBuku->count() }} buku untuk dipilih.
            </p>
        </div>

        <h3 class="mb-4 text-lg font-semibold">Form Peminjaman</h3>
        <form method="POST" action="{{ route('siswa.peminjaman.store') }}" class="space-y-4">
            @csrf
            @php
                $oldItems = old('items', [['buku_id' => '', 'qty' => 1]]);
            @endphp
            <div>
                <div class="mb-2 flex items-center justify-between">
                    <label class="block text-sm font-medium">Daftar Buku</label>
                    <button id="tambahItemPeminjaman" type="button" class="rounded-lg border border-sky-200 bg-sky-50 px-3 py-1.5 text-xs font-semibold text-sky-700 hover:bg-sky-100">
                        + Tambah Buku
                    </button>
                </div>
                <div id="daftarItemPeminjaman" class="space-y-3">
                    @foreach($oldItems as $index => $item)
                        <div class="item-peminjaman grid gap-2 rounded-lg border border-slate-200 p-3 md:grid-cols-[1fr_110px_auto]">
                            <div>
                                <label class="mb-1 block text-xs font-medium text-slate-500">Buku</label>
                                <select name="items[{{ $index }}][buku_id]" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
                                    <option value="">- Pilih Buku -</option>
                                    @foreach($daftarBuku as $buku)
                                        <option value="{{ $buku->id }}" @selected(($item['buku_id'] ?? '') == $buku->id)>
                                            {{ $buku->judul }} | Stok: {{ $buku->stok_tersedia }} | Rak: {{ $buku->rak->nomor_rak ?? '-' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="mb-1 block text-xs font-medium text-slate-500">Qty</label>
                                <input type="number" name="items[{{ $index }}][qty]" min="1" max="3" value="{{ $item['qty'] ?? 1 }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
                            </div>
                            <div class="flex items-end">
                                <button type="button" class="hapus-item rounded-lg border border-rose-200 bg-rose-50 px-3 py-2 text-xs font-semibold text-rose-700 hover:bg-rose-100">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <p class="mt-2 text-xs text-slate-500">Maksimal 5 buku berbeda per pengajuan.</p>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Catatan (opsional)</label>
                <textarea name="catatan" rows="3" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">{{ old('catatan') }}</textarea>
            </div>
            <button type="submit" class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-800">
                Ajukan Peminjaman
            </button>
        </form>
    </section>

    <section class="rounded-xl border bg-white p-5">
        <h3 class="mb-3 text-lg font-semibold">Info Proses</h3>
        <ul class="space-y-2 text-sm text-slate-600">
            <li>1. Siswa bisa ajukan beberapa buku sekaligus.</li>
            <li>2. Status awal menjadi <span class="font-semibold text-amber-700">Menunggu</span>.</li>
            <li>3. Petugas memproses, lalu status jadi <span class="font-semibold text-sky-700">Dipinjam</span>.</li>
            <li>4. Pengembalian diajukan dari menu <span class="font-semibold">Pengembalian</span>.</li>
        </ul>
    </section>
</div>

<section class="mt-6 rounded-xl border bg-white p-4">
    <h3 class="mb-3 text-lg font-semibold">Riwayat Pengajuan</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-3 py-2 text-left">Kode</th>
                    <th class="px-3 py-2 text-left">Buku</th>
                    <th class="px-3 py-2 text-left">Status</th>
                    <th class="px-3 py-2 text-left">Tgl Pinjam</th>
                </tr>
            </thead>
            <tbody>
            @forelse($riwayat as $item)
                <tr class="border-t align-top">
                    <td class="px-3 py-2">{{ $item->kode_peminjaman }}</td>
                    <td class="px-3 py-2">
                        <ul class="space-y-1">
                            @foreach($item->detailPeminjaman as $detail)
                                <li>{{ $detail->buku->judul ?? '-' }} ({{ $detail->qty }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-3 py-2">{{ ucfirst($item->status) }}</td>
                    <td class="px-3 py-2">{{ optional($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-3 py-4 text-center text-slate-500">Belum ada pengajuan peminjaman.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $riwayat->links() }}</div>
</section>

<script>
    (() => {
        const container = document.getElementById('daftarItemPeminjaman');
        const addBtn = document.getElementById('tambahItemPeminjaman');
        if (!container || !addBtn) return;

        const getRows = () => Array.from(container.querySelectorAll('.item-peminjaman'));

        const reindexNames = () => {
            getRows().forEach((row, index) => {
                const select = row.querySelector('select');
                const qty = row.querySelector('input[type="number"]');
                if (select) select.name = `items[${index}][buku_id]`;
                if (qty) qty.name = `items[${index}][qty]`;
            });
        };

        const updateHapusState = () => {
            const rows = getRows();
            rows.forEach((row) => {
                const btn = row.querySelector('.hapus-item');
                if (btn) btn.disabled = rows.length === 1;
                if (btn) btn.classList.toggle('opacity-40', rows.length === 1);
                if (btn) btn.classList.toggle('cursor-not-allowed', rows.length === 1);
            });
        };

        const bindRemove = (row) => {
            const btn = row.querySelector('.hapus-item');
            btn?.addEventListener('click', () => {
                if (getRows().length === 1) return;
                row.remove();
                reindexNames();
                updateHapusState();
            });
        };

        getRows().forEach(bindRemove);
        reindexNames();
        updateHapusState();

        addBtn.addEventListener('click', () => {
            const rows = getRows();
            if (rows.length >= 5) return;

            const clone = rows[0].cloneNode(true);
            const select = clone.querySelector('select');
            const qty = clone.querySelector('input[type="number"]');
            if (select) select.value = '';
            if (qty) qty.value = '1';

            container.appendChild(clone);
            bindRemove(clone);
            reindexNames();
            updateHapusState();
        });
    })();
</script>
@endsection
