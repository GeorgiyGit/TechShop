<?php

use App\Http\Controllers\Auth\SignupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('signup.create');
})->name('home');

Route::get('/signup', [SignupController::class, 'create'])->name('signup.create');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

Route::get('/login', function () {
    return redirect()->route('signup.create');
})->name('login');
