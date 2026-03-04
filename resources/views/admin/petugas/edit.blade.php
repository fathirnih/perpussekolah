@extends('layouts.admin', ['title' => 'Edit Petugas'])
@section('content')
<h2 class="mb-5 text-2xl font-bold">Edit Petugas</h2>
<form method="POST" action="{{ route('admin.petugas.update', $petugas) }}" class="rounded-xl border bg-white p-5">
    @include('admin.petugas._form')
</form>
@endsection
