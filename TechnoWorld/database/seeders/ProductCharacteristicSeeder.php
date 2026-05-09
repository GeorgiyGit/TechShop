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
            'Royal Professional Coffee Maker' => [
                ['name' => 'Type', 'value' => 'Automatic Espresso Machine'],
                ['name' => 'Capacity', 'value' => '2.5 L'],
                ['name' => 'Pressure', 'value' => '15 bar'],
                ['name' => 'Grinder', 'value' => 'Built-in ceramic'],
                ['name' => 'Power', 'value' => '1400 W'],
            ],
            'Surface Go 3' => [
                ['name' => 'Display', 'value' => '10.5" PixelSense (1920x1280)'],
                ['name' => 'Processor', 'value' => 'Intel Pentium Gold 6500Y'],
                ['name' => 'RAM', 'value' => '4 GB'],
                ['name' => 'Storage', 'value' => '64 GB eMMC'],
                ['name' => 'OS', 'value' => 'Windows 11 Home S'],
                ['name' => 'Weight', 'value' => '544 g'],
            ],
            'Microwave Oven' => [
                ['name' => 'Capacity', 'value' => '25 L'],
                ['name' => 'Power', 'value' => '900 W'],
                ['name' => 'Technology', 'value' => 'Inverter'],
                ['name' => 'Turntable Diameter', 'value' => '34 cm'],
                ['name' => 'Color', 'value' => 'Black'],
            ],
            'Wireless Mouse M510' => [
                ['name' => 'Connection', 'value' => 'Wireless (USB receiver)'],
                ['name' => 'Sensor', 'value' => 'Laser'],
                ['name' => 'DPI', 'value' => '1000'],
                ['name' => 'Battery Life', 'value' => '24 months'],
                ['name' => 'Buttons', 'value' => '7'],
            ],
            'iPhone 11' => [
                ['name' => 'Display', 'value' => '6.1" Liquid Retina HD'],
                ['name' => 'Processor', 'value' => 'A13 Bionic'],
                ['name' => 'Camera', 'value' => 'Dual 12 MP (Wide + Ultra Wide)'],
                ['name' => 'Storage', 'value' => '64 GB'],
                ['name' => 'Battery', 'value' => '3110 mAh'],
                ['name' => 'Water Resistance', 'value' => 'IP68'],
            ],
            'Razr 50 Ultra' => [
                ['name' => 'Display', 'value' => '6.9" pOLED 165Hz'],
                ['name' => 'External Display', 'value' => '4" pOLED'],
                ['name' => 'Processor', 'value' => 'Snapdragon 8s Gen 3'],
                ['name' => 'RAM', 'value' => '12 GB'],
                ['name' => 'Storage', 'value' => '512 GB'],
                ['name' => 'Camera', 'value' => '50 MP + 50 MP'],
            ],
            'Moto G86' => [
                ['name' => 'Display', 'value' => '6.67" pOLED 120Hz'],
                ['name' => 'Processor', 'value' => 'Snapdragon 2+ Gen 1'],
                ['name' => 'RAM', 'value' => '8 GB'],
                ['name' => 'Storage', 'value' => '256 GB'],
                ['name' => 'Battery', 'value' => '5000 mAh'],
                ['name' => 'Camera', 'value' => '50 MP OIS'],
            ],
            'ZB2951 ErgoRapido' => [
                ['name' => 'Type', 'value' => '2-in-1 Cordless Stick & Handheld'],
                ['name' => 'Power', 'value' => '18 V'],
                ['name' => 'Runtime', 'value' => 'Up to 30 min'],
                ['name' => 'Dustbin Capacity', 'value' => '0.4 L'],
                ['name' => 'Weight', 'value' => '1.4 kg'],
                ['name' => 'Filter', 'value' => 'Washable'],
            ],
            'Power Bank 20000 mAh' => [
                ['name' => 'Capacity', 'value' => '20000 mAh'],
                ['name' => 'Output', 'value' => 'USB-A, USB-C'],
                ['name' => 'Fast Charging', 'value' => '22.5 W'],
                ['name' => 'Weight', 'value' => '450 g'],
            ],
            'Refrigerator' => [
                ['name' => 'Type', 'value' => 'Top Freezer'],
                ['name' => 'Total Capacity', 'value' => '268 L'],
                ['name' => 'Energy Class', 'value' => 'A++'],
                ['name' => 'Noise Level', 'value' => '40 dB'],
                ['name' => 'Color', 'value' => 'White'],
            ],
            'Complete C3 Vacuum' => [
                ['name' => 'Type', 'value' => 'Canister'],
                ['name' => 'Power', 'value' => '890 W'],
                ['name' => 'Bag Capacity', 'value' => '4.5 L'],
                ['name' => 'Noise Level', 'value' => '73 dB'],
                ['name' => 'Cable Length', 'value' => '7.5 m'],
                ['name' => 'Filter', 'value' => 'HEPA AirClean'],
            ],
            'Watch Series 6' => [
                ['name' => 'Display', 'value' => '1.78" OLED Always-On Retina'],
                ['name' => 'Chip', 'value' => 'Apple S6'],
                ['name' => 'Sensors', 'value' => 'Blood oxygen, ECG, Heart rate'],
                ['name' => 'Water Resistance', 'value' => '50 m (WR50)'],
                ['name' => 'Connectivity', 'value' => 'Wi-Fi, Bluetooth 5.0, NFC'],
            ],
            'Magnifica S Coffee Machine' => [
                ['name' => 'Type', 'value' => 'Super-Automatic Espresso Machine'],
                ['name' => 'Capacity', 'value' => '1.8 L'],
                ['name' => 'Pressure', 'value' => '15 bar'],
                ['name' => 'Grinder', 'value' => 'Built-in steel, 5 levels'],
                ['name' => 'Power', 'value' => '1450 W'],
                ['name' => 'Color', 'value' => 'Silver / Black'],
            ],
            'IdeaPad Slim 3' => [
                ['name' => 'Display', 'value' => '15.6" Full HD IPS'],
                ['name' => 'Processor', 'value' => 'AMD Ryzen 5 7520U'],
                ['name' => 'RAM', 'value' => '8 GB'],
                ['name' => 'Storage', 'value' => '512 GB SSD'],
                ['name' => 'OS', 'value' => 'Windows 11 Home'],
                ['name' => 'Battery', 'value' => 'Up to 10 hours'],
            ],
            'Microwave Oven MS23K3513' => [
                ['name' => 'Capacity', 'value' => '23 L'],
                ['name' => 'Power', 'value' => '800 W'],
                ['name' => 'Interior', 'value' => 'Ceramic Enamel'],
                ['name' => 'Turntable Diameter', 'value' => '28.5 cm'],
                ['name' => 'Color', 'value' => 'White'],
            ],
            'Arc Mouse Bluetooth' => [
                ['name' => 'Connection', 'value' => 'Bluetooth 5.0'],
                ['name' => 'Sensor', 'value' => 'BlueTrack'],
                ['name' => 'Battery Life', 'value' => 'Up to 4 months'],
                ['name' => 'Compatibility', 'value' => 'Windows, macOS, Android'],
                ['name' => 'Weight', 'value' => '86 g'],
            ],
            'Galaxy A55 5G' => [
                ['name' => 'Display', 'value' => '6.6" Super AMOLED 120Hz'],
                ['name' => 'Processor', 'value' => 'Exynos 1480'],
                ['name' => 'RAM', 'value' => '8 GB'],
                ['name' => 'Storage', 'value' => '256 GB'],
                ['name' => 'Camera', 'value' => '50 MP OIS + 12 MP + 5 MP'],
                ['name' => 'Battery', 'value' => '5000 mAh'],
                ['name' => 'Water Resistance', 'value' => 'IP67'],
            ],
            'Xiaomi 14' => [
                ['name' => 'Display', 'value' => '6.36" LTPO AMOLED 120Hz'],
                ['name' => 'Processor', 'value' => 'Snapdragon 8 Gen 3'],
                ['name' => 'RAM', 'value' => '12 GB'],
                ['name' => 'Storage', 'value' => '256 GB'],
                ['name' => 'Camera', 'value' => 'Leica 50 MP + 50 MP + 50 MP'],
                ['name' => 'Fast Charging', 'value' => '90 W wired / 50 W wireless'],
            ],
            'Pixel 8a' => [
                ['name' => 'Display', 'value' => '6.1" OLED 120Hz'],
                ['name' => 'Processor', 'value' => 'Google Tensor G3'],
                ['name' => 'RAM', 'value' => '8 GB'],
                ['name' => 'Camera', 'value' => '64 MP + 13 MP Ultra Wide'],
                ['name' => 'Battery', 'value' => '4492 mAh'],
                ['name' => 'Updates', 'value' => '7 years guaranteed'],
            ],
            'PowerCore 26800 Power Bank' => [
                ['name' => 'Capacity', 'value' => '26800 mAh'],
                ['name' => 'Outputs', 'value' => '2x USB-A, 1x USB-C'],
                ['name' => 'Max Output per port', 'value' => '5V / 3A'],
                ['name' => 'Technology', 'value' => 'PowerIQ'],
                ['name' => 'Weight', 'value' => '480 g'],
            ],
            'KGN36VWEQ Refrigerator' => [
                ['name' => 'Type', 'value' => 'Free-Standing Fridge-Freezer'],
                ['name' => 'Total Capacity', 'value' => '321 L'],
                ['name' => 'Technology', 'value' => 'NoFrost, VitaFresh XL'],
                ['name' => 'Energy Class', 'value' => 'A++'],
                ['name' => 'Noise Level', 'value' => '39 dB'],
            ],
            'V11 Cordless Vacuum' => [
                ['name' => 'Type', 'value' => 'Cordless Stick Vacuum'],
                ['name' => 'Motor', 'value' => 'Dyson Digital Motor V11'],
                ['name' => 'Runtime', 'value' => 'Up to 60 min (Eco mode)'],
                ['name' => 'Filtration', 'value' => 'Whole-machine HEPA'],
                ['name' => 'Bin Volume', 'value' => '0.77 L'],
                ['name' => 'Weight', 'value' => '2.97 kg'],
            ],
            'X-Force 9.60 Cordless Vacuum' => [
                ['name' => 'Type', 'value' => 'Cordless Stick Vacuum'],
                ['name' => 'Runtime', 'value' => 'Up to 45 min'],
                ['name' => 'Brush', 'value' => 'Self-Cleaning Roll Brush'],
                ['name' => 'Filtration', 'value' => 'Washable HEPA'],
                ['name' => 'Dustbin Capacity', 'value' => '0.9 L'],
                ['name' => 'Weight', 'value' => '2.6 kg'],
            ],
            'Galaxy Watch 6' => [
                ['name' => 'Display', 'value' => '1.5" Super AMOLED'],
                ['name' => 'Chip', 'value' => 'Exynos W930'],
                ['name' => 'Sensors', 'value' => 'BioActive (body composition, ECG, BPM)'],
                ['name' => 'Battery', 'value' => '425 mAh (~40 h)'],
                ['name' => 'Water Resistance', 'value' => 'IP68 / 5ATM'],
                ['name' => 'OS', 'value' => 'Wear OS with One UI Watch'],
            ],
        ];

        $productIds = Product::query()->pluck('id', 'name');

        foreach ($characteristics as $productName => $items) {
            $productId = $productIds[$productName] ?? null;

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
