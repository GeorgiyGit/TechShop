<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AccountController extends Controller
{
    public function account(): View
    {
        $orders = auth()->user()
            ->orders()
            ->orderByDesc('placed_at')
            ->get();

        return view('dashboard', compact('orders'));
    }

    public function dashboard(): View
    {
        return $this->account();
    }
}
