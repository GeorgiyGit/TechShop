<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $name = trim((string) ($validated['name'] ?? ''));

        if ($name === '') {
            $name = Str::headline(Str::before($validated['email'], '@'));
        }
        if ($name === '') {
            $name = $validated['email'];
        }

        $user = User::create([
            'name' => $name,
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        event(new Registered($user));

        $guestSessionId = $request->session()->getId();
        Auth::login($user);
        $request->session()->regenerate();
        Cart::mergeGuestCart($guestSessionId, $user->id);

        return redirect()->to($this->resolveReturnTo($request, $request->input('return_to')));
    }

}