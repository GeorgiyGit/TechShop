<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/images/products/{path}', [AssetController::class, 'productImage'])
    ->where('path', '.*')
    ->name('images.products');

Route::middleware('guest')->group(function () {
    Route::get('/signup', [SignupController::class, 'create'])->name('signup.create');
    Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'account'])->name('account');
    Route::get('/dashboard', [AccountController::class, 'dashboard'])->name('dashboard');

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
