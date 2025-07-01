<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         //   Elequent  ORM
        $values = Brand::all();
        // dd($values);
       return view('pages.brands.index', compact('values'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function create()
    {
        return view('pages.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());

       $request->validate([
            'brand_name' => 'required|string',
            'description' => 'nullable|string|max:255',
        ]);

          Brand::create([
            'brand_name' => $request->brand_name,
            'description' => $request->description,
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('pages.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {

        $request->validate([
            'brand_name' => 'required|string',
            'description' => 'nullable|string|max:255',
        ]);

        $brand->update([
            'brand_name' => $request->brand_name,
            'description' => $request->description,
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete(); //it will delete the record from the database
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
