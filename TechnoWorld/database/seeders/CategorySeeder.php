<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Phones', 'icon' => 'bi-phone'],
            ['name' => 'Laptops', 'icon' => 'bi-laptop'],
            ['name' => 'Tablets', 'icon' => 'bi-tablet'],
            ['name' => 'Headphones', 'icon' => 'bi-headphones'],
            ['name' => 'Speakers', 'icon' => 'bi-speaker'],
            ['name' => 'Cameras', 'icon' => 'bi-camera'],
            ['name' => 'Gaming', 'icon' => 'bi-controller'],
            ['name' => 'Wearables', 'icon' => 'bi-smartwatch'],
            ['name' => 'TV & Displays', 'icon' => 'bi-display'],
            ['name' => 'PC Components', 'icon' => 'bi-cpu'],
            ['name' => 'Peripherals', 'icon' => 'bi-mouse'],
            ['name' => 'Power', 'icon' => 'bi-battery-charging'],
            ['name' => 'Refrigerators', 'icon' => 'bi-snow'],
            ['name' => 'Washing Machines', 'icon' => 'bi-droplet'],
            ['name' => 'Vacuum Cleaners', 'icon' => 'bi-wind'],
            ['name' => 'Air Conditioners', 'icon' => 'bi-thermometer'],
            ['name' => 'Kitchen Appliances', 'icon' => 'bi-cup-straw'],
            ['name' => 'Coffee Machines', 'icon' => 'bi-cup-hot'],
        ];

        foreach ($categories as $data) {
            Category::firstOrCreate(['name' => $data['name']], ['icon' => $data['icon']]);
        }
    }
}
