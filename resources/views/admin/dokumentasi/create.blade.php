@extends('layouts.admin', ['title' => 'Tambah Dokumentasi'])

@section('content')
<h2 class="mb-5 text-2xl font-bold">Tambah Dokumentasi</h2>

<form method="POST" action="{{ route('admin.dokumentasi.store') }}" enctype="multipart/form-data" class="rounded-xl border bg-white p-5">
    @include('admin.dokumentasi._form')
</form>
@endsection
