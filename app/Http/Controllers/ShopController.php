<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $category_id = $request->get('category_id');
        $search = $request->get('search');
        $categories = Category::all();

        $query = Product::query();

        // Filter by category if selected
        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        // Case-insensitive search by product name, description, or category name
        if ($search) {
            $searchLower = strtolower($search);
            $query->where(function ($q) use ($searchLower) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$searchLower}%"])
                  ->orWhereRaw('LOWER(description) LIKE ?', ["%{$searchLower}%"])
                  ->orWhereHas('category', function($catQuery) use ($searchLower) {
                      $catQuery->whereRaw('LOWER(name) LIKE ?', ["%{$searchLower}%"]);
                  });
            });
        }

        $products = $query->paginate(9)->appends($request->all());

        return view('shop.index', compact('products', 'categories', 'category_id', 'search'));
    }
}
