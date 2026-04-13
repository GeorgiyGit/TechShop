<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (! Schema::hasTable('products')) {
            View::share('searchCatalog', [
                'products' => [],
                'brands' => [],
            ]);

            return;
        }

        View::share('searchCatalog', [
            'products' => Product::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(['name', 'brand', 'slug'])
                ->map(fn ($product) => [
                    'type' => 'product',
                    'label' => $product->name,
                    'meta' => $product->brand,
                    'href' => url('/products/' . $product->slug),
                ])
                ->values()
                ->all(),
            'brands' => Product::query()
                ->where('is_active', true)
                ->select('brand')
                ->distinct()
                ->orderBy('brand')
                ->pluck('brand')
                ->map(fn ($brand) => [
                    'type' => 'brand',
                    'label' => $brand,
                    'meta' => 'Brand',
                    'href' => url('/products?brands%5B0%5D=' . rawurlencode($brand)),
                ])
                ->values()
                ->all(),
        ]);
    }
}
