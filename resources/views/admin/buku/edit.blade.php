@extends('layouts.admin', ['title' => 'Edit Buku'])

@section('content')
<h2 class="mb-5 text-2xl font-bold">Edit Buku</h2>

<form method="POST" action="{{ route('admin.buku.update', $buku) }}" enctype="multipart/form-data" class="rounded-xl border bg-white p-5">
    @include('admin.buku._form')
</form>
@endsection
