<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Winery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WineryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wineries = Winery::withCount('wines')->latest()->get();
        return view('admin.wineries.index',compact('wineries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.wineries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('wineries', 'public');
        }
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('wineries/logos', 'public');
        }

        Winery::create($data);

        return redirect()->route('admin.wineries.index')
            ->with('success', 'Vinarija je uspešno dodata.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Winery $winery)
    {
        return view('admin.wineries.show',compact('winery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Winery $winery)
    {
        return view('admin.wineries.edit',compact('winery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Winery $winery)
    {
         $data = $this->validateData($request);

         if ($request->boolean('remove_image') && $winery->image) {
            $this->deleteFileIfLocal($winery->image);
            $data['image'] = null;
        }
          if ($request->hasFile('image')) {
            $this->deleteFileIfLocal($winery->image);
            $data['image'] = $request->file('image')->store('wineries', 'public');
        }
        if ($request->boolean('remove_logo') && $winery->logo) {
            $this->deleteFileIfLocal($winery->logo);
            $data['logo'] = null;
        }
        if ($request->hasFile('logo')) {
            $this->deleteFileIfLocal($winery->logo);
            $data['logo'] = $request->file('logo')->store('wineries/logos', 'public');
        }
        $winery->update($data);

        return redirect()->route('admin.wineries.index')
            ->with('success', 'Vinarija je uspešno izmenjena.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Winery $winery)
    {
        if($winery->wines()->exists()){
            return back()->with('error','Ne možete obrisati vinariju koja ima vina');
        }
        $this->deleteFileIfLocal($winery->image);
        $this->deleteFileIfLocal($winery->logo);

        $winery->delete($winery->id);

        return redirect()->route('admin.wineries.index')->with('success','Vinarija je obrisana');
    }

    private function deleteFileIfLocal(?string $path): void
{
    if ($path && ! Str::startsWith($path, 'http')) {
        Storage::disk('public')->delete($path);
    }
}
    private function validateData(Request $request): array
    {
        return $request->validate([
            'name'        => 'required|string|max:255',
            'region'      => 'nullable|string|max:255',
            'country'     => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'logo'        => 'nullable|mimes:png,jpg,jpeg,webp,svg|max:1024',
        ], [
            'name.required' => 'Naziv vinarije je obavezan.',
            'image.image'   => 'Fajl mora biti slika.',
            'image.mimes'   => 'Dozvoljeni formati: jpeg, jpg, png, webp.',
            'image.max'     => 'Slika ne sme biti veća od 2MB.',
            'logo.max'      => 'Logo ne sme biti veći od 1MB.',
        ]);
    }

    
}
