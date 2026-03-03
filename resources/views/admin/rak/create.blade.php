@extends('layouts.admin', ['title' => 'Tambah Rak'])
@section('content')
<h2 class="mb-5 text-2xl font-bold">Tambah Rak</h2>
<form method="POST" action="{{ route('admin.rak.store') }}" class="rounded-xl border bg-white p-5">
    @include('admin.rak._form')
</form>
@endsection
