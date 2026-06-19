<?php 
$src = \Illuminate\Support\Str::startsWith($winery->image, 'http')
        ? $winery->image                          
        : asset('storage/' . $winery->image)  
?>
@extends('layouts.admin')
@section('title', 'Vinarije')

@section('content')

    <div class="row g-5">

        <div class="col-lg-8 ">
            <h3 class="border-bottom pb-3 mb-4 text-dark fw-semibold">{{ $winery->name }}</h3>
            
            
            <div style="max-width: 1200px; width: 100%;">
                    <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden">

                        <input type="image" class="object-fit-cover" src="{{ $src }}" alt="{{ $winery->name }}"  alt="">
                    </div>
            </div>
            <div class="fs-5 lh-lg text-secondary">
                {!! $winery->description !!}
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
                            <strong class="text-dark">{{ $winery->country }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-3">
                            <span class="text-muted fw-medium">Vinski region:</span>
                            <strong class="text-dark">{{ $winery->region }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-3">
                            <span class="text-muted fw-medium">Status preporuke:</span>
                            <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Vrhunski kvalitet</span>
                        </li>
                    </ul>

                    <div class="d-grid gap-2 mt-4">
                         <a href="{{ route('admin.wineries.edit', $winery) }}"
                               class="btn btn-sm btn-outline-primary py-2">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.wineries.destroy', $winery) }}"
                                  method="POST" 
                                  class="d-grid "
                                  onsubmit="return confirm('Da li sigurno želite da obrišete ovu vinariju?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger py-2">
                                    <i class="bi bi-trash "></i>
                                </button>
                            </form>
                        <a href="{{ route('admin.wineries.index') }}" class="btn btn-outline-dark btn-sm rounded-2 py-2">
                            <i class="bi bi-arrow-left me-2"></i>Nazad na sve vinarije
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection