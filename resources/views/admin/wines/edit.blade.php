@extends('layouts.admin')
@section('title', 'Izmena vina')

@section('content')
<h1 class="h3 mb-4">Izmena vina</h1>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.wines.update', $wine) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.wines._form')
            <button type="submit" class="btn btn-danger">Sačuvaj izmene</button>
            <a href="{{ route('admin.wines.index') }}" class="btn btn-secondary">Otkaži</a>
        </form>
    </div>
</div>
@endsection