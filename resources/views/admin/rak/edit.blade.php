@extends('layouts.admin', ['title' => 'Edit Rak'])
@section('content')
<h2 class="mb-5 text-2xl font-bold">Edit Rak</h2>
<form method="POST" action="{{ route('admin.rak.update', $rak) }}" class="rounded-xl border bg-white p-5">
    @include('admin.rak._form')
</form>
@endsection
