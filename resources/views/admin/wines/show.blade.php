<?php 
$src = \Illuminate\Support\Str::startsWith($wine->image, 'http')
        ? $wine->image                          
        : asset('storage/' . $wine->image)  
?>
@extends('layouts.admin')
@section('title', 'Vinarije')

@section('content')

    <div class="row g-5">

        <div class="col-lg-8 ">
            <h3 class="border-bottom pb-3 mb-4 text-dark fw-semibold">{{ $wine->name }}</h3>
            
            <div class="fs-5 lh-lg text-secondary">
                {!! $wine->description !!}
            </div>
            <div>
                    <div class=" rounded shadow-sm ">

                        <input type="image" class="object-fit-cover" src="{{ $src }}" alt="{{ $wine->name }}"  alt="">
                    </div>
            </div>
            

        </div>
    

        <div class="col-lg-4">
            
            <div class="card border-0 shadow-sm bg-light p-3">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-dark mb-4 pb-2 border-bottom">
                        <i class="bi bi-info-circle me-2 text-warning"></i>Ključne informacije
                    </h5>
                    
                    <ul class="list-group list-group-flush bg-transparent">
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-3">
                            <span class="text-muted fw-medium">Država:</span>
                            <strong class="text-dark">{{ $wine->winery->country }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-3">
                            <span class="text-muted fw-medium">Vinski region:</span>
                            <strong class="text-dark">{{ $wine->winery->region }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-3">
                            <span class="text-muted fw-medium">Kategorija:</span>
                            <strong class="text-dark">{{ $wine->category->name }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-3">
                            <span class="text-muted fw-medium">Vinarija:</span>
                            <strong class="text-dark">{{ $wine->winery->name }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-3">
                            <span class="text-muted fw-medium">Cena:</span>
                            <strong class="text-dark">{{ $wine->price }} RSD</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-3">
                            <span class="text-muted fw-medium">Godina:</span>
                            <strong class="text-dark">{{ $wine->year }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-3">
                            <span class="text-muted fw-medium">Kolicine:</span>
                            <strong class="text-dark">{{ $wine->stock }}</strong>
                        </li>
                        
                    </ul>

                    <div class="d-grid gap-2 mt-4">
                         <a href="{{ route('admin.wines.edit', $wine) }}"
                               class="btn btn-sm btn-outline-primary py-2">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.wines.destroy', $wine) }}"
                                  method="POST" 
                                  class="d-grid "
                                  onsubmit="return confirm('Da li sigurno želite da obrišete ovu vinariju?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger py-2">
                                    <i class="bi bi-trash "></i>
                                </button>
                            </form>
                        <a href="{{ route('admin.wines.index') }}" class="btn btn-outline-dark btn-sm rounded-2 py-2">
                            <i class="bi bi-arrow-left me-2"></i>Nazad na sva vina
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection