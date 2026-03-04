@extends('layouts.admin', ['title' => 'Edit Dokumentasi'])

@section('content')
<h2 class="mb-5 text-2xl font-bold">Edit Dokumentasi</h2>

<form method="POST" action="{{ route('admin.dokumentasi.update', $dokumentasi) }}" enctype="multipart/form-data" class="rounded-xl border bg-white p-5">
    @include('admin.dokumentasi._form')
</form>
@endsection
