@extends('layouts.admin')
@section('title', 'Kontrolna tabla')

@section('content')
<h1 class="h3 mb-4">Dashboard</h1>


<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="text-muted small">Ukupno vina</div>
                <div class="h3 mb-0">{{ $stats['wines'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="text-muted small">Kategorije</div>
                <div class="h3 mb-0">{{ $stats['categories'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="text-muted small">Vinarije</div>
                <div class="h3 mb-0">{{ $stats['wineries'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="text-muted small">Porudžbine</div>
                <div class="h3 mb-0">{{ $stats['orders'] }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="text-muted small">Ukupan prihod</div>
        <div class="h3 mb-0 text-danger">{{ number_format($stats['revenue'], 2) }} RSD</div>
    </div>
</div>

{{-- GRAFIKONI --}}
<div class="row g-3">
    <div class="col-lg-7">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white"><strong>Broj vina po kategoriji</strong></div>
            <div class="card-body">
                <div id="winesChart" style="height:320px;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white"><strong>Porudžbine po statusu</strong></div>
            <div class="card-body">
                <div id="ordersChart" style="height:320px;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>

    const winesData  = @json($winesByCategory);
    const ordersData = @json($ordersByStatus);

    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {

        const wines = google.visualization.arrayToDataTable([
            ['Kategorija', 'Broj vina'],
            ...winesData
        ]);
        new google.visualization.ColumnChart(document.getElementById('winesChart')).draw(wines, {
            legend: { position: 'none' },
            colors: ['#5c0a1e'],
            chartArea: { width: '85%', height: '75%' },
        });


        const orders = google.visualization.arrayToDataTable([
            ['Status', 'Broj'],
            ...ordersData
        ]);
        new google.visualization.PieChart(document.getElementById('ordersChart')).draw(orders, {
            colors: ['#dc3545', '#0dcaf0', '#198754', '#e0a800'],
            chartArea: { width: '90%', height: '80%' },
        });
    }

    window.addEventListener('resize', drawCharts);
</script>
@endpush