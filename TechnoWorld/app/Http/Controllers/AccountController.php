<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AccountController extends Controller
{
    public function account(): View
    {
        return view('dashboard');
    }

    public function dashboard(): View
    {
        return view('dashboard');
    }
}
