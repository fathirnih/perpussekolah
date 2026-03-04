@csrf
@if(isset($siswa)) @method('PUT') @endif
<div class="grid gap-4 md:grid-cols-2">
    <div class="md:col-span-2">
        <div class="mb-2 flex justify-center">
            @if(isset($siswa) && $siswa->foto_profil)
                <div class="inline-flex aspect-square overflow-hidden rounded-full border border-slate-200 bg-slate-50" style="width: 8rem; height: 8rem;">
                    <img src="{{ asset('storage/' . $siswa->foto_profil) }}" alt="Foto profil {{ $siswa->nama }}" class="h-full w-full object-cover object-center">
                </div>
            @else
                <div class="inline-flex aspect-square items-center justify-center rounded-full border bg-slate-50 text-xs text-slate-400" style="width: 8rem; height: 8rem;">
                    Belum ada foto
                </div>
            @endif
        </div>
        <label class="mb-1 block text-center text-sm font-medium">Foto Profil</label>
        <input type="file" name="foto_profil" accept=".jpg,.jpeg,.png,.webp" class="mx-auto block w-full max-w-sm rounded-lg border border-slate-300 px-3 py-2 text-sm">
    </div>
    <div><label class="mb-1 block text-sm font-medium">NISN</label><input name="nisn" value="{{ old('nisn', $siswa->nisn ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required></div>
    <div><label class="mb-1 block text-sm font-medium">Nama</label><input name="nama" value="{{ old('nama', $siswa->nama ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required></div>
    <div>
        <label class="mb-1 block text-sm font-medium">Kelas</label>
        <select name="kelas_id" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
            <option value="">Pilih kelas</option>
            @foreach(($daftarKelas ?? []) as $kelas)
                <option value="{{ $kelas->id }}" @selected((string) old('kelas_id', $siswa->kelas_id ?? '') === (string) $kelas->id)>{{ $kelas->nama_kelas }}</option>
            @endforeach
        </select>
    </div>
    <div><label class="mb-1 block text-sm font-medium">Email</label><input name="email" type="email" value="{{ old('email', $siswa->email ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2"></div>
    <div><label class="mb-1 block text-sm font-medium">Password (kosongkan untuk default/biarkan lama)</label><input name="password" type="password" class="w-full rounded-lg border border-slate-300 px-3 py-2"></div>
    <div><label class="mb-1 block text-sm font-medium">No HP</label><input name="no_hp" value="{{ old('no_hp', $siswa->no_hp ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2"></div>
    <div class="md:col-span-2"><label class="mb-1 block text-sm font-medium">Alamat</label><textarea name="alamat" class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('alamat', $siswa->alamat ?? '') }}</textarea></div>
</div>
@if($errors->any())<div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="mt-6 flex gap-3"><button class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white">Simpan</button><a href="{{ route('admin.siswa.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold">Batal</a></div>
