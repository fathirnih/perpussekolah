@extends('layouts.admin', ['title' => 'Edit Kategori'])
@section('content')
<h2 class="mb-5 text-2xl font-bold">Edit Kategori</h2>
<form method="POST" action="{{ route('admin.kategori.update', $kategori) }}" class="rounded-xl border bg-white p-5">
    @include('admin.kategori._form')
</form>
@endsection
