@extends('layouts.admin')
@section('title', 'Novo vino')

@section('content')
<h1 class="h3 mb-4">Novo vino</h1>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.wines.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.wines._form')
            <button type="submit" class="btn btn-danger">Sačuvaj</button>
            <a href="{{ route('admin.wines.index') }}" class="btn btn-secondary">Otkaži</a>
        </form>
    </div>
</div>
@endsection