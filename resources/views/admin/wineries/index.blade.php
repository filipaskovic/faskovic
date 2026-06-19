@extends('layouts.admin')
@section('title', 'Vinarije')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Vinarije</h1>
    <a href="{{ route('admin.wineries.create') }}" class="btn btn-danger">
        <i class="bi bi-plus-lg"></i> Nova vinarija
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table id="wineriesTable" class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Naziv</th>
                    <th>Region</th>
                    <th>Zemlja</th>
                    <th>Broj vina</th>
                    <th class="text-end" data-orderable="false">Akcije</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wineries as $i => $winery)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $winery->name }}</td>
                        <td>{{ $winery->region }}</td>
                        <td>{{ $winery->country }}</td>
                        <td><span class="badge bg-secondary">{{ $winery->wines_count }}</span></td>

                        <td class="text-end">
                            <a href="{{ route('admin.wineries.show',$winery) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <a href="{{ route('admin.wineries.edit', $winery) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.wineries.destroy', $winery) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Da li sigurno želite da obrišete ovu vinariju?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Nema vinarija.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection

@push('scripts')
<script>
    new DataTable('#wineriesTable', {
        language: {
            search: 'Pretraga:',
            lengthMenu: 'Prikaži _MENU_ zapisa',
            info: 'Prikazano _START_–_END_ od _TOTAL_',
            paginate: { previous: 'Prethodna', next: 'Sledeća' },
            zeroRecords: 'Nema rezultata',
            infoEmpty: 'Nema zapisa',
        },
        order: [[1, 'asc']],  
    });
</script>
@endpush