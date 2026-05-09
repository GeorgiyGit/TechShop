<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AccountController extends Controller
{
    public function account(): View
    {
        return $this->dashboard();
    }

    public function dashboard(): View
    {
        $orders = auth()->user()
            ->orders()
            ->with(['payment', 'address', 'items'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('dashboard', compact('orders'));
    }
}
