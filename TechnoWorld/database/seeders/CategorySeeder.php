<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Smartphones', 'icon' => 'bi-phone'],
            ['name' => 'Laptops', 'icon' => 'bi-laptop'],
            ['name' => 'Tablets', 'icon' => 'bi-tablet'],
            ['name' => 'Headphones', 'icon' => 'bi-headphones'],
            ['name' => 'Cameras', 'icon' => 'bi-camera'],
            ['name' => 'Gaming', 'icon' => 'bi-controller'],
            ['name' => 'Smart Watches', 'icon' => 'bi-watch'],
            ['name' => 'TVs', 'icon' => 'bi-tv'],
            ['name' => 'Speakers', 'icon' => 'bi-speaker'],
            ['name' => 'Printers', 'icon' => 'bi-printer'],
            ['name' => 'Networking', 'icon' => 'bi-wifi'],
            ['name' => 'Accessories', 'icon' => 'bi-bag'],
            ['name' => 'PC Components', 'icon' => 'bi-cpu'],
            ['name' => 'Power & Batteries', 'icon' => 'bi-battery-charging'],
            ['name' => 'Smart Home', 'icon' => 'bi-house'],
            ['name' => 'Home Appliances', 'icon' => 'bi-house-gear'],
            ['name' => 'VR & AR', 'icon' => 'bi-vr'],
            ['name' => 'Drones', 'icon' => 'bi-drone'],
        ];

        foreach ($categories as $data) {
            Category::firstOrCreate(['name' => $data['name']], ['icon' => $data['icon']]);
        }
    }
}
