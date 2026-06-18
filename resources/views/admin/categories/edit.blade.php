@extends('layouts.admin')
@section('title', 'Izmena kategorije')

@section('content')
<h1 class="h3 mb-4">Izmena kategorije</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Naziv kategorije</label>
                <input type="text" name="name" id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $category->name) }}" required maxlength="255">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-danger">Sačuvaj izmene</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Otkaži</a>
        </form>
    </div>
</div>
@endsection