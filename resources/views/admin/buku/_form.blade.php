@csrf
@if(isset($buku))
    @method('PUT')
@endif

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-1 block text-sm font-medium">Kode Buku</label>
        <input name="kode_buku" value="{{ old('kode_buku', $buku->kode_buku ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">ISBN</label>
        <input name="isbn" value="{{ old('isbn', $buku->isbn ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium">Judul</label>
        <input name="judul" value="{{ old('judul', $buku->judul ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
    </div>
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium">Sinopsis</label>
        <textarea name="sinopsis" rows="4" class="w-full rounded-lg border border-slate-300 px-3 py-2" placeholder="Ringkasan isi buku...">{{ old('sinopsis', $buku->sinopsis ?? '') }}</textarea>
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Penulis</label>
        <input name="penulis" value="{{ old('penulis', $buku->penulis ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Penerbit</label>
        <input name="penerbit" value="{{ old('penerbit', $buku->penerbit ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Tahun Terbit</label>
        <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Kategori</label>
        <select name="kategori_buku_id" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
            <option value="">Pilih kategori</option>
            @foreach($kategoriBuku as $kategori)
                <option value="{{ $kategori->id }}" @selected(old('kategori_buku_id', $buku->kategori_buku_id ?? '') == $kategori->id)>{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Rak</label>
        <select name="rak_id" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
            <option value="">Pilih rak</option>
            @foreach($rakBuku as $rak)
                <option value="{{ $rak->id }}" @selected(old('rak_id', $buku->rak_id ?? '') == $rak->id)>{{ $rak->nomor_rak }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Stok Total</label>
        <input type="number" min="0" name="stok_total" value="{{ old('stok_total', $buku->stok_total ?? 0) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Stok Tersedia</label>
        <input type="number" min="0" name="stok_tersedia" value="{{ old('stok_tersedia', $buku->stok_tersedia ?? 0) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
    </div>
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium">Gambar Sampul</label>
        <input type="file" name="gambar_sampul" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border border-slate-300 px-3 py-2">
        @if(isset($buku) && $buku->gambar_sampul)
            <img src="{{ asset('storage/' . $buku->gambar_sampul) }}" alt="Sampul buku" class="mt-3 h-32 rounded-lg border object-cover">
        @endif
    </div>
</div>

@if($errors->any())
    <div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mt-6 flex gap-3">
    <button class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-800">Simpan</button>
    <a href="{{ route('admin.buku.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">Batal</a>
</div>
