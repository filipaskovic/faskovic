<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){

        $orders = Order::with('user')
            ->withCount('items')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }
    public function show(Order $order)
    {
        $order->load('user', 'items.wine');
        return view('admin.orders.show', compact('order'));
    }
    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,delivered,cancelled',
        ], [
            'status.required' => 'Status je obavezan.',
            'status.in'       => 'Nevažeći status.',
        ]);

        $order->update($data);

        return back()->with('success', 'Status porudžbine je ažuriran.');
    }
}
