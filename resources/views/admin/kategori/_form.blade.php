@csrf
@if(isset($kategori)) @method('PUT') @endif
<div class="grid gap-4">
    <div><label class="mb-1 block text-sm font-medium">Nama Kategori</label><input name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required></div>
    <div><label class="mb-1 block text-sm font-medium">Keterangan</label><textarea name="keterangan" class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('keterangan', $kategori->keterangan ?? '') }}</textarea></div>
</div>
@if($errors->any())<div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="mt-6 flex gap-3"><button class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white">Simpan</button><a href="{{ route('admin.kategori.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold">Batal</a></div>
