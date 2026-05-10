<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SignupController extends Controller
{
    use ResolvesReturnTo;

    public function create(Request $request): View
    {
        return view('auth.signup', [
            'returnTo' => $this->resolveReturnTo($request),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'user',
        ]);

        $guestSessionId = $request->session()->getId();
        Auth::login($user);
        $request->session()->regenerate();
        Cart::mergeGuestCart($guestSessionId, $user->id);

        $returnTo = $request->input('return_to') ?: route('home');
        return redirect()->to($returnTo);
    }
}
