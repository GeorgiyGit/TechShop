<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/images/products/{path}', [AssetController::class, 'productImage'])
    ->where('path', '.*')
    ->name('images.products');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');

Route::prefix('create-order')->name('order.create.')->group(function () {
    Route::get('/', [OrderController::class, 'items'])->name('items');
    Route::get('/delivery', [OrderController::class, 'delivery'])->name('delivery');
    Route::post('/delivery', [OrderController::class, 'storeDelivery'])->name('delivery.store');
    Route::get('/payment', [OrderController::class, 'payment'])->name('payment');
    Route::post('/payment', [OrderController::class, 'store'])->name('store');
});

Route::get('/order-success/{order?}', [OrderController::class, 'success'])->name('order.success');

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

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('brands', AdminBrandController::class);
    Route::resource('products', AdminProductController::class);
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('product-images/{image}', [AdminProductController::class, 'destroyImage'])->name('product-images.destroy');
});
