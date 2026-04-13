<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Smartphones', 'slug' => 'smartphones', 'icon' => 'bi-phone', 'sort_order' => 10],
            ['name' => 'Laptops', 'slug' => 'laptops', 'icon' => 'bi-laptop', 'sort_order' => 20],
            ['name' => 'Tablets', 'slug' => 'tablets', 'icon' => 'bi-tablet', 'sort_order' => 30],
            ['name' => 'Headphones & Audio', 'slug' => 'headphones-audio', 'icon' => 'bi-headphones', 'sort_order' => 40],
            ['name' => 'Cameras', 'slug' => 'cameras', 'icon' => 'bi-camera', 'sort_order' => 50],
            ['name' => 'Gaming', 'slug' => 'gaming', 'icon' => 'bi-controller', 'sort_order' => 60],
            ['name' => 'Smart Watches', 'slug' => 'smart-watches', 'icon' => 'bi-smartwatch', 'sort_order' => 70],
            ['name' => 'TVs & Displays', 'slug' => 'tvs-displays', 'icon' => 'bi-tv', 'sort_order' => 80],
            ['name' => 'Speakers', 'slug' => 'speakers', 'icon' => 'bi-speaker', 'sort_order' => 90],
            ['name' => 'Printers & Scanners', 'slug' => 'printers-scanners', 'icon' => 'bi-printer', 'sort_order' => 100],
            ['name' => 'Networking', 'slug' => 'networking', 'icon' => 'bi-router', 'sort_order' => 110],
            ['name' => 'Accessories', 'slug' => 'accessories', 'icon' => 'bi-bag', 'sort_order' => 120],
            ['name' => 'PC Components', 'slug' => 'pc-components', 'icon' => 'bi-cpu', 'sort_order' => 130],
            ['name' => 'Power & Batteries', 'slug' => 'power-batteries', 'icon' => 'bi-battery-charging', 'sort_order' => 140],
            ['name' => 'Smart Home', 'slug' => 'smart-home', 'icon' => 'bi-lightbulb', 'sort_order' => 150],
            ['name' => 'Home Appliances', 'slug' => 'home-appliances', 'icon' => 'bi-tools', 'sort_order' => 160],
            ['name' => 'VR & AR', 'slug' => 'vr-ar', 'icon' => 'bi-badge-vr', 'sort_order' => 170],
            ['name' => 'Drones', 'slug' => 'drones', 'icon' => 'bi-airplane', 'sort_order' => 180],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}