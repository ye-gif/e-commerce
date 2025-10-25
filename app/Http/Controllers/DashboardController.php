<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // product model and DB seeded:
        if (class_exists(Product::class)) {
            $products = Product::latest()->take(8)->get();
        } else {
            
            $products = collect([]);
        }

        return view('dashboard', compact('products'));
    }
}
