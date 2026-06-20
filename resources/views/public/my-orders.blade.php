@extends('layouts.public')
@section('title', 'Moje porudžbine — E-Vinoteka')

@section('content')
<div class="container py-5">
    <h1 class="h2 mb-4">Moje porudžbine</h1>

    @php
        $statusLabels = [
            'pending'   => 'Na čekanju',
            'confirmed' => 'Potvrđeno',
            'delivered' => 'Isporučeno',
            'cancelled' => 'Otkazano',
        ];
    @endphp

    @forelse($orders as $order)
        <div class="card mb-3 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span><strong>Porudžbina #{{ $order->id }}</strong>
                    <small class="text-muted ms-2">{{ $order->created_at->format('d.m.Y. H:i') }}</small>
                </span>
                <span  @class([
                        'badge' => true,
                        'bg-warning text-dark' => $order->status === 'pending',
                        'bg-info text-dark'    => $order->status === 'confirmed',
                        'bg-success'           => $order->status === 'delivered',
                        'bg-danger'            => $order->status === 'cancelled',
                    ])">
                    {{ $statusLabels[$order->status] ?? $order->status }}
                </span>
            </div>
            <div class="card-body">
                <table class="table mb-0">
                    <thead>
                        <tr><th>Vino</th><th>Količina</th><th>Cena</th><th class="text-end">Ukupno</th></tr>
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
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">UKUPNO:</td>
                            <td class="text-end">{{ number_format($order->total, 2) }} RSD</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <p class="text-muted">Još nemate porudžbina.</p>
            <a href="{{ route('catalog') }}" class="btn btn-success">Pogledaj ponudu</a>
        </div>
    @endforelse
</div>
@endsection