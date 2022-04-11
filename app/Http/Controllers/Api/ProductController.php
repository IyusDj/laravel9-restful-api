<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        // Get products
        $product = Product::latest()->paginate(4);

        // Return collection of product as a resource
        return new ProductResource(true, 'List Data Product', $product);
    }
}
