@csrf
@if(isset($siswa)) @method('PUT') @endif
<div class="grid gap-4 md:grid-cols-2">
    <div><label class="mb-1 block text-sm font-medium">NISN</label><input name="nisn" value="{{ old('nisn', $siswa->nisn ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required></div>
    <div><label class="mb-1 block text-sm font-medium">Nama</label><input name="nama" value="{{ old('nama', $siswa->nama ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required></div>
    <div><label class="mb-1 block text-sm font-medium">Kelas</label><input name="kelas" value="{{ old('kelas', $siswa->kelas ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required></div>
    <div><label class="mb-1 block text-sm font-medium">Email</label><input name="email" type="email" value="{{ old('email', $siswa->email ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2"></div>
    <div><label class="mb-1 block text-sm font-medium">Password (kosongkan untuk default/biarkan lama)</label><input name="password" type="password" class="w-full rounded-lg border border-slate-300 px-3 py-2"></div>
    <div><label class="mb-1 block text-sm font-medium">No HP</label><input name="no_hp" value="{{ old('no_hp', $siswa->no_hp ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2"></div>
    <div class="md:col-span-2"><label class="mb-1 block text-sm font-medium">Alamat</label><textarea name="alamat" class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('alamat', $siswa->alamat ?? '') }}</textarea></div>
    <div class="md:col-span-2"><label class="inline-flex items-center gap-2 text-sm"><input type="checkbox" name="is_registered" value="1" @checked(old('is_registered', $siswa->is_registered ?? false))> Sudah registrasi</label></div>
</div>
@if($errors->any())<div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="mt-6 flex gap-3"><button class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white">Simpan</button><a href="{{ route('admin.siswa.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold">Batal</a></div>
