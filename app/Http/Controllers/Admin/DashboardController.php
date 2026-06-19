<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Wine;
use App\Models\Winery;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        
        $stats = [
            'wines'      => Wine::count(),
            'categories' => Category::count(),
            'wineries'   => Winery::count(),
            'orders'     => Order::count(),
            'revenue'    => Order::sum('total'),
        ];

        
        $winesByCategory = Category::withCount('wines')->orderBy('name')->get()
            ->map(fn ($c) => [$c->name, $c->wines_count])
            ->toArray();

        
        $labels = [
            'pending'   => 'Na čekanju',
            'confirmed' => 'Potvrđeno',
            'delivered' => 'Isporučeno',
            'cancelled' => 'Otkazano',
        ];
        $ordersByStatus = Order::selectRaw('status, count(*) as cnt')
            ->groupBy('status')
            ->get()
            ->map(fn ($o) => [$labels[$o->status] ?? $o->status, (int) $o->cnt])
            ->toArray();

        return view('admin.dashboard', compact('stats', 'winesByCategory', 'ordersByStatus'));
    }
}
