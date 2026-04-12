<?php

use App\Models\Category;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();

    return view('home', compact('categories'));
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/signup', [SignupController::class, 'create'])->name('signup.create');
    Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
