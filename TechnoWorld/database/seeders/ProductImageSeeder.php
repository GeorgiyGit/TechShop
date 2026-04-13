<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            'saeco-royal-professional' => [
                'coffee-maker/saeco-royal-professional/image.png',
                'coffee-maker/saeco-royal-professional/image2.png',
                'coffee-maker/saeco-royal-professional/image3.png',
            ],
            'microsoft-surface-go-3' => [
                'laptop/microsoft-surface-go-3/image.png',
                'laptop/microsoft-surface-go-3/image2.png',
                'laptop/microsoft-surface-go-3/image3.png',
            ],
            'panasonic-microwave-oven' => [
                'microwave-oven/panasonic/image.png',
                'microwave-oven/panasonic/image1.png',
                'microwave-oven/panasonic/image2.png',
                'microwave-oven/panasonic/image3.png',
                'microwave-oven/panasonic/image4.png',
            ],
            'logitech-m510' => [
                'mouse/logitech-wireless-mouse-m510-black/image.png',
                'mouse/logitech-wireless-mouse-m510-black/image2.png',
                'mouse/logitech-wireless-mouse-m510-black/image3.png',
                'mouse/logitech-wireless-mouse-m510-black/image4.png',
                'mouse/logitech-wireless-mouse-m510-black/image5.png',
                'mouse/logitech-wireless-mouse-m510-black/image6.png',
                'mouse/logitech-wireless-mouse-m510-black/image7.png',
                'mouse/logitech-wireless-mouse-m510-black/image8.png',
            ],
            'iphone-11' => [
                'phone/iphone-11/image.png',
                'phone/iphone-11/image2.png',
                'phone/iphone-11/image3.png',
                'phone/iphone-11/image4.png',
                'phone/iphone-11/image5.png',
                'phone/iphone-11/image6.png',
                'phone/iphone-11/image7.png',
            ],
            'motorola-razr-50-ultra' => [
                'phone/motorola-razr-50-ultra/image.png',
                'phone/motorola-razr-50-ultra/image2.png',
                'phone/motorola-razr-50-ultra/image3.png',
                'phone/motorola-razr-50-ultra/image4.png',
                'phone/motorola-razr-50-ultra/image5.png',
            ],
            'motorola-g86' => [
                'phone/motorola-g86/image.png',
                'phone/motorola-g86/image2.png',
                'phone/motorola-g86/image3.png',
                'phone/motorola-g86/image4.png',
                'phone/motorola-g86/image5.png',
            ],
            'motorola-razr-50' => [
                'phone/motorola-razr-50-ultra/image.png',
                'phone/motorola-razr-50-ultra/image2.png',
                'phone/motorola-razr-50-ultra/image3.png',
                'phone/motorola-razr-50-ultra/image4.png',
                'phone/motorola-razr-50-ultra/image5.png',
            ],
            'electrolux-zb-2951' => [
                'vacuum-cleaner/electrolux-zb-2951-ergorapido/image.png',
                'vacuum-cleaner/electrolux-zb-2951-ergorapido/image2.png',
                'vacuum-cleaner/electrolux-zb-2951-ergorapido/image3.png',
                'vacuum-cleaner/electrolux-zb-2951-ergorapido/image4.png',
                'vacuum-cleaner/electrolux-zb-2951-ergorapido/image5.png',
            ],
            'power-bank-20000' => [
                'power-bank/20000-mah/image.png',
                'power-bank/20000-mah/image2.png',
                'power-bank/20000-mah/image3.png',
                'power-bank/20000-mah/image4.png',
                'power-bank/20000-mah/image5.png',
            ],
            'snaige-refrigerator' => [
                'refrigerator/snaige/image.png',
                'refrigerator/snaige/image2.png',
                'refrigerator/snaige/image3.png',
                'refrigerator/snaige/image4.png',
                'refrigerator/snaige/image5.png',
                'refrigerator/snaige/image6.png',
            ],
            'miele-c3' => [
                'vacuum-cleaner/miele-c3/image.png',
                'vacuum-cleaner/miele-c3/image2.png',
                'vacuum-cleaner/miele-c3/image3.png',
                'vacuum-cleaner/miele-c3/image4.png',
                'vacuum-cleaner/miele-c3/image5.png',
                'vacuum-cleaner/miele-c3/image6.png',
                'vacuum-cleaner/miele-c3/image7.png',
            ],
            'apple-watch-6' => [
                'watch/apple-watch-6/image.png',
                'watch/apple-watch-6/image2.png',
                'watch/apple-watch-6/image3.png',
                'watch/apple-watch-6/image4.png',
                'watch/apple-watch-6/image5.png',
                'watch/apple-watch-6/image6.png',
            ],
            'delonghi-magnifica-s' => [
                'coffee-maker/delonghi-magnifica-s/image2.png',
                'coffee-maker/delonghi-magnifica-s/image3.png',
                'coffee-maker/delonghi-magnifica-s/image.png',
            ],
            'lenovo-ideapad-slim-3' => [
                'laptop/lenovo-ideapad-slim-3/image2.png',
                'laptop/lenovo-ideapad-slim-3/image3.png',
                'laptop/lenovo-ideapad-slim-3/image.png',
            ],
            'samsung-ms23k' => [
                'microwave-oven/samsung-ms23k/image1.png',
                'microwave-oven/samsung-ms23k/image2.png',
                'microwave-oven/samsung-ms23k/image3.png',
                'microwave-oven/samsung-ms23k/image4.png',
                'microwave-oven/samsung-ms23k/image.png',
            ],
            'microsoft-arc-mouse' => [
                'mouse/microsoft-arc-mouse/image2.png',
                'mouse/microsoft-arc-mouse/image3.png',
                'mouse/microsoft-arc-mouse/image4.png',
                'mouse/microsoft-arc-mouse/image5.png',
                'mouse/microsoft-arc-mouse/image6.png',
                'mouse/microsoft-arc-mouse/image7.png',
                'mouse/microsoft-arc-mouse/image8.png',
                'mouse/microsoft-arc-mouse/image.png',
            ],
            'samsung-galaxy-a55' => [
                'phone/samsung-galaxy-a55/image2.png',
                'phone/samsung-galaxy-a55/image3.png',
                'phone/samsung-galaxy-a55/image4.png',
                'phone/samsung-galaxy-a55/image5.png',
                'phone/samsung-galaxy-a55/image6.png',
                'phone/samsung-galaxy-a55/image7.png',
                'phone/samsung-galaxy-a55/image.png',
            ],
            'xiaomi-14' => [
                'phone/xiaomi-14/image2.png',
                'phone/xiaomi-14/image3.png',
                'phone/xiaomi-14/image4.png',
                'phone/xiaomi-14/image5.png',
                'phone/xiaomi-14/image.png',
            ],
            'google-pixel-8a' => [
                'phone/google-pixel-8a/image2.png',
                'phone/google-pixel-8a/image3.png',
                'phone/google-pixel-8a/image4.png',
                'phone/google-pixel-8a/image5.png',
                'phone/google-pixel-8a/image.png',
            ],
            'anker-powercore-26800' => [
                'power-bank/anker-powercore-26800/image2.png',
                'power-bank/anker-powercore-26800/image3.png',
                'power-bank/anker-powercore-26800/image4.png',
                'power-bank/anker-powercore-26800/image5.png',
                'power-bank/anker-powercore-26800/image.png',
            ],
            'bosch-kgn36' => [
                'refrigerator/bosch-kgn36/image2.png',
                'refrigerator/bosch-kgn36/image3.png',
                'refrigerator/bosch-kgn36/image4.png',
                'refrigerator/bosch-kgn36/image5.png',
                'refrigerator/bosch-kgn36/image6.png',
                'refrigerator/bosch-kgn36/image.png',
            ],
            'dyson-v11' => [
                'vacuum-cleaner/dyson-v11/image2.png',
                'vacuum-cleaner/dyson-v11/image3.png',
                'vacuum-cleaner/dyson-v11/image4.png',
                'vacuum-cleaner/dyson-v11/image5.png',
                'vacuum-cleaner/dyson-v11/image.png',
            ],
            'rowenta-x-force' => [
                'vacuum-cleaner/rowenta-x-force/image2.png',
                'vacuum-cleaner/rowenta-x-force/image3.png',
                'vacuum-cleaner/rowenta-x-force/image4.png',
                'vacuum-cleaner/rowenta-x-force/image5.png',
                'vacuum-cleaner/rowenta-x-force/image6.png',
                'vacuum-cleaner/rowenta-x-force/image7.png',
                'vacuum-cleaner/rowenta-x-force/image.png',
            ],
            'samsung-galaxy-watch-6' => [
                'watch/samsung-galaxy-watch-6/image2.png',
                'watch/samsung-galaxy-watch-6/image3.png',
                'watch/samsung-galaxy-watch-6/image4.png',
                'watch/samsung-galaxy-watch-6/image5.png',
                'watch/samsung-galaxy-watch-6/image6.png',
                'watch/samsung-galaxy-watch-6/image.png',
            ],
        ];

        $productIds = Product::query()->pluck('id', 'slug');

        foreach ($images as $slug => $paths) {
            $productId = $productIds[$slug] ?? null;

            if ($productId === null) {
                continue;
            }

            ProductImage::where('product_id', $productId)->delete();

            foreach ($paths as $position => $path) {
                ProductImage::create([
                    'product_id' => $productId,
                    'image_path' => $path,
                    'position' => $position + 1,
                ]);
            }
        }
    }
}
