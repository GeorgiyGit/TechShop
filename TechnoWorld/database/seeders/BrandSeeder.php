<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Apple', 'Samsung', 'Google', 'Motorola', 'Xiaomi',
            'Lenovo', 'Microsoft', 'Sony', 'LG', 'HP',
            'Panasonic', 'Philips', 'Dyson', 'Nespresso', 'Bosch',
            'DeLonghi',
        ];

        foreach ($brands as $name) {
            Brand::query()->firstOrCreate(['name' => $name]);
        }
    }
}
