<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('wines')->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info($request);
        $request->validate(
            ['name' => 'required|string|max:255|unique:categories,name'],
            ['name.required' => 'Naziv kategorije je obavezan.',
            'name.unique' => 'Kategorija sa ovim nazivom već postoji']
            
        );

        Category::create(['name'=>$request->name]);

        return redirect()->route('admin.categories.index')
            ->with('success','Kategorija je uspešno dodata');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ],[
            'name.required' => 'Naziv kategorije je obavezan',
            'name.unique' => 'Kategorija sa ovim nazivom već postoji' 
        ]);

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategorija je uspešno izmenjena');       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->wines()->exists()){
            return back()->with('error','Ne možete obrisati kategoriju koja ima vina.');
        }
        $category->delete($category->id);

        return redirect()->route('admin.categories.index')
            ->with('success','Kategorija je obrisana');
    }
}
