@csrf
@if(isset($dokumentasi))
    @method('PUT')
@endif

<div class="grid gap-4 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium">Judul Kegiatan</label>
        <input name="judul" value="{{ old('judul', $dokumentasi->judul ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
    </div>
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium">Slug</label>
        <input name="slug" value="{{ old('slug', $dokumentasi->slug ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" placeholder="contoh-kegiatan-literasi">
        <p class="mt-1 text-xs text-slate-500">Kosongkan jika ingin dibuat otomatis dari judul.</p>
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Tanggal Kegiatan</label>
        <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', isset($dokumentasi) && $dokumentasi->tanggal_kegiatan ? $dokumentasi->tanggal_kegiatan->format('Y-m-d') : '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Urutan Tampil</label>
        <input type="number" min="0" name="urutan" value="{{ old('urutan', $dokumentasi->urutan ?? 0) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium">Deskripsi</label>
        <textarea name="deskripsi" rows="4" class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('deskripsi', $dokumentasi->deskripsi ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium">Foto Dokumentasi</label>
        <input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border border-slate-300 px-3 py-2">
        @if(isset($dokumentasi) && $dokumentasi->foto)
            <img src="{{ asset('storage/' . $dokumentasi->foto) }}" alt="{{ $dokumentasi->judul }}" class="mt-3 h-36 rounded-lg border object-cover">
        @endif
    </div>
    <div class="md:col-span-2">
        <label class="inline-flex items-center gap-2 text-sm font-medium">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $dokumentasi->is_published ?? true))>
            Tampilkan di Beranda
        </label>
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
    <button class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white">Simpan</button>
    <a href="{{ route('admin.dokumentasi.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold">Batal</a>
</div>
