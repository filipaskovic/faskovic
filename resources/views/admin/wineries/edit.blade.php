@extends('layouts.admin')
@section('title', 'Izmena vinarije')

@section('content')
<h1 class="h3 mb-4">Izmena vinarije</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.wineries.update', $winery) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.wineries._form')
            <button type="submit" class="btn btn-danger">Sačuvaj izmene</button>
            <a href="{{ route('admin.wineries.index') }}" class="btn btn-secondary">Otkaži</a>
        </form>
    </div>
</div>
@endsection