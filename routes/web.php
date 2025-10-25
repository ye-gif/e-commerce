<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Seller\OrdersController;
use App\Http\Controllers\Seller\ProductsController;
use App\Http\Controllers\Seller\CategoryController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('home');
});

Route::prefix('seller')->name('seller.')->group(function () {

    // Seller Dashboard
    Route::get('/seller/dashboard', [App\Http\Controllers\Seller\DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('seller.dashboard');

    Route::resource('orders', App\Http\Controllers\Seller\OrdersController::class);
    Route::resource('products', App\Http\Controllers\Seller\ProductsController::class);
    Route::resource('categories', App\Http\Controllers\Seller\CategoryController::class);

    //profile
    Route::get('/profile', [SellerController::class, 'profile'])->name('seller.profile');

    
    // Product Management (Manual Routes)
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');           // Show all products
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');  // Show create form
    Route::post('/products', [ProductsController::class, 'store'])->name('products.store');          // Store new product
    Route::get('/products/{id}', [ProductsController::class, 'show'])->name('products.show');        // Show specific product
    Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');   // Edit product
    Route::put('/products/{id}', [ProductsController::class, 'update'])->name('products.update');    // Update product
    Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy'); // Delete product
    return redirect()->route('seller.products.index')->with('success', 'Product created successfully.');    


    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    // Order Management
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrdersController::class, 'show'])->name('orders.show');

    // Update order status
    Route::put('/orders/{order}/update-status', [OrdersController::class, 'updateStatus'])
        ->name('orders.updateStatus'); 


});


Route::get('/seller/dashboard', function () {
    return view('seller.dashboard'); // resources/views/seller/dashboard.blade.php
})->name('seller.dashboard');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard (Customer)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Shop
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

    // Orders
    Route::prefix('customer')->group(function () {
    Route::get('/orders', [CustomerOrdersController::class, 'index'])->name('customer.orders.index');
    });
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/customer/orders/data', [OrderController::class, 'ordersData'])
    ->name('customer.orders.data');
    Route::patch('/orders/{order}/cancel', [App\Http\Controllers\OrderController::class, 'cancel'])->name('orders.cancel');


    

    // Product
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    //Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    //checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::match(['get', 'post'], '/checkout/complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    Route::get('/about', function () {
        return view('about');
    })->name('about');




    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Password
    Route::get('/password/change', [PasswordController::class, 'edit'])->name('password.change');
    Route::post('/password/change', [PasswordController::class, 'update'])->name('password.update');
});

require __DIR__ . '/auth.php';
