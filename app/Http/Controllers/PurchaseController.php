<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\InventoryTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $products=Product::all();
        $suppliers=Supplier::all();
        return view('pages.purchases.create', compact('products', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required',
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|numeric|min:1',
            'cost_price.*' => 'required|numeric|min:0',
            'selling_price.*' => 'required|numeric|min:0',
            'expire_date.*' => 'nullable',
        ]);

        DB::beginTransaction();

        try{

            $purchase=Purchase::create([
                'supplier_id' => $request->supplier_id,
                'purchase_date' => $request->purchase_date,
            ]);

            foreach($request->product_id as $index => $productId) {
               PurchaseItem::create([
                    'purchase_id' => $purchase->id, //foreign key id
                    'product_id' => $productId,
                    'quantity' => $request->quantity[$index],
                    'cost_price' => $request->cost_price[$index],
                    'selling_price' => $request->selling_price[$index],
                    'expire_date' => $request->expire_date[$index] ?? null,
                ]);
            }

            foreach($request->product_id as $index => $productId) {

               InventoryTracker::create([
                    'product_id'     => $productId,
                    'quantity'       => $request->quantity[$index],
                    'inventory_type' => 'purchase',
                ]);
            }

            DB::commit();
             return redirect()->route('purchases.create')->with('success', 'Purchase created successfully.');

        }

        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing your request.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
