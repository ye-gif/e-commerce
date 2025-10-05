<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

// Register
Route::get('/register', [RegisteredUserController::class, 'create'])
            ->middleware('guest')
            ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware('guest');

// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->middleware('guest')
            ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
            ->middleware('guest');

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->middleware('auth')
            ->name('logout');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->name('password.update');

?>