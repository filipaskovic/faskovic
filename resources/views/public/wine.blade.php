@extends('layouts.public')
@section('title', $wine->name . ' — E-Vinoteka')

@section('content')
<section class="bg-light">
    <div class="container py-5">

        {{-- Breadcrumb --}}
        <nav class="pb-4">
            <a href="{{ route('home') }}" class="text-decoration-none text-muted">Početna</a>
            <span class="text-muted mx-1">/</span>
            <a href="{{ route('catalog') }}" class="text-decoration-none text-muted">Vinska karta</a>
            <span class="text-muted mx-1">/</span>
            <span>{{ $wine->name }}</span>
        </nav>

        <div class="row">
            {{-- Slika --}}
            <div class="col-lg-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid"
                         src="{{ $wine->image_url ?? asset('zayshop-assets/img/product_single_01.jpg') }}"
                         alt="{{ $wine->name }}"
                         style="height:480px;object-fit:contain;">
                </div>
            </div>

            {{-- Info --}}
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2">{{ $wine->name }}</h1>
                        <p class="h3 py-2 text-success">{{ number_format($wine->price, 2) }} RSD</p>

                        <ul class="list-inline">
                            <li class="list-inline-item"><h6 class="d-inline">Vinarija:</h6></li>
                            <li class="list-inline-item"><span class="text-muted"><strong>{{ $wine->winery->name ?? '—' }}</strong></span></li>
                        </ul>

                        <ul class="list-inline">
                            <li class="list-inline-item"><h6 class="d-inline">Kategorija:</h6></li>
                            <li class="list-inline-item"><span class="text-muted">{{ $wine->category->name ?? '—' }}</span></li>
                            @if($wine->year)
                                <li class="list-inline-item ms-3"><h6 class="d-inline">Godina:</h6></li>
                                <li class="list-inline-item"><span class="text-muted">{{ $wine->year }}</span></li>
                            @endif
                        </ul>

                        {{-- Dostupnost --}}
                        <p class="py-2">
                            @if($wine->stock > 0)
                                <span class="badge bg-success">Na stanju ({{ $wine->stock }})</span>
                            @else
                                <span class="badge bg-danger">Trenutno nedostupno</span>
                            @endif
                        </p>

                        <h6>Opis:</h6>
                        <div class="wine-description text-muted">
                            {!! $wine->description ?: '<p>Opis nije dostupan.</p>' !!}
                        </div>

                       
                        <div class="row pt-3">
                            <div class="col">
                                    @auth
                                        @if($wine->stock > 0)
                                            <form action="{{ route('cart.add', $wine) }}" method="POST">
                                                @csrf
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-4">
                                                        <label for="quantity" class="form-label">Količina</label>
                                                        <input type="number" name="quantity" id="quantity"
                                                            class="form-control @error('quantity') is-invalid @enderror"
                                                            value="{{ old('quantity', 1) }}" min="1" max="{{ $wine->stock }}" required>
                                                        @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                    <div class="col-8 d-grid">
                                                        <button type="submit" class="btn btn-success btn-lg">
                                                            <i class="fas fa-cart-plus"></i> Dodaj u korpu
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary btn-lg" disabled>Trenutno nedostupno</button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline-success btn-lg">
                                            Prijavi se za kupovinu
                                        </a>
                                    @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection