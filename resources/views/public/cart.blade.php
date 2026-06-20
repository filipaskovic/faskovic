@extends('layouts.public')
@section('title', 'Korpa — E-Vinoteka')

@section('content')
<div class="container py-5">
    <h1 class="h2 mb-4">Vaša korpa</h1>

    @if($items->isEmpty())
        <div class="text-center py-5">
            <p class="text-muted">Korpa je prazna.</p>
            <a href="{{ route('catalog') }}" class="btn btn-success">Pogledaj ponudu</a>
        </div>
    @else
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Vino</th>
                            <th style="width:160px;">Količina</th>
                            <th>Cena</th>
                            <th class="text-end">Ukupno</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('wine.show', $item->wine) }}" class="text-decoration-none text-dark">
                                        {{ $item->wine->name }}
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('cart.update', $item->wine) }}" method="POST" class="d-flex gap-1">
                                        @csrf @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                               min="1" max="{{ $item->wine->stock }}" class="form-control form-control-sm">
                                        <button class="btn btn-sm btn-outline-secondary" title="Ažuriraj">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ number_format($item->wine->price, 2) }} RSD</td>
                                <td class="text-end">{{ number_format($item->subtotal, 2) }} RSD</td>
                                <td class="text-end">
                                    <form action="{{ route('cart.remove', $item->wine) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Izbaci">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold border-top">
                            <td colspan="3" class="text-end">UKUPNO:</td>
                            <td class="text-end">{{ number_format($total, 2) }} RSD</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger">Isprazni korpu</button>
            </form>

            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button class="btn btn-success btn-lg">
                    <i class="fas fa-check"></i> Poruči
                </button>
            </form>
        </div>
    @endif
</div>
@endsection