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
            'Panasonic', 'Philips', 'Nespresso', 'Bosch',
            'DeLonghi', 'Canon', 'Insta360', 'Osaka', 'JLab',
            'Tronsmart', 'Cooler Master', 'Raidmax', 'Wacom', 'Indesit',
            'Zanussi', 'Deye', 'Molicel', 'Langzeit', 'La Marzocco',
            'Profi Cook', 'ASUS', 'General Mobile', 'Rowenta', 'Garmin', 'Electrolux',
        ];

        foreach ($brands as $name) {
            Brand::query()->firstOrCreate(['name' => $name]);
        }
    }
}
