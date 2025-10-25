<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Show all products or filter by category.
     */
    public function index(Request $request)
    {
        $category_id = $request->query('category_id');
        $categories = Category::all();

        $products = Product::when($category_id, function ($query) use ($category_id) {
            $query->where('category_id', $category_id);
        })->paginate(9);

        return view('shop.index', compact('products', 'categories', 'category_id'));
    }

    /**
     * Show single product details.
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('shop.show', compact('product'));
    }
}
