<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
})->middleware(['auth'])->name('admin.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard'); // resources/views/dashboard.blade.php
})->middleware(['auth'])->name('dashboard');

Route::get('/admin', function () {
    return 'Welcome, Admin!';
})->middleware(['auth','admin']);

Route::get('/', function () {
    return view('home');
});

// Profile routes
Route::get('/profile/edit', function () {
    return view('profile.edit');
})->middleware('auth')->name('profile.edit');

Route::put('/profile/update', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

// Password routes
Route::get('/password/change', [PasswordController::class, 'edit'])
    ->middleware('auth')
    ->name('password.change');

Route::post('/password/change', [PasswordController::class, 'update'])
    ->middleware('auth')
    ->name('password.update');

//dashboard sidebar
Route::get('/order',[OrderController::class,'index'])->name('order.index');

Route::get('/shop', function () {
    $products = collect([
        (object)[ 'id'=>1, 'name'=>'Sample Dress', 'price'=>1299.00, 'image_url'=>asset('images/sample1.jpg') ],
        (object)[ 'id'=>2, 'name'=>'Summer Top',  'price'=>599.00,  'image_url'=>asset('images/sample2.jpg') ],
        (object)[ 'id'=>3, 'name'=>'Casual Pants', 'price'=>899.00,  'image_url'=>asset('images/sample3.jpg') ],
    ]);

    return view('shop.index', compact('products'));
})->name('shop.index');

Route::get('/product{id}',[OrderController::class,'show'])->name('product.show');

require __DIR__.'/auth.php';
