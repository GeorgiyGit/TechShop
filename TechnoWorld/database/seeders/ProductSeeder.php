<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = Category::query()->pluck('id', 'name');
        $brandIds = Brand::query()->pluck('id', 'name');

        $products = [
            [
                'category_name' => 'Home Appliances',
                'brand_name' => 'DeLonghi',
                'name' => 'Royal Professional Coffee Maker',
                'short_description' => 'Fully automatic espresso machine with built-in ceramic grinder, adjustable grind settings, and integrated milk frother for cafe-quality espresso at home.',
                'description' => 'The Saeco Royal Professional is a fully automatic espresso machine designed for coffee lovers who demand complete control over every cup. Its built-in ceramic grinder with adjustable grind settings lets you tailor the coarseness to your preferred beans, while the integrated milk frother delivers velvety microfoam for lattes and cappuccinos at the touch of a button. The large 2.5-litre water tank and spacious bean hopper mean fewer refills during busy mornings. With a robust stainless steel body and intuitive control panel, the Royal Professional combines a professional café experience with the convenience of home brewing.',
                'price' => 899.99,
                'stock_quantity' => 9,
            ],
            [
                'category_name' => 'Laptops',
                'brand_name' => 'Microsoft',
                'name' => 'Surface Go 3',
                'short_description' => 'Compact 2-in-1 with a 10.5-inch PixelSense touchscreen, Intel processor, and Windows 11 - ideal for students and on-the-go professionals.',
                'description' => 'The Microsoft Surface Go 3 is a compact, lightweight 2-in-1 laptop built for students, commuters, and creative professionals who need portability without sacrificing productivity. Its 10.5-inch PixelSense touchscreen delivers sharp, vibrant visuals at 1920x1280 resolution with a 3:2 aspect ratio ideal for reading and writing. Powered by the Intel Pentium Gold 6500Y processor and running Windows 11, it handles everyday tasks, Office apps, and web browsing with ease. At just 544 grams, it slips effortlessly into a backpack, and the all-day battery keeps you going from the first lecture to the last meeting.',
                'price' => 629.99,
                'stock_quantity' => 12,
            ],
            [
                'category_name' => 'Home Appliances',
                'brand_name' => 'Panasonic',
                'name' => 'Microwave Oven',
                'short_description' => '25-litre microwave with Inverter technology for even heating, 900 W output, and a digital touch panel with auto-cook programs for everyday use.',
                'description' => 'The Panasonic Microwave Oven brings intelligent cooking technology into your kitchen with its patented Inverter heating system, which delivers a continuous, consistent power stream instead of the stop-start cycling of traditional microwaves. The result is food that heats evenly from edge to edge, with no overcooked corners or cold centres. Its 25-litre capacity easily accommodates large dinner plates and family-sized portions, while the 900 W power output ensures fast, efficient results across reheating, defrosting, and cooking programs.',
                'price' => 219.99,
                'stock_quantity' => 4,
            ],
            [
                'category_name' => 'Accessories',
                'brand_name' => 'Microsoft',
                'name' => 'Wireless Mouse M510',
                'short_description' => 'Ergonomic wireless mouse with 24-month battery life, laser tracking on any surface, and a plug-and-forget Unifying nano-receiver.',
                'description' => 'The Logitech Wireless Mouse M510 is engineered for all-day comfort and multi-surface precision. Its sculpted, right-handed contour fits naturally in the hand, reducing wrist fatigue during long work and browsing sessions. The advanced laser sensor tracks reliably on virtually any surface - including glass - without the need for a mouse pad. Two AA batteries power the M510 for up to 24 months, making it one of the most energy-efficient wireless mice available.',
                'price' => 34.99,
                'stock_quantity' => 17,
            ],
            [
                'category_name' => 'Smartphones',
                'brand_name' => 'Apple',
                'name' => 'iPhone 11',
                'short_description' => 'Reliable smartphone with a 6.1-inch Liquid Retina display, A13 Bionic chip, dual 12 MP cameras with Night mode, and IP68 water resistance.',
                'description' => 'The Apple iPhone 11 remains one of the most well-rounded smartphones Apple has released, combining reliable everyday performance with a dual-camera system that punches well above its price. The 6.1-inch Liquid Retina HD display is bright, colour-accurate, and protected by Ceramic Shield glass. Under the hood, the A13 Bionic chip handles demanding apps, games, and video editing with ease, and the Neural Engine powers computational photography features like Portrait mode, Smart HDR, and Night mode.',
                'price' => 479.99,
                'stock_quantity' => 15,
            ],
            [
                'category_name' => 'Smartphones',
                'brand_name' => 'Motorola',
                'name' => 'Razr 50 Ultra',
                'short_description' => 'Premium foldable phone with a 6.9-inch 165Hz display, 4-inch external screen, Snapdragon 8s Gen 3 chip, and dual 50 MP cameras.',
                'description' => 'The Motorola Razr 50 Ultra redefines what a foldable phone can be, pairing a large 4-inch external pOLED display with a flagship-grade 6.9-inch main display running at 165Hz for silky-smooth scrolling. The Snapdragon 8s Gen 3 chipset delivers desktop-class performance in a pocketable form factor. The dual 50 MP camera system produces stunning detail and wide dynamic range.',
                'price' => 999.99,
                'stock_quantity' => 3,
            ],
            [
                'category_name' => 'Smartphones',
                'brand_name' => 'Motorola',
                'name' => 'Moto G86',
                'short_description' => 'Mid-range smartphone with a 6.67-inch 120Hz pOLED display, 50 MP OIS camera, 5000 mAh battery, and 33W TurboPower fast charging.',
                'description' => 'The Motorola Moto G86 is designed for users who want a premium experience at a mid-range price. Its 6.67-inch pOLED display with 120Hz refresh rate makes every swipe and scroll feel fluid. The 50 MP OIS main camera stabilises handheld shots and low-light captures. A 5000 mAh battery with 33W TurboPower charging provides all-day endurance and quick top-ups.',
                'price' => 289.99,
                'stock_quantity' => 8,
            ],
            [
                'category_name' => 'Home Appliances',
                'brand_name' => 'LG',
                'name' => 'ZB2951 ErgoRapido',
                'short_description' => 'Lightweight cordless 2-in-1 stick vacuum with automatic power boost, up to 30 min runtime, and a detachable handheld unit for versatile cleaning.',
                'description' => 'The Electrolux ZB2951 ErgoRapido is a versatile 2-in-1 cordless vacuum that transforms from a full-size stick vacuum into a compact handheld in seconds. Its Automatic Boost technology detects carpet and instantly increases suction power. Up to 30 minutes of cordless runtime gives you the freedom to clean the whole home on a single charge.',
                'price' => 249.99,
                'stock_quantity' => 11,
            ],
            [
                'category_name' => 'Power & Batteries',
                'brand_name' => 'Samsung',
                'name' => 'Power Bank 20000 mAh',
                'short_description' => 'High-capacity 20000 mAh power bank with 22.5W fast charging, three simultaneous outputs, and a precise digital battery indicator.',
                'description' => 'The Baseus 20000 mAh Power Bank is the travel companion that keeps all your devices topped up through long journeys, outdoor adventures, and multi-day trips. Its massive 20000 mAh capacity can fully recharge a smartphone four to five times. Two USB-A outputs and a USB-C port allow simultaneous charging of three devices at once.',
                'price' => 49.99,
                'stock_quantity' => 5,
            ],
            [
                'category_name' => 'Home Appliances',
                'brand_name' => 'Bosch',
                'name' => 'Refrigerator',
                'short_description' => 'Energy-efficient top-freezer refrigerator with 268 L capacity, A++ energy rating, adjustable shelves, and whisper-quiet 40 dB operation.',
                'description' => 'The Snaige Refrigerator combines classic reliability with a modern, clean interior design that maximises usable storage space. Its 268-litre total capacity across the fridge and freezer compartments provides ample room for a family\'s weekly shop, while adjustable glass shelves and door bins let you arrange food exactly as you like.',
                'price' => 549.99,
                'stock_quantity' => 2,
            ],
            [
                'category_name' => 'Home Appliances',
                'brand_name' => 'Dyson',
                'name' => 'Complete C3 Vacuum',
                'short_description' => 'Premium canister vacuum with a powerful Vortex Motor, HEPA AirClean filter, 4.5 L dust bag, 7.5 m cable, and 20-year build quality.',
                'description' => 'The Miele Complete C3 is a premium canister vacuum cleaner that sets the standard for thorough, hygienic home cleaning. Its 890 W Miele-manufactured Vortex Motor generates powerful, consistent suction that lifts deep-seated dust, pet hair, and allergens from carpets, hard floors, and upholstery.',
                'price' => 399.99,
                'stock_quantity' => 7,
            ],
            [
                'category_name' => 'Smart Watches',
                'brand_name' => 'Apple',
                'name' => 'Watch Series 6',
                'short_description' => 'Feature-rich smartwatch with blood oxygen sensor, ECG app, always-on Retina display, built-in GPS, Apple Pay, and WR50 water resistance.',
                'description' => 'The Apple Watch Series 6 goes beyond timekeeping to become a comprehensive health and fitness companion worn on your wrist. The blood oxygen sensor and ECG app provide meaningful health insights you can share with your doctor, while the optical heart rate sensor tracks your heart rate continuously throughout the day.',
                'price' => 299.99,
                'stock_quantity' => 6,
            ],
        ];

        foreach ($products as $data) {
            $categoryId = $categoryIds[$data['category_name']] ?? null;
            $brandId = $brandIds[$data['brand_name']] ?? null;

            Product::query()->firstOrCreate(
                ['name' => $data['name']],
                [
                    'category_id' => $categoryId,
                    'brand_id' => $brandId,
                    'short_description' => $data['short_description'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'stock_quantity' => $data['stock_quantity'],
                ]
            );
        }
    }
}
