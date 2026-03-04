@extends('layouts.admin', ['title' => 'Tambah Siswa'])
@section('content')
<h2 class="mb-5 text-2xl font-bold">Tambah Siswa</h2>
<form method="POST" action="{{ route('admin.siswa.store') }}" enctype="multipart/form-data" class="rounded-xl border bg-white p-5">
    @include('admin.siswa._form')
</form>
@endsection
