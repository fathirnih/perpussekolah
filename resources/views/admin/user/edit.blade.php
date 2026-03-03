@extends('layouts.admin', ['title' => 'Edit Admin'])

@section('content')
<h2 class="mb-5 text-2xl font-bold">Edit Admin</h2>
<form method="POST" action="{{ route('admin.user.update', $adminUser) }}" class="rounded-xl border bg-white p-5">
    @include('admin.user._form')
</form>
@endsection
