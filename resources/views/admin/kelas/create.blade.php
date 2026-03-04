@extends('layouts.admin', ['title' => 'Tambah Kelas'])
@section('content')
<h2 class="mb-5 text-2xl font-bold">Tambah Kelas</h2>
<form method="POST" action="{{ route('admin.kelas.store') }}" class="rounded-xl border bg-white p-5">
    @include('admin.kelas._form')
</form>
@endsection

