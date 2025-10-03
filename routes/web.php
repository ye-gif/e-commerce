<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // create resources/views/admin/dashboard.blade.php
})->middleware(['auth'])->name('admin.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard'); // create resources/views/dashboard.blade.php
})->middleware(['auth'])->name('dashboard');

Route::get('/admin',function(){
    return 'Welcome, Admin!';
})->middleware(['auth','admin']);

Route::get('/', function () {
    return view('home');
});

Route::get('/profile/edit', function () {
    return view('profile.edit');
})->middleware('auth')->name('profile.edit');

Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

require __DIR__.'/auth.php';
?>