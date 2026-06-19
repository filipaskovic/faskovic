<?php

namespace App\Http\Controllers;

use App\Models\Wine;
use App\Models\Category;

class PublicController extends Controller
{
    // Početna — istaknuta vina + kategorije
    public function home()
    {
        $featured = Wine::with(['category', 'winery'])
            ->where('featured', true)
            ->latest()->take(6)->get();

        $categories = Category::orderBy('name')->get();

        return view('public.home', compact('featured', 'categories'));
    }

    // Vinska karta — sva vina (sa opcionim filterom po kategoriji)
    public function catalog()
    {
        $wines = Wine::with(['category', 'winery'])
            ->when(request('category_id'), fn ($q, $id) => $q->where('category_id', $id))
            ->latest()->get();

        $categories = Category::orderBy('name')->get();

        return view('public.catalog', compact('wines', 'categories'));
    }

    // Detaljna strana jednog vina
    public function wine(Wine $wine)
    {
        $wine->load('category', 'winery');
        return view('public.wine', compact('wine'));
    }

    // Kontakt
    public function contact()
    {
        return view('public.contact');
    }
}