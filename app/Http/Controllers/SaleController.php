<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\InventoryTracker;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with(['customer','saleItems.product'])->orderBy('id', 'desc')->get();
        return view('pages.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $products=Product::all();
        $customers=Customer::all();
        return view('pages.sales.create', compact('products', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */

         public function store(Request $request)
    {



        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'sale_date' => 'required',
            'total' => 'required|numeric|min:0',
            'final_discount' => 'required|numeric|min:0',
            'final_total' => 'required|numeric|min:0',

            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|numeric|min:1',
            'discount.*' => 'required|numeric|min:0',
            'selling_price.*' => 'required|numeric|min:0',
            'final_price.*' => 'required|numeric|min:0',
        ]);

        // Generate unique SKU code start
        $lastSale = Sale::orderBy('id', 'desc')->first();
        if ($lastSale && $lastSale->invoice_number) {
            $lastSkuNumber = (int) str_replace('INV', '', $lastSale->invoice_number);
            $newSkuNumber = $lastSkuNumber + 1;
        } else {
            $newSkuNumber = 1;
        }
        $invoice_number = 'INV' . str_pad($newSkuNumber, 3, '0', STR_PAD_LEFT);

        // Generate unique SKU code end

        DB::beginTransaction();

        try{

             foreach($request->product_id as $index => $productId) {

               $saleQuantity = $request->quantity[$index];
               $product = Product::find($productId);
               $currentStock = InventoryTracker::where('product_id', $productId)->sum('quantity');

                $saleQuantity = $request->quantity[$index];
               $product = Product::find($productId);
               $currentStock = InventoryTracker::where('product_id', $productId)->sum('quantity');

               if($currentStock < $saleQuantity) {
                    DB::rollBack();
                    return redirect()->back()->with('error',"Insufficient stock for product: {$product->product_name} . Available: {$currentStock}, Requested Quantity: {$saleQuantity}")->withInput();
                }
            }


            $sale=Sale::create([
                'customer_id' => $request->customer_id,
                'sale_date' => $request->sale_date,
                'total' => $request->total,
                'final_discount' => $request->final_discount,
                'final_total' => $request->final_total,
                'invoice_number' => $invoice_number,
            ]);

            foreach($request->product_id as $index => $productId) {
               SaleItem::create([
                    'sale_id' => $sale->id, //foreign key id
                    'product_id' => $productId,
                    'quantity' => $request->quantity[$index],
                    'discount' => $request->discount[$index],
                    'selling_price' => $request->selling_price[$index],
                    'final_price' => $request->final_price[$index],
                ]);
            }

            foreach($request->product_id as $index => $productId) {
               InventoryTracker::create([
                    'product_id'     => $productId,
                    'quantity'       => -1 * $request->quantity[$index],
                    'inventory_type' => 'sale',
                ]);
            }

            DB::commit();
             return redirect()->route('sales.invoice', $sale->id)->with('success', 'Sales created successfully.');

        }

        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing your request.']);
        }
    }


    public function invoice($id)
    {
        $sales = Sale::with('customer','saleItems.product')->findOrFail($id);
      

        return view('pages.sales.invoice', compact('sales'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
