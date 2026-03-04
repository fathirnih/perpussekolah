@extends('layouts.admin', ['title' => 'Edit Peminjaman'])

@section('content')
<div class="mb-5 flex items-center justify-between">
    <h2 class="text-2xl font-bold">Edit Peminjaman</h2>
    <a href="{{ route('admin.peminjaman.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
        Kembali
    </a>
</div>

@include('admin.peminjaman._form', [
    'peminjaman' => $peminjaman,
    'formAction' => route('admin.peminjaman.update', $peminjaman),
    'submitLabel' => 'Perbarui Peminjaman',
])
@endsection

