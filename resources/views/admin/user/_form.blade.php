@csrf
@if(isset($adminUser))
    @method('PUT')
@endif

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-1 block text-sm font-medium">Nama</label>
        <input name="name" value="{{ old('name', $adminUser->name ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
    </div>
    <div>
        <label class="mb-1 block text-sm font-medium">Email</label>
        <input name="email" type="email" value="{{ old('email', $adminUser->email ?? '') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
    </div>
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium">Password (kosongkan jika tidak diubah)</label>
        <input name="password" type="password" class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
</div>

@if($errors->any())
    <div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
        <ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<div class="mt-6 flex gap-3">
    <button class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white">Simpan</button>
    <a href="{{ route('admin.user.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold">Batal</a>
</div>
