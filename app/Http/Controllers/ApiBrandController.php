<?php
namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $values = Brand::all();
        if ($values->isEmpty()) {
            return response()->json([
                'status'  => '404',
                'message' => 'No brands found in the database table.',
            ]);
        } else {
            return response()->json([
                'status'  => '200',
                'message' => 'Brands retrieved successfully.',
                'data'    => $values,
            ]);
        }
    }

 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'brand_name'  => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => '422',
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        } else {

            $brand = Brand::create(
                [
                    'brand_name'  => $request->brand_name,
                    'description' => $request->description,
                ]
            );

            return response()->json([
                'status'  => '201',
                'message' => 'Brand created successfully.',
                'data'    => $brand,
            ]);
        }

    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $brand = Brand::find($id);
        if (is_null($brand)) {
            return response()->json([
                'status'  => '404',
                'message' => 'Brand not found.',
            ], 404);
        } else {
            return response()->json([
                'status'  => '200',
                'message' => 'Brand retrieved successfully.',
                'data'    => $brand,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $brand = Brand::find($id);

        if (is_null($brand)) {
            return response()->json([
                'status'  => '404',
                'message' => 'Brand not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'brand_name'  => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => '422',
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $brand->update([
            'brand_name'  => $request->brand_name,
            'description' => $request->description,
        ]);

        return response()->json([
            'status'  => '200',
            'message' => 'Brand updated successfully.',
            'data'    => $brand,
        ]);
    }

    
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if (is_null($brand)) {
            return response()->json([
                'status'  => '404',
                'message' => 'Brand not found.',
            ], 404);
        } else {
            $brand->delete();
            return response()->json([
                'status'  => '200',
                'message' => 'Brand deleted successfully.',
            ]);
        }
    }
}
