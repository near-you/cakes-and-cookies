<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::getAuthUserProduct();
        return view('manager.product.index', [
            'products' => $products,
        ]);
    }

    public function allProducts()
    {
        $shop_id = Auth::user()->shop_id;
        $products = Product::all()->where('shop_id', '!=', $shop_id);
        return view('manager.product.all_products', [
            'products' => $products,
        ]);
    }

}
