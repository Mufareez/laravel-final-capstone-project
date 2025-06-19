<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('pages.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
          $request->validate([
            'product_name' => 'required|string',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5128', // 5MB max
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0|gte:cost_price',
        ]);

        // image upload code start
        if ($request->hasFile('product_image')) {

            $pictureFile = $request->file('product_image'); //6106921742741128290.jpg
            $pictureFileName = time() . '_product_image.' . $pictureFile->extension(); //1747669717_picture.jpg
            $pictureFile->move(public_path('images/product'), $pictureFileName); //images/1746813027_681e40636edeb.jpg

        } else {
            $pictureFileName = null;
        }
        // image upload code end


       // Generate unique SKU code start
        $lastProduct = Product::orderBy('id', 'desc')->first();
        if ($lastProduct && $lastProduct->sku) {
            $lastSkuNumber = (int) str_replace('SKU', '', $lastProduct->sku);
            $newSkuNumber = $lastSkuNumber + 1;
        } else {
            $newSkuNumber = 1;
        }
        $sku = 'SKU' . str_pad($newSkuNumber, 3, '0', STR_PAD_LEFT);

        // Generate unique SKU code end



        // Create a new product

        Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'cost_price' => $request->cost_price,
            'selling_price' => $request->selling_price,
            'product_image' => $pictureFileName,
            'sku' => $sku,
        ]);

         return redirect()->route('products.index')->with('success', 'Product created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all(); // Fetch all categories to populate dropdowns
        $brands = Brand::all(); // Fetch all brands to populate dropdowns


        $product->load('category', 'brand'); // Eager load category and brand relationships

        return view('pages.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
         // Validate the request data
          $request->validate([
            'product_name' => 'required|string',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5128', // 5MB max
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0|gte:cost_price',
        ]);

       // image upload code start
        if ($request->hasFile('product_image')) {

            $pictureFile = $request->file('product_image'); //6106921742741128290.jpg
            $pictureFileName = time() . '_product_image.' . $pictureFile->extension(); //1747669717_picture.jpg
            $pictureFile->move(public_path('images/product/'), $pictureFileName); //images/1746813027_681e40636edeb.jpg

            //  image delete code start
            if ($product->product_image) {
                $file_path = public_path('images/product/' . $product->product_image);
                if (file_exists($file_path)) {
                    unlink($file_path); //it will delete the image from the folder
                }
            }
            // image delete code end

        } else {
            $pictureFileName = $product->product_image; // if the image is not updated, keep the old image name
        }
        // image upload code end


        // Create a new product

         $product->update([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'cost_price' => $request->cost_price,
            'selling_price' => $request->selling_price,
            'product_image' => $pictureFileName,
        ]);

         return redirect()->route('products.index')->with('success', 'Product Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        // Delete the product image if it exists
        if ($product->product_image) {
            $file_path = public_path('images/product/' . $product->product_image);
            if (file_exists($file_path)) {
                unlink($file_path); // Delete the image file from the server
            }
        }

        // Delete the product record from the database
        $product->delete();
        
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
