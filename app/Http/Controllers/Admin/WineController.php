<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Wine;
use App\Models\Winery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $wines = Wine::with(['category', 'winery'])
            ->when($request->category_id, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($request->winery_id, function ($query, $wineryId) {
                $query->where('winery_id', $wineryId);
            })
            ->latest()
            ->get();

        return view('admin.wines.index', [
            'wines'      => $wines,
            'categories' => Category::orderBy('name')->get(),
            'wineries'   => Winery::orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.wines.create', [
            'categories' => Category::orderBy('name')->get(),
            'wineries'   => Winery::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('wines', 'public');
        }

        Wine::create($data);

        return redirect()->route('admin.wines.index')
            ->with('success', 'Vino je uspešno dodato.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Wine $wine)
    {
        return view('admin.wines.show',compact('wine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wine $wine)
    {
        return view('admin.wines.edit', [
            'wine'       => $wine,
            'categories' => Category::orderBy('name')->get(),
            'wineries'   => Winery::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wine $wine)
    {
        $data = $this->validateData($request);

        $data['featured'] = $request->boolean('featured');

        if ($request->boolean('remove_image') && $wine->image) {
            $this->deleteFileIfLocal($wine->image);
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            $this->deleteFileIfLocal($wine->image);
            $data['image'] = $request->file('image')->store('wines', 'public');
        }

        $wine->update($data);

        return redirect()->route('admin.wines.index')
            ->with('success', 'Vino je uspešno izmenjeno.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wine $wine)
    {
        $this->deleteFileIfLocal($wine->image);
        $wine->delete($wine->id);

        return redirect()->route('admin.wines.index')
            ->with('success', 'Vino je obrisano.');
    }

        private function validateData(Request $request): array
    {
        return $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'year'        => 'nullable|integer|min:1900|max:' . date('Y'),
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'winery_id'   => 'required|exists:wineries,id',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ], [
            'name.required'        => 'Naziv vina je obavezan.',
            'price.required'       => 'Cena je obavezna.',
            'price.numeric'        => 'Cena mora biti broj.',
            'category_id.required' => 'Izaberite kategoriju.',
            'category_id.exists'   => 'Izabrana kategorija ne postoji.',
            'winery_id.required'   => 'Izaberite vinariju.',
            'winery_id.exists'     => 'Izabrana vinarija ne postoji.',
            'image.image'          => 'Fajl mora biti slika.',
            'image.max'            => 'Slika ne sme biti veća od 2MB.',
        ]);
    }

    private function deleteFileIfLocal(?string $path): void
    {
        if ($path && ! Str::startsWith($path, 'http')) {
            Storage::disk('public')->delete($path);
            
        }
    }
}
