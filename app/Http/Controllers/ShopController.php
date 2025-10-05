<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // if you have Product model

class ShopController extends Controller
{
    public function index()
    {
        // If you have a Product model:
        if (class_exists(Product::class)) {
            $products = Product::latest()->paginate(12); // or ->get()
        } else {
            // fallback dummy so view always receives $products
            $products = collect([
                (object)[ 'id'=>1, 'name'=>'Sample Dress', 'price'=>1299.00, 'image_url'=>asset('images/sample1.jpg') ],
                (object)[ 'id'=>2, 'name'=>'Summer Top',  'price'=>599.00,  'image_url'=>asset('images/sample2.jpg') ],
            ]);
        }

        return view('shop.index', compact('products'));
    }
}
