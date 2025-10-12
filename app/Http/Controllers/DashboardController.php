<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // roduct model and DB seeded:
        if (class_exists(Product::class)) {
            $products = Product::latest()->take(8)->get();
        } else {
            
            $products = collect([]);//products
        }

        return view('dashboard', compact('products'));
    }
}
