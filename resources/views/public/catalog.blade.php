@extends('layouts.public')
@section('title', 'Vinska karta — E-Vinoteka')

@section('content')
<div class="container py-5">
    <div class="row">

        {{-- SIDEBAR: kategorije kao filteri --}}
        <div class="col-lg-3">
            <h1 class="h2 pb-4">Kategorije</h1>
            <ul>
                {{-- klasa povezana sa javascriptom koji ima preventDefault() metodu koja sprecava funkciju linka --}}
            {{-- <ul class="list-unstyled templatemo-accordion"> --}}
                <li class="pb-2">
                    <a class="text-decoration-none {{ !request('category_id') ? 'text-success fw-bold' : 'text-dark' }}"
                       href="{{ route('catalog') }}">
                        Sva vina
                    </a>
                </li>
                @foreach($categories as $category)
                    <li class="pb-2">
                        <a class="text-decoration-none {{ request('category_id') == $category->id ? 'text-success fw-bold' : 'text-dark' }}"
                           href="{{ route('catalog', ['category_id' => $category->id]) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- GLAVNI DEO: grid vina --}}
        <div class="col-lg-9">
            <div class="row mb-3">
                <div class="col-12">
                    <h2 class="h4 text-muted">
                        {{ $wines->count() }}
                        {{ $wines->count() == 1 ? 'vino' : 'vina' }} u ponudi
                    </h2>
                </div>
            </div>

            <div class="row">
                @forelse($wines as $wine)
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid"
                                     src="{{ $wine->image_url ?? asset('zayshop-assets/img/shop_01.jpg') }}"
                                     style="height:300px;object-fit:cover;"
                                     alt="{{ $wine->name }}">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="btn btn-success text-white" href="{{ route('wine.show', $wine) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('wine.show', $wine) }}" class="h3 text-decoration-none">{{ $wine->name }}</a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li class="text-muted">{{ $wine->category->name ?? '' }}</li>
                                    <li class="text-muted">{{ $wine->winery->name ?? '' }}</li>
                                </ul>
                                <p class="text-center mb-0 mt-2 h5">{{ number_format($wine->price, 2) }} RSD</p>
                                <div class="text-center mt-2">
                                    <a href="{{ route('wine.show', $wine) }}" class="btn btn-sm btn-success">Opširnije</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted text-center py-5">Nema vina u ovoj kategoriji.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection