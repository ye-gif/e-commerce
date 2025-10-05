<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // if you have this model

class DashboardController extends Controller
{
    public function index()
    {
        // If you have a Product model and DB seeded:
        if (class_exists(Product::class)) {
            $products = Product::latest()->take(8)->get();
        } else {
            // fallback dummy products so view always has something
            $products = collect([
                (object)[ 'id' => 1, 'name' => 'Sample Dress', 'price' => 1299.00, 'image_url' => asset('images/sample1.jpg') ],
                (object)[ 'id' => 2, 'name' => 'Summer Top',   'price' => 599.00,  'image_url' => asset('images/sample2.jpg') ],
            ]);
        }

        return view('dashboard', compact('products'));
    }
}
