@php
    $statusLabels = [
        'pending'   => 'Na čekanju',
        'confirmed' => 'Potvrđeno',
        'delivered' => 'Isporučeno',
        'cancelled' => 'Otkazano',
    ];
@endphp
@extends('layouts.admin')
@section('title', 'Porudžbina #' . $order->id)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Porudžbina #{{ $order->id }}</h1>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Nazad
    </a>
</div>

<div class="row">

    <div class="col-lg-8 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-white"><strong>Stavke</strong></div>
            <div class="card-body">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Vino</th>
                            <th>Količina</th>
                            <th>Cena</th>
                            <th class="text-end">Ukupno</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->wine->name ?? 'Obrisano vino' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 2) }} RSD</td>
                                <td class="text-end">{{ number_format($item->price * $item->quantity, 2) }} RSD</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold border-top">
                            <td colspan="3" class="text-end">UKUPNO:</td>
                            <td class="text-end">{{ number_format($order->total, 2) }} RSD</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

   
    <div class="col-lg-4 mb-3">
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-white"><strong>Kupac</strong></div>
            <div class="card-body">
                <p class="mb-1">{{ $order->user->name ?? '—' }}</p>
                <p class="mb-0 text-muted">{{ $order->user->email ?? '' }}</p>
                <hr>
                <small class="text-muted">Datum: {{ $order->created_at->format('d.m.Y. H:i') }}</small>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white"><strong>Status</strong></div>
            <div class="card-body">
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="form-select mb-2">
                        @foreach($statusLabels as $value => $label)
                            <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-danger w-100">Ažuriraj status</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection