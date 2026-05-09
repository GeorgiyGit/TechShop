<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $heroBanners = Banner::query()
            ->where('carousel', 'hero')
            ->orderBy('id')
            ->get();

        $featuredBanners = Banner::query()
            ->where('carousel', 'featured')
            ->orderBy('id')
            ->get();

        $categories = Category::query()
            ->withCount('products')
            ->orderByDesc('products_count')
            ->orderBy('name')
            ->get();

        return view('home', compact('categories', 'heroBanners', 'featuredBanners'));
    }
}
