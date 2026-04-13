<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = Category::query()->pluck('id', 'slug');

        $products = [
            ['slug' => 'saeco-royal-professional', 'category_slug' => 'home-appliances', 'brand' => 'Saeco', 'name' => 'Royal Professional Coffee Maker', 'description' => 'Automatic espresso machine with built-in grinder and milk frother.', 'price' => 899.99, 'image_path' => 'coffee-maker/saeco-royal-professional/image.png', 'sort_order' => 10, 'popularity_score' => 55, 'stock_left' => 9],
            ['slug' => 'microsoft-surface-go-3', 'category_slug' => 'laptops', 'brand' => 'Microsoft', 'name' => 'Surface Go 3', 'description' => '10.5-inch touchscreen laptop with a lightweight body for studies and work.', 'price' => 629.99, 'image_path' => 'laptop/microsoft-surface-go-3/image.png', 'sort_order' => 20, 'popularity_score' => 72, 'stock_left' => 12],
            ['slug' => 'panasonic-microwave-oven', 'category_slug' => 'home-appliances', 'brand' => 'Panasonic', 'name' => 'Microwave Oven', 'description' => '25L microwave with inverter heating and fast defrost modes.', 'price' => 219.99, 'image_path' => 'microwave-oven/panasonic/image.png', 'sort_order' => 30, 'popularity_score' => 43, 'stock_left' => 4],
            ['slug' => 'logitech-m510', 'category_slug' => 'accessories', 'brand' => 'Logitech', 'name' => 'Wireless Mouse M510', 'description' => 'Ergonomic wireless mouse with long battery life and precise tracking.', 'price' => 34.99, 'image_path' => 'mouse/logitech-wireless-mouse-m510-black/image.png', 'sort_order' => 40, 'popularity_score' => 86, 'stock_left' => 17],
            ['slug' => 'iphone-11', 'category_slug' => 'smartphones', 'brand' => 'Apple', 'name' => 'iPhone 11', 'description' => 'Trusted smartphone with a dual camera system and smooth performance.', 'price' => 479.99, 'image_path' => 'phone/iphone-11/image.png', 'sort_order' => 50, 'popularity_score' => 95, 'stock_left' => 0],
            ['slug' => 'motorola-razr-50-ultra', 'category_slug' => 'smartphones', 'brand' => 'Motorola', 'name' => 'Razr 50 Ultra', 'description' => 'Premium foldable smartphone with flagship camera features.', 'price' => 999.99, 'image_path' => 'phone/motorola-razr-50-ultra/image.png', 'sort_order' => 60, 'popularity_score' => 67, 'stock_left' => 3],
            ['slug' => 'motorola-g86', 'category_slug' => 'smartphones', 'brand' => 'Motorola', 'name' => 'Moto G86', 'description' => 'Balanced everyday smartphone with strong battery life.', 'price' => 289.99, 'image_path' => 'phone/motorola-g86/image.png', 'sort_order' => 70, 'popularity_score' => 58, 'stock_left' => 8],
            ['slug' => 'motorola-razr-50', 'category_slug' => 'smartphones', 'brand' => 'Motorola', 'name' => 'Razr 50', 'description' => 'Foldable phone design focused on style and portability.', 'price' => 799.99, 'image_path' => 'phone/motorola-razr-50-ultra/image.png', 'sort_order' => 80, 'popularity_score' => 61, 'stock_left' => 0],
            ['slug' => 'power-bank-20000', 'category_slug' => 'power-batteries', 'brand' => 'Baseus', 'name' => 'Power Bank 20000 mAh', 'description' => 'High-capacity power bank with fast charging support.', 'price' => 49.99, 'image_path' => 'power-bank/20000-mah/image.png', 'sort_order' => 90, 'popularity_score' => 48, 'stock_left' => 5],
            ['slug' => 'snaige-refrigerator', 'category_slug' => 'home-appliances', 'brand' => 'Snaige', 'name' => 'Refrigerator', 'description' => 'Energy-efficient refrigerator with modern internal layout.', 'price' => 549.99, 'image_path' => 'refrigerator/snaige/image.png', 'sort_order' => 100, 'popularity_score' => 39, 'stock_left' => 2],
            ['slug' => 'miele-c3', 'category_slug' => 'home-appliances', 'brand' => 'Miele', 'name' => 'Complete C3 Vacuum', 'description' => 'High suction canister vacuum cleaner for deep home cleaning.', 'price' => 399.99, 'image_path' => 'vacuum-cleaner/miele-c3/image.png', 'sort_order' => 110, 'popularity_score' => 64, 'stock_left' => 7],
            ['slug' => 'apple-watch-6', 'category_slug' => 'smart-watches', 'brand' => 'Apple', 'name' => 'Watch Series 6', 'description' => 'Smartwatch with health sensors and a bright always-on display.', 'price' => 299.99, 'image_path' => 'watch/apple-watch-6/image.png', 'sort_order' => 120, 'popularity_score' => 98, 'stock_left' => 6],
        ];

        foreach ($products as $product) {
            $product['category_id'] = $categoryIds[$product['category_slug']] ?? null;
            unset($product['category_slug']);

            Product::updateOrCreate(
                ['slug' => $product['slug']],
                array_merge($product, ['is_active' => true])
            );
        }
    }
}
