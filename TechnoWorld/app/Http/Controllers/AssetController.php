<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AssetController extends Controller
{
    public function productImage(string $path): BinaryFileResponse
    {
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
    }
}
