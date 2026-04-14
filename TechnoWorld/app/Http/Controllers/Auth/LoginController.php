<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    use ResolvesReturnTo;
    public function create(Request $request): View
    {
        return view('auth.login', [
            'returnTo' => $this->resolveReturnTo($request),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $guestSessionId = $request->session()->getId();
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Invalid email or password']);
        }

        $request->session()->regenerate();
        Cart::mergeGuestCart($guestSessionId, Auth::id());

        return redirect()->to($this->resolveReturnTo($request, $request->input('return_to')));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $redirectTo = $this->resolveReturnTo($request, $request->input('return_to'));

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to($redirectTo);
    }

}
