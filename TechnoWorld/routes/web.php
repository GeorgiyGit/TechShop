<?php

use App\Models\Category;
use App\Models\Banner;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

Route::get('/', function () {
    $heroBanners = Banner::query()
        ->where('carousel', 'hero')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    $featuredBanners = Banner::query()
        ->where('carousel', 'featured')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    $categories = Category::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();

    return view('home', compact('categories', 'heroBanners', 'featuredBanners'));
})->name('home');

Route::view('/privacy-policy', 'privacy-policy')->name('privacy-policy');

Route::get('/images/products/{path}', function (string $path): BinaryFileResponse {
    $basePath = realpath(resource_path('images/products'));
    $requestedPath = realpath(resource_path('images/products/' . $path));

    if (
        $basePath === false
        || $requestedPath === false
        || ! str_starts_with($requestedPath, $basePath . DIRECTORY_SEPARATOR)
        || ! is_file($requestedPath)
    ) {
        abort(404);
    }

    return response()->file($requestedPath);
})->where('path', '.*')->name('images.products');

Route::middleware('guest')->group(function () {
    Route::get('/signup', [SignupController::class, 'create'])->name('signup.create');
    Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/account', function () {
        return view('dashboard');
    })->name('account');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
