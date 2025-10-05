<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        // For now, just show product id
        return "Product details for product ID: " . $id;
    }
}
