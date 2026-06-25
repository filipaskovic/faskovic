<?php

namespace App\Http\Controllers;

use App\Models\Wine;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Prikaz korpe
    public function index()
    {
        $cart = session('cart', []);         
        $wines = Wine::whereIn('id', array_keys($cart))->get();

        $items = $wines->map(fn($wine) => (object) [
            'wine'     => $wine,
            'quantity' => $cart[$wine->id],
            'subtotal' => $wine->price * $cart[$wine->id],
        ]);

        $total = $items->sum('subtotal');

        return view('public.cart', compact('items', 'total'));
    }

    // Dodaj vino u korpu
    public function add(Request $request, Wine $wine)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . max($wine->stock, 1),
        ], [
            'quantity.max' => 'Nema dovoljno na stanju.',
        ]);

        if ($wine->stock < 1) {
            return back()->with('error', 'Vino trenutno nije dostupno.');
        }

        $cart = session('cart', []);
        $qty = (int) $request->quantity;

        // ako vino već postoji u korpi, saberi (ali ne preko zaliha)
        $cart[$wine->id] = min(($cart[$wine->id] ?? 0) + $qty, $wine->stock);

        session(['cart' => $cart]);

        return back()->with('success', $wine->name . ' je dodato u korpu.');
    }

    // Izmena količine
    public function update(Request $request, Wine $wine)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . max($wine->stock, 1),
        ]);

        $cart = session('cart', []);
        if (isset($cart[$wine->id])) {
            $cart[$wine->id] = (int) $request->quantity;
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Količina je ažurirana.');
    }

    // Izbaci jedno vino
    public function remove(Wine $wine)
    {
        $cart = session('cart', []);
        unset($cart[$wine->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Vino je uklonjeno iz korpe.');
    }

    // Isprazni korpu
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Korpa je ispražnjena.');
    }


    public function checkout()
    {
            if (! auth()->check()) {
        session(['url.intended' => route('cart.index')]);
        return redirect()->route('login')
            ->with('error', 'Prijavite se da biste završili porudžbinu.');
            }
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Korpa je prazna.');
        }

        $wines = Wine::whereIn('id', array_keys($cart))->get();
        $total = $wines->sum(fn ($w) => $w->price * $cart[$w->id]);

        // Napravi porudžbinu
        $order = Order::create([
            'user_id' => auth()->id(),
            'status'  => 'pending',
            'total'   => $total,
        ]);

        // Napravi stavke + smanji zalihe
        foreach ($wines as $wine) {
            $qty = $cart[$wine->id];

            OrderItem::create([
                'order_id' => $order->id,
                'wine_id'  => $wine->id,
                'quantity' => $qty,
                'price'    => $wine->price,
            ]);

            $wine->decrement('stock', $qty);
        }

        session()->forget('cart');   // isprazni korpu posle porudžbine

        return redirect()->route('orders.my')
            ->with('success', 'Porudžbina je uspešno kreirana!');
    }
}