<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
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

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Invalid email or password']);
        }

        $request->session()->regenerate();

        return redirect()->to($this->resolveReturnTo($request, $request->input('return_to')));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function resolveReturnTo(Request $request, ?string $candidate = null): string
    {
        $value = trim((string) ($candidate ?: $request->query('return_to') ?: $request->headers->get('referer') ?: route('home')));

        if ($value === '') {
            return route('home');
        }

        $parts = parse_url($value);

        if ($parts === false) {
            return route('home');
        }

        if (isset($parts['host']) && $parts['host'] !== $request->getHost()) {
            return route('home');
        }

        $path = $parts['path'] ?? '/';
        $query = isset($parts['query']) ? '?' . $parts['query'] : '';
        $fragment = isset($parts['fragment']) ? '#' . $parts['fragment'] : '';

        return url($path . $query . $fragment);
    }
}
