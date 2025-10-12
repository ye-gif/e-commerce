<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //  you can fetch featured products here
        $products = collect([]);

        return view('dashboard', compact('products'));
    }
}
