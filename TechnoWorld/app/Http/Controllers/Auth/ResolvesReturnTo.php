<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

trait ResolvesReturnTo
{
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
