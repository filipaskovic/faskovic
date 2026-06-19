@extends('layouts.admin')
@section('title', 'Nova vinarija')

@section('content')
<h1 class="h3 mb-4">Nova vinarija</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.wineries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.wineries._form')
            <button type="submit" class="btn btn-danger">Sačuvaj</button>
            <a href="{{ route('admin.wineries.index') }}" class="btn btn-secondary">Otkaži</a>
        </form>
    </div>
</div>
@endsection