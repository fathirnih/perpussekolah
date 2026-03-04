@php
    $isEdit = isset($peminjaman);
    $base = $isEdit ? $peminjaman : null;
    $awalItems = collect(old('items', []));
    if ($awalItems->isEmpty() && $isEdit) {
        $awalItems = $peminjaman->detailPeminjaman->map(fn ($detail) => [
            'buku_id' => $detail->buku_id,
            'qty' => $detail->qty,
        ]);
    }
@endphp

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

<form method="POST" action="{{ $formAction }}" class="rounded-xl border bg-white p-5">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="grid gap-4 md:grid-cols-3">
        <div>
            <label class="mb-1 block text-sm font-medium">Kode Peminjaman</label>
            <input
                type="text"
                name="kode_peminjaman"
                value="{{ old('kode_peminjaman', $base->kode_peminjaman ?? ($kodeDefault ?? '')) }}"
                class="w-full rounded-lg border border-slate-300 px-3 py-2"
                required
            >
        </div>
        <div class="md:col-span-2">
            <label class="mb-1 block text-sm font-medium">Siswa</label>
            <select name="siswa_id" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
                <option value="">Pilih siswa</option>
                @foreach($daftarSiswa as $siswa)
                    <option value="{{ $siswa->id }}" @selected((string) old('siswa_id', $base->siswa_id ?? '') === (string) $siswa->id)>
                        {{ $siswa->nama }} ({{ $siswa->kelas ?: '-' }})
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Petugas</label>
            <select name="petugas_id" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                <option value="">Belum ditentukan</option>
                @foreach($daftarPetugas as $petugas)
                    <option value="{{ $petugas->id }}" @selected((string) old('petugas_id', $base->petugas_id ?? '') === (string) $petugas->id)>
                        {{ $petugas->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Tanggal Pinjam</label>
            <input
                type="date"
                name="tanggal_pinjam"
                value="{{ old('tanggal_pinjam', optional($base->tanggal_pinjam ?? now())->format('Y-m-d')) }}"
                class="w-full rounded-lg border border-slate-300 px-3 py-2"
                required
            >
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Tanggal Jatuh Tempo</label>
            <input
                type="date"
                name="tanggal_jatuh_tempo"
                value="{{ old('tanggal_jatuh_tempo', optional($base->tanggal_jatuh_tempo ?? now()->addDays(7))->format('Y-m-d')) }}"
                class="w-full rounded-lg border border-slate-300 px-3 py-2"
                required
            >
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Status</label>
            <select name="status" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
                @php $statusValue = old('status', $base->status ?? 'dipinjam'); @endphp
                <option value="menunggu" @selected($statusValue === 'menunggu')>Menunggu</option>
                <option value="dipinjam" @selected($statusValue === 'dipinjam')>Dipinjam</option>
                <option value="terlambat" @selected($statusValue === 'terlambat')>Terlambat</option>
                <option value="selesai" @selected($statusValue === 'selesai')>Selesai</option>
                <option value="ditolak" @selected($statusValue === 'ditolak')>Ditolak</option>
            </select>
        </div>
        <div class="flex items-end">
            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="pengajuan_pengembalian" value="1" @checked(old('pengajuan_pengembalian', $base->pengajuan_pengembalian ?? false))>
                Pengajuan pengembalian
            </label>
        </div>
        <div class="md:col-span-3">
            <label class="mb-1 block text-sm font-medium">Catatan</label>
            <textarea name="catatan" rows="2" class="w-full rounded-lg border border-slate-300 px-3 py-2" placeholder="Opsional">{{ old('catatan', $base->catatan ?? '') }}</textarea>
        </div>
    </div>

    <div class="mt-6">
        <div class="mb-2 flex items-center justify-between">
            <h3 class="text-lg font-bold">Daftar Buku</h3>
            <button id="btnTambahBaris" type="button" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">Tambah Baris</button>
        </div>

        <div class="overflow-x-auto rounded-xl border">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-3 py-2 text-left">Buku</th>
                        <th class="px-3 py-2 text-left">Stok</th>
                        <th class="px-3 py-2 text-left">Qty</th>
                        <th class="px-3 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody id="listItemPeminjaman"></tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 flex gap-3">
        <button class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-800">{{ $submitLabel ?? 'Simpan' }}</button>
        <a href="{{ route('admin.peminjaman.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">Batal</a>
    </div>
</form>

<template id="templateItemPeminjaman">
    <tr class="border-t">
        <td class="px-3 py-2">
            <select data-key="buku_id" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
                <option value="">Pilih buku</option>
                @foreach($daftarBuku as $buku)
                    <option value="{{ $buku->id }}" data-stok="{{ (int) $buku->stok_tersedia }}">{{ $buku->judul }} ({{ $buku->kode_buku }})</option>
                @endforeach
            </select>
        </td>
        <td class="px-3 py-2">
            <span data-key="stok_text" class="text-slate-600">-</span>
        </td>
        <td class="px-3 py-2">
            <input data-key="qty" type="number" min="1" max="5" value="1" class="w-24 rounded-lg border border-slate-300 px-3 py-2" required>
        </td>
        <td class="px-3 py-2">
            <button type="button" data-key="hapus" class="rounded border border-rose-200 bg-rose-50 px-2 py-1 text-rose-700">Hapus</button>
        </td>
    </tr>
</template>

<script>
    (() => {
        const list = document.getElementById('listItemPeminjaman');
        const template = document.getElementById('templateItemPeminjaman');
        const btnTambah = document.getElementById('btnTambahBaris');

        const buatBaris = (value = {}) => {
            const node = template.content.firstElementChild.cloneNode(true);
            const selectBuku = node.querySelector('[data-key="buku_id"]');
            const inputQty = node.querySelector('[data-key="qty"]');
            const stokText = node.querySelector('[data-key="stok_text"]');
            const btnHapus = node.querySelector('[data-key="hapus"]');

            selectBuku.name = 'items[][buku_id]';
            inputQty.name = 'items[][qty]';

            if (value.buku_id) selectBuku.value = value.buku_id;
            if (value.qty) inputQty.value = value.qty;

            const updateStok = () => {
                const opt = selectBuku.selectedOptions[0];
                const stok = opt?.dataset?.stok ?? '';
                stokText.textContent = stok === '' ? '-' : `${stok} tersedia`;
            };

            selectBuku.addEventListener('change', updateStok);
            btnHapus.addEventListener('click', () => {
                node.remove();
                if (!list.children.length) buatBaris();
            });

            list.appendChild(node);
            updateStok();
        };

        btnTambah.addEventListener('click', () => buatBaris());

        const initialItems = @json($awalItems->values()->all());
        if (Array.isArray(initialItems) && initialItems.length) {
            initialItems.forEach((item) => buatBaris(item));
        } else {
            buatBaris();
        }
    })();
</script>

