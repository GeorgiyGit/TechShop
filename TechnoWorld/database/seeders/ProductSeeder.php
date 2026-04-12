<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['slug' => 'saeco-royal-professional', 'brand' => 'Saeco', 'name' => 'Royal Professional Coffee Maker', 'description' => 'Automatic espresso machine with built-in grinder and milk frother.', 'price' => 899.99, 'image_path' => 'coffee-maker/saeco-royal-professional/image.png', 'sort_order' => 10],
            ['slug' => 'microsoft-surface-go-3', 'brand' => 'Microsoft', 'name' => 'Surface Go 3', 'description' => '10.5-inch touchscreen laptop with a lightweight body for studies and work.', 'price' => 629.99, 'image_path' => 'laptop/microsoft-surface-go-3/image.png', 'sort_order' => 20],
            ['slug' => 'panasonic-microwave-oven', 'brand' => 'Panasonic', 'name' => 'Microwave Oven', 'description' => '25L microwave with inverter heating and fast defrost modes.', 'price' => 219.99, 'image_path' => 'microwave-oven/panasonic/image.png', 'sort_order' => 30],
            ['slug' => 'logitech-m510', 'brand' => 'Logitech', 'name' => 'Wireless Mouse M510', 'description' => 'Ergonomic wireless mouse with long battery life and precise tracking.', 'price' => 34.99, 'image_path' => 'mouse/logitech-wireless-mouse-m510-black/image.png', 'sort_order' => 40],
            ['slug' => 'iphone-11', 'brand' => 'Apple', 'name' => 'iPhone 11', 'description' => 'Trusted smartphone with a dual camera system and smooth performance.', 'price' => 479.99, 'image_path' => 'phone/iphone-11/image.png', 'sort_order' => 50],
            ['slug' => 'motorola-razr-50-ultra', 'brand' => 'Motorola', 'name' => 'Razr 50 Ultra', 'description' => 'Premium foldable smartphone with flagship camera features.', 'price' => 999.99, 'image_path' => 'phone/motorola-razr-50-ultra/image.png', 'sort_order' => 60],
            ['slug' => 'motorola-g86', 'brand' => 'Motorola', 'name' => 'Moto G86', 'description' => 'Balanced everyday smartphone with strong battery life.', 'price' => 289.99, 'image_path' => 'phone/motorola-g86/image.png', 'sort_order' => 70],
            ['slug' => 'motorola-razr-50', 'brand' => 'Motorola', 'name' => 'Razr 50', 'description' => 'Foldable phone design focused on style and portability.', 'price' => 799.99, 'image_path' => 'phone/motorola-razr-50-ultra/image.png', 'sort_order' => 80],
            ['slug' => 'power-bank-20000', 'brand' => 'Baseus', 'name' => 'Power Bank 20000 mAh', 'description' => 'High-capacity power bank with fast charging support.', 'price' => 49.99, 'image_path' => 'power-bank/20000-mah/image.png', 'sort_order' => 90],
            ['slug' => 'snaige-refrigerator', 'brand' => 'Snaige', 'name' => 'Refrigerator', 'description' => 'Energy-efficient refrigerator with modern internal layout.', 'price' => 549.99, 'image_path' => 'refrigerator/snaige/image.png', 'sort_order' => 100],
            ['slug' => 'miele-c3', 'brand' => 'Miele', 'name' => 'Complete C3 Vacuum', 'description' => 'High suction canister vacuum cleaner for deep home cleaning.', 'price' => 399.99, 'image_path' => 'vacuum-cleaner/miele-c3/image.png', 'sort_order' => 110],
            ['slug' => 'apple-watch-6', 'brand' => 'Apple', 'name' => 'Watch Series 6', 'description' => 'Smartwatch with health sensors and a bright always-on display.', 'price' => 299.99, 'image_path' => 'watch/apple-watch-6/image.png', 'sort_order' => 120],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                array_merge($product, ['is_active' => true])
            );
        }
    }
}
