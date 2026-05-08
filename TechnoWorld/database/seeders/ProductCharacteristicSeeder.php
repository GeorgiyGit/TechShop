<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCharacteristic;
use Illuminate\Database\Seeder;

class ProductCharacteristicSeeder extends Seeder
{
    public function run(): void
    {
        $characteristics = [
            'saeco-royal-professional' => [
                ['name' => 'Type', 'value' => 'Automatic Espresso Machine'],
                ['name' => 'Capacity', 'value' => '2.5 L'],
                ['name' => 'Pressure', 'value' => '15 bar'],
                ['name' => 'Grinder', 'value' => 'Built-in ceramic'],
                ['name' => 'Power', 'value' => '1400 W'],
            ],
            'microsoft-surface-go-3' => [
                ['name' => 'Display', 'value' => '10.5" PixelSense (1920x1280)'],
                ['name' => 'Processor', 'value' => 'Intel Pentium Gold 6500Y'],
                ['name' => 'RAM', 'value' => '4 GB'],
                ['name' => 'Storage', 'value' => '64 GB eMMC'],
                ['name' => 'OS', 'value' => 'Windows 11 Home S'],
                ['name' => 'Weight', 'value' => '544 g'],
            ],
            'panasonic-microwave-oven' => [
                ['name' => 'Capacity', 'value' => '25 L'],
                ['name' => 'Power', 'value' => '900 W'],
                ['name' => 'Technology', 'value' => 'Inverter'],
                ['name' => 'Turntable Diameter', 'value' => '34 cm'],
                ['name' => 'Color', 'value' => 'Black'],
            ],
            'logitech-m510' => [
                ['name' => 'Connection', 'value' => 'Wireless (USB receiver)'],
                ['name' => 'Sensor', 'value' => 'Laser'],
                ['name' => 'DPI', 'value' => '1000'],
                ['name' => 'Battery Life', 'value' => '24 months'],
                ['name' => 'Buttons', 'value' => '7'],
            ],
            'iphone-11' => [
                ['name' => 'Display', 'value' => '6.1" Liquid Retina HD'],
                ['name' => 'Processor', 'value' => 'A13 Bionic'],
                ['name' => 'Camera', 'value' => 'Dual 12 MP (Wide + Ultra Wide)'],
                ['name' => 'Storage', 'value' => '64 GB'],
                ['name' => 'Battery', 'value' => '3110 mAh'],
                ['name' => 'Water Resistance', 'value' => 'IP68'],
            ],
            'motorola-razr-50-ultra' => [
                ['name' => 'Display', 'value' => '6.9" pOLED 165Hz'],
                ['name' => 'External Display', 'value' => '4" pOLED'],
                ['name' => 'Processor', 'value' => 'Snapdragon 8s Gen 3'],
                ['name' => 'RAM', 'value' => '12 GB'],
                ['name' => 'Storage', 'value' => '512 GB'],
                ['name' => 'Camera', 'value' => '50 MP + 50 MP'],
            ],
            'motorola-g86' => [
                ['name' => 'Display', 'value' => '6.67" pOLED 120Hz'],
                ['name' => 'Processor', 'value' => 'Snapdragon 2+ Gen 1'],
                ['name' => 'RAM', 'value' => '8 GB'],
                ['name' => 'Storage', 'value' => '256 GB'],
                ['name' => 'Battery', 'value' => '5000 mAh'],
                ['name' => 'Camera', 'value' => '50 MP OIS'],
            ],
            'electrolux-zb-2951' => [
                ['name' => 'Type', 'value' => '2-in-1 Cordless Stick & Handheld'],
                ['name' => 'Power', 'value' => '18 V'],
                ['name' => 'Runtime', 'value' => 'Up to 30 min'],
                ['name' => 'Dustbin Capacity', 'value' => '0.4 L'],
                ['name' => 'Weight', 'value' => '1.4 kg'],
                ['name' => 'Filter', 'value' => 'Washable'],
            ],
            'power-bank-20000' => [
                ['name' => 'Capacity', 'value' => '20000 mAh'],
                ['name' => 'Output', 'value' => 'USB-A, USB-C'],
                ['name' => 'Fast Charging', 'value' => '22.5 W'],
                ['name' => 'Weight', 'value' => '450 g'],
            ],
            'snaige-refrigerator' => [
                ['name' => 'Type', 'value' => 'Top Freezer'],
                ['name' => 'Total Capacity', 'value' => '268 L'],
                ['name' => 'Energy Class', 'value' => 'A++'],
                ['name' => 'Noise Level', 'value' => '40 dB'],
                ['name' => 'Color', 'value' => 'White'],
            ],
            'miele-c3' => [
                ['name' => 'Type', 'value' => 'Canister'],
                ['name' => 'Power', 'value' => '890 W'],
                ['name' => 'Bag Capacity', 'value' => '4.5 L'],
                ['name' => 'Noise Level', 'value' => '73 dB'],
                ['name' => 'Cable Length', 'value' => '7.5 m'],
                ['name' => 'Filter', 'value' => 'HEPA AirClean'],
            ],
            'apple-watch-6' => [
                ['name' => 'Display', 'value' => '1.78" OLED Always-On Retina'],
                ['name' => 'Chip', 'value' => 'Apple S6'],
                ['name' => 'Sensors', 'value' => 'Blood oxygen, ECG, Heart rate'],
                ['name' => 'Water Resistance', 'value' => '50 m (WR50)'],
                ['name' => 'Connectivity', 'value' => 'Wi-Fi, Bluetooth 5.0, NFC'],
            ],
        ];

        $productIds = Product::query()->pluck('id', 'slug');

        foreach ($characteristics as $slug => $items) {
            $productId = $productIds[$slug] ?? null;

            if ($productId === null) {
                continue;
            }

            foreach ($items as $position => $item) {
                ProductCharacteristic::updateOrCreate(
                    [
                        'product_id' => $productId,
                        'name' => $item['name'],
                    ],
                    [
                        'value' => $item['value'],
                        'position' => $position + 1,
                    ]
                );
            }
        }
    }
}
