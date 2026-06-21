@extends('layouts.public')
@section('title', 'Početna — E-Vinoteka')

@section('content')

<!-- Hero Carousel -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="{{ asset('zayshop-assets/img/banner_img_01.jpg') }}" style="max-height: 600px" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><b>E-</b>Vinoteka</h1>
                            <h3 class="h2">Vrhunska vina na dohvat ruke</h3>
                            <p>Pažljivo birana vina iz najboljih domaćih i svetskih vinarija, dostavljena na vašu adresu.</p>
                            <a href="{{ route('catalog') }}" class="btn btn-success">Pogledaj ponudu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="{{ asset('zayshop-assets/img/banner_img_02.avif') }}" style="max-height: 600px" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Izdvajamo iz ponude</h1>
                            <h3 class="h2">Najbolje iz našeg podruma</h3>
                            <p>Otkrijte naša istaknuta vina — provereni izbor naših somelijera.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>

<!-- Kategorije -->

<section class="container py-5">
    <div class="row text-center pt-3 mb-4">
        <div class="col-lg-7 m-auto">
            <h1 class="h1">Naše kategorije</h1>
            <p class="text-muted">Pronađite vino po svom ukusu — od crvenih i belih, do penušavih i desertnih.</p>
        </div>
    </div>

    <div class="d-flex flex-wrap justify-content-center gap-3">
        @foreach($categories as $category)
            <a href="{{ route('catalog', ['category_id' => $category->id]) }}" class="category-pill">
                <i class="fas fa-wine-glass-alt me-2"></i>{{ $category->name }}
            </a>
        @endforeach
    </div>
</section>

<!-- Istaknuta vina -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Izdvajamo iz ponude</h1>
                <p>Naš pažljivo biran izbor istaknutih vina.</p>
            </div>
        </div>
        <div class="row">
            @forelse($featured as $wine)
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="{{ route('wine.show', $wine) }}">

                            <img src="{{ $wine->image_url ?? asset('zayshop-assets/img/feature_prod_01.jpg') }}"
                                 class="card-img-top" alt="{{ $wine->name }}" style="height:260px;object-fit:cover;">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li class="text-muted">{{ $wine->category->name ?? '' }}</li>
                                <li class="text-muted text-right">{{ number_format($wine->price, 2) }} RSD</li>
                            </ul>
                            <a href="{{ route('wine.show', $wine) }}" class="h2 text-decoration-none text-dark">{{ $wine->name }}</a>
                            <p class="card-text mt-2">{{ $wine->winery->name ?? '' }}{{ $wine->year ? ', ' . $wine->year : '' }}</p>
                            <a href="{{ route('wine.show', $wine) }}" class="btn btn-success btn-sm">Opširnije</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Trenutno nema istaknutih vina.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection