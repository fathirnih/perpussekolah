@extends('layouts.admin', ['title' => 'Edit Siswa'])
@section('content')
<h2 class="mb-5 text-2xl font-bold">Edit Siswa</h2>
<form method="POST" action="{{ route('admin.siswa.update', $siswa) }}" enctype="multipart/form-data" class="rounded-xl border bg-white p-5">
    @include('admin.siswa._form')
</form>
@endsection
