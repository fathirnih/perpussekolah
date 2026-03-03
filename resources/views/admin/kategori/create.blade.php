@extends('layouts.admin', ['title' => 'Tambah Kategori'])
@section('content')
<h2 class="mb-5 text-2xl font-bold">Tambah Kategori</h2>
<form method="POST" action="{{ route('admin.kategori.store') }}" class="rounded-xl border bg-white p-5">
    @include('admin.kategori._form')
</form>
@endsection
