<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('home');
});

// Admin Routes
Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
// Admin Product Management Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Show all products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // Show create form
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

    // Store new product
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // Show specific product
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

    // Edit product
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

    // Update product
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

    // Delete product
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
})->name('admin.dashboard');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard (Customer)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Shop
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Product
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Password
    Route::get('/password/change', [PasswordController::class, 'edit'])->name('password.change');
    Route::post('/password/change', [PasswordController::class, 'update'])->name('password.update');
});

require __DIR__ . '/auth.php';
