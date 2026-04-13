<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
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

        $selectedCategoryIds = collect($request->input('categories', []))
            ->filter()
            ->map(fn ($categoryId) => (int) $categoryId)
            ->filter()
            ->values()
            ->all();

        $selectedBrands = collect($request->input('brands', []))
            ->filter()
            ->values()
            ->all();

        $selectedStatuses = collect($request->input('statuses', []))
            ->filter()
            ->values()
            ->all();

        $minPrice = $request->filled('min_price') ? (float) $request->input('min_price') : null;
        $maxPrice = $request->filled('max_price') ? (float) $request->input('max_price') : null;
        $openCategoryFilter = $selectedCategoryIds !== [];
        $openBrandFilter = $selectedBrands !== [];
        $openStatusFilter = $selectedStatuses !== [];
        $openPriceFilter = $minPrice !== null || $maxPrice !== null;

        $featuredBanners = Banner::query()
            ->where('carousel', 'featured')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $brands = Product::query()
            ->where('is_active', true)
            ->select('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');

        $statusOptions = [
            'in_stock' => 'In Stock',
            'limited_stock' => 'Limited Stock',
            'out_of_stock' => 'Out of Stock',
        ];

        $productsQuery = Product::query()
            ->where('is_active', true);

        if ($selectedCategoryIds !== []) {
            $productsQuery->whereIn('category_id', $selectedCategoryIds);
        }

        if ($selectedBrands !== []) {
            $productsQuery->whereIn('brand', $selectedBrands);
        }

        if ($selectedStatuses !== []) {
            $productsQuery->where(function ($query) use ($selectedStatuses) {
                if (in_array('in_stock', $selectedStatuses, true)) {
                    $query->orWhere('stock_left', '>', 5);
                }

                if (in_array('limited_stock', $selectedStatuses, true)) {
                    $query->orWhereBetween('stock_left', [1, 5]);
                }

                if (in_array('out_of_stock', $selectedStatuses, true)) {
                    $query->orWhere('stock_left', '<=', 0);
                }
            });
        }

        if ($minPrice !== null) {
            $productsQuery->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $productsQuery->where('price', '<=', $maxPrice);
        }

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

        $products = $productsQuery
            ->paginate(12)
            ->appends($request->except(['page', 'partial']));

        if ($request->boolean('partial')) {
            return view('partials.products-grid', compact('products'));
        }

        return view('products', compact(
            'featuredBanners',
            'products',
            'orderBy',
            'categories',
            'brands',
            'statusOptions',
            'selectedCategoryIds',
            'selectedBrands',
            'selectedStatuses',
            'minPrice',
            'maxPrice',
            'openCategoryFilter',
            'openBrandFilter',
            'openStatusFilter',
            'openPriceFilter'
        ));
    }
}
