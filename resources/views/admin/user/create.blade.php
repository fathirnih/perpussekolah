@extends('layouts.admin', ['title' => 'Tambah Admin'])

@section('content')
<h2 class="mb-5 text-2xl font-bold">Tambah Admin</h2>
<form method="POST" action="{{ route('admin.user.store') }}" class="rounded-xl border bg-white p-5">
    @include('admin.user._form')
</form>
@endsection
