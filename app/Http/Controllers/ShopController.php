<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        if (class_exists(Product::class)) {
            $products = Product::latest()->paginate(12); // or ->get()
        } else {
            
            $products = collect([ ]);//view always receives $products
        }

        return view('shop.index', compact('products'));
    }
}
