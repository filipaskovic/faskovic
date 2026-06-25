<?php

namespace App\Http\Controllers;

use App\Models\Wine;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('items.wine')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('public.my-orders', compact('orders'));
    }


    public function store(Request $request, Wine $wine)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . max($wine->stock, 1),
        ], [
            'quantity.required' => 'Unesite količinu.',
            'quantity.min'      => 'Količina mora biti najmanje 1.',
            'quantity.max'      => 'Nema dovoljno na stanju.',
        ]);

        if ($wine->stock < 1) {
            return back()->with('error', 'Vino trenutno nije dostupno.');
        }

        $quantity = (int) $data['quantity'];
        $total = $wine->price * $quantity;


        $order = Order::create([
            'user_id' => auth()->id(),
            'status'  => 'pending',
            'total'   => $total,
        ]);


        OrderItem::create([
            'order_id' => $order->id,
            'wine_id'  => $wine->id,
            'quantity' => $quantity,
            'price'    => $wine->price,
        ]);


        $wine->decrement('stock', $quantity);

        return redirect()->route('orders.my')
            ->with('success', 'Porudžbina je uspešno kreirana!');
    }
}