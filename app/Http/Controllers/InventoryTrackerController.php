<?php

namespace App\Http\Controllers;

use App\Models\InventoryTracker;
use Illuminate\Http\Request;

class InventoryTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalStockByProducts=InventoryTracker::select('product_id')->selectRaw('SUM(quantity) as total_quantity')->groupBy('product_id')->with('product')->get();
       return view('pages.inventory_trackers.index', compact('totalStockByProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryTracker $inventoryTracker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryTracker $inventoryTracker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InventoryTracker $inventoryTracker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryTracker $inventoryTracker)
    {
        //
    }
}
