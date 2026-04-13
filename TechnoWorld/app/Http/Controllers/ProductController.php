<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $orderBy = $request->query('orderBy', 'relevance');

        if (! in_array($orderBy, ['relevance', 'price-asc', 'price-desc', 'newest', 'popular'], true)) {
            $orderBy = 'relevance';
        }

        $featuredBanners = Banner::query()
            ->where('carousel', 'featured')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $productsQuery = Product::query()
            ->where('is_active', true);

        switch ($orderBy) {
            case 'price-asc':
                $productsQuery->orderBy('price')->orderBy('sort_order')->orderBy('id');
                break;
            case 'price-desc':
                $productsQuery->orderByDesc('price')->orderBy('sort_order')->orderBy('id');
                break;
            case 'newest':
                $productsQuery->orderByDesc('created_at')->orderByDesc('id');
                break;
            case 'popular':
                $productsQuery->orderByDesc('popularity_score')->orderBy('sort_order')->orderBy('id');
                break;
            case 'relevance':
            default:
                $productsQuery->orderBy('sort_order')->orderBy('id');
                break;
        }

        $products = $productsQuery->get();

        if ($request->boolean('partial')) {
            return view('partials.products-grid', compact('products'));
        }

        return view('products', compact('featuredBanners', 'products', 'orderBy'));
    }
}
