
@extends('layouts.admin')
@section('title', 'Vinarije')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Vina</h1>
    <a href="{{ route('admin.wines.create') }}" class="btn btn-danger">
        <i class="bi bi-plus-lg"></i> Novo vino
    </a>
</div>
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.wines.index') }}" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label for="filter_category" class="form-label mb-1">Kategorija</label>
                <select name="category_id" id="filter_category" class="form-select">
                    <option value="">Sve kategorije</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-5">
                <label for="filter_winery" class="form-label mb-1">Vinarija</label>
                <select name="winery_id" id="filter_winery" class="form-select">
                    <option value="">Sve vinarije</option>
                    @foreach($wineries as $winery)
                        <option value="{{ $winery->id }}"
                            {{ request('winery_id') == $winery->id ? 'selected' : '' }}>
                            {{ $winery->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-danger flex-grow-1">
                    <i class="bi bi-funnel"></i> Filtriraj
                </button>
                @if(request('category_id') || request('winery_id'))
                    <a href="{{ route('admin.wines.index') }}" class="btn btn-outline-secondary"
                       title="Poništi filtere">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table id="winesTable" class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th data-orderable="false">Slika</th>
                    <th>Naziv</th>
                    <th>Kategorija</th>
                    <th>Vinarija</th>
                    <th>Cena</th>
                    <th>Kolicine</th>
                    <th class="text-end" data-orderable="false">Akcije</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wines as $i => $wine)
    <tr>
        <td>
            {{ $i+1 }}
        </td>
        <td>
            @if($wine->image)
                @php
                    $src = \Illuminate\Support\Str::startsWith($wine->image, 'http')
                        ? $wine->image : asset('storage/' . $wine->image);
                @endphp
                <img src="{{ $src }}" style="height:40px;width:55px;border-radius:.3rem;object-fit:contain">
            @else
                <span class="text-muted">—</span>
            @endif
        </td>
        <td>
            {{ $wine->name }}
            @if($wine->featured)
                <span class="badge bg-warning text-dark ms-1">Istaknuto</span>
            @endif
        </td>
        <td>{{ $wine->category->name ?? '—' }}</td>
        <td>{{ $wine->winery->name ?? '—' }}</td>
        <td>{{ number_format($wine->price, 2) }} RSD</td>
        <td>{{ $wine->stock }}</td>
        <td class="text-end">
            <a href="{{ route('admin.wines.show',$wine) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-three-dots"></i>
                            </a>
            <a href="{{ route('admin.wines.edit', $wine) }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-pencil"></i>
            </a>
            <form action="{{ route('admin.wines.destroy', $wine) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Obrisati ovo vino?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
        </td>
    </tr>
@empty
    <tr><td colspan="6" class="text-center text-muted py-4">Nema vina.</td></tr>
@endforelse

            </tbody>
        </table>
    </div>
</div>


@endsection
@push('scripts')
<script>
    new DataTable('#winesTable', {
        language: {
            search: 'Pretraga:',
            lengthMenu: 'Prikaži _MENU_ zapisa',
            info: 'Prikazano _START_-_END_ od _TOTAL_',
            paginate: { previous: 'Prethodna', next: 'Sledeća' },
            zeroRecords: 'Nema rezultata',
            infoEmpty: 'Nema zapisa',
        },
        order: [[1, 'asc']],  
    });
</script>
@endpush