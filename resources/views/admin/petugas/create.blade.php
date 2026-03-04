@extends('layouts.admin', ['title' => 'Tambah Petugas'])
@section('content')
<h2 class="mb-5 text-2xl font-bold">Tambah Petugas</h2>
<form method="POST" action="{{ route('admin.petugas.store') }}" class="rounded-xl border bg-white p-5">
    @include('admin.petugas._form')
</form>
@endsection
