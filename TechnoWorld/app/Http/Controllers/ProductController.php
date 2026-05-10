<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $sort = $request->query('sort', 'newest');
        if (!in_array($sort, ['price_asc', 'price_desc', 'newest', 'popular'], true)) {
            $sort = 'newest';
        }

        $selectedCategories = collect($request->input('categories', []))
            ->filter()
            ->map(fn($id) => (int) $id)
            ->values()
            ->all();

        $selectedBrands = collect($request->input('brands', []))
            ->filter()
            ->values()
            ->all();

        $priceChanged = $request->boolean('price_changed');
        $minPrice = ($priceChanged && $request->filled('min_price')) ? (float) $request->input('min_price') : null;
        $maxPrice = ($priceChanged && $request->filled('max_price')) ? (float) $request->input('max_price') : null;

        $stockStatus = $request->input('stock_status');
        if (!in_array($stockStatus, ['in_stock', 'low_stock', 'unavailable'], true)) {
            $stockStatus = null;
        }

        $search = $request->filled('search') ? trim($request->input('search')) : null;

        $openCategoryFilter = $selectedCategories !== [];
        $openBrandFilter = $selectedBrands !== [];
        $openPriceFilter = $priceChanged;
        $openStockFilter = $stockStatus !== null;

        $categories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->orderBy('name')
            ->get();

        $brands = Brand::whereHas('products', function ($q) use ($selectedCategories) {
            if ($selectedCategories) {
                $q->whereIn('category_id', $selectedCategories);
            }
        })->orderBy('name')->get();

        $baseQuery = Product::query();

        if ($selectedCategories) {
            $baseQuery->whereIn('category_id', $selectedCategories);
        }
        if ($selectedBrands !== []) {
            $baseQuery->whereHas('brand', fn($q) => $q->whereIn('name', $selectedBrands));
        }
        match ($stockStatus) {
            'in_stock'    => $baseQuery->where('stock_quantity', '>', 5),
            'low_stock'   => $baseQuery->whereBetween('stock_quantity', [1, 5]),
            'unavailable' => $baseQuery->where('stock_quantity', 0),
            default       => null,
        };
        if ($search !== null) {
            $baseQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $contextMinPrice = (float) ((clone $baseQuery)->min('price') ?? 0);
        $contextMaxPrice = (float) ((clone $baseQuery)->max('price') ?? 0);

        $productsQuery = clone $baseQuery;

        if ($minPrice !== null) {
            $productsQuery->where('price', '>=', $minPrice);
        }
        if ($maxPrice !== null) {
            $productsQuery->where('price', '<=', $maxPrice);
        }

        switch ($sort) {
            case 'price_asc':  $productsQuery->orderBy('price'); break;
            case 'price_desc': $productsQuery->orderByDesc('price'); break;
            case 'popular':    $productsQuery->orderByDesc('stock_quantity'); break;
            default:           $productsQuery->orderByDesc('created_at'); break;
        }

        $products = $productsQuery
            ->with(['brand', 'firstImage'])
            ->paginate(12)
            ->withQueryString();

        $filters = [
            'categories'    => $selectedCategories,
            'brands'        => $selectedBrands,
            'min_price'     => $minPrice,
            'max_price'     => $maxPrice,
            'price_changed' => $priceChanged,
            'stock_status'  => $stockStatus,
            'search'        => $search,
            'sort'          => $sort,
        ];

        return view('products', compact(
            'products',
            'categories',
            'brands',
            'filters',
            'contextMinPrice',
            'contextMaxPrice',
            'openCategoryFilter',
            'openBrandFilter',
            'openPriceFilter',
            'openStockFilter'
        ));
    }

    public function show(Product $product): View
    {
        $product->load(['brand', 'category', 'characteristics', 'images', 'firstImage']);

        $similarProducts = Product::query()
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->limit(4)
            ->with('firstImage')
            ->get();

        return view('product', compact('product', 'similarProducts'));
    }
}
