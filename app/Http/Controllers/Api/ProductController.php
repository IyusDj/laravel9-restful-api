<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        // Get products
        $product = Product::latest()->paginate(3);

        // Return collection of product as a resource
        return new ProductResource(true, 'List Data Product', $product);
    }

    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'price'     => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create data product
        $product = Product::create([
            'name'      => $request->name,
            'price'     => $request->price,
        ]);

        //return response
        return new ProductResource(true, ' Success Add Data Product!', $product);
    }

    public function show(Product $product)
    {
        // Return single product as a resource
        return new ProductResource(true, 'Show Data Product By Id!', $product);
    }

    public function update(Request $request, Product $product)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'price'     => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update data
        $product->update([
            'name'      => $request->name,
            'price'     => $request->price,
        ]);
        
        // Return response
        return new ProductResource(true, 'Data Product Success Changed!', $product);
    }

    public function destroy(Product $product)
    {
        // Delete product
        $product->delete();

        // Return response
        return new ProductResource(true, 'Data Product Success Deleted!', null);
    }
}
