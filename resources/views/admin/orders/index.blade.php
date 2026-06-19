@php
    $statusLabels = [
        'pending'   => 'Na čekanju',
        'confirmed' => 'Potvrđeno',
        'delivered' => 'Isporučeno',
        'cancelled' => 'Otkazano',
    ];
@endphp
@extends('layouts.admin')
@section('title', 'Porudžbine')

@section('content')
<h1 class="h3 mb-4">Porudžbine</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <table id="ordersTable" class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kupac</th>
                    <th>Broj stavki</th>
                    <th>Ukupno</th>
                    <th>Status</th>
                    <th>Datum</th>
                    <th class="text-end" data-orderable="false">Akcije</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? '—' }}</td>
                        <td><span class="badge bg-secondary">{{ $order->items_count }}</span></td>
                        <td>{{ number_format($order->total, 2) }} RSD</td>
                        <td>
                            <span @class([
                                'badge' => true,
                                'bg-warning text-dark' => $order->status === 'pending',
                                'bg-info text-dark'    => $order->status === 'confirmed',
                                'bg-success'           => $order->status === 'delivered',
                                'bg-danger'            => $order->status === 'cancelled',
                            ])>
                                {{ $statusLabels[$order->status] ?? $order->status }}
                            </span>
                           
                        </td>
                        <td>{{ $order->created_at->format('d.m.Y.') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detalji
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Nema porudžbina.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
    new DataTable('#ordersTable', {
        language: {
            search: 'Pretraga:',
            lengthMenu: 'Prikaži _MENU_ zapisa',
            info: 'Prikazano _START_–_END_ od _TOTAL_',
            paginate: { previous: 'Prethodna', next: 'Sledeća' },
            zeroRecords: 'Nema rezultata',
            infoEmpty: 'Nema zapisa',
        },
        order: [[0, 'asc']],  
    });
</script>
@endpush