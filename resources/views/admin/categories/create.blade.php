@extends('layouts.admin')
@section('title', 'Nova kategorija')

@section('content')
<h1 class="h3 mb-4">Nova kategorija</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Naziv kategorije</label>
                <input type="text" name="name" id="name"
                       class="form-control @error('name') is-invalid @enderror"
                         maxlength="255">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-danger">Sačuvaj</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Otkaži</a>
        </form>
    </div>
</div>
@endsection