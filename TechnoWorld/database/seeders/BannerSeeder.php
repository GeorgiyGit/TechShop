<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'slug' => 'hero-motorola-razr-50-ultra',
                'product_name' => 'Razr 50 Ultra',
                'carousel' => 'hero',
                'tag' => 'New Arrival',
                'title' => "Motorola Razr 50 Ultra\nHas Just Arrived",
                'description' => 'Experience a premium foldable design and flagship-level camera performance.',
                'cta_text' => 'Discover Razr 50 Ultra',
                'image_path' => 'phone/motorola-razr-50-ultra/image.png',
                'image_alt' => 'Motorola Razr 50 Ultra',
                'slide_class' => 'carousel-slide-1',
                'image_class' => 'home-banner-image-phone',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'slug' => 'hero-surface-go-3',
                'product_name' => 'Surface Go 3',
                'carousel' => 'hero',
                'tag' => 'Limited Time',
                'title' => "Surface Go 3 Deal\nEnds This Week",
                'description' => 'Save now on a compact laptop designed for daily work and studies.',
                'cta_text' => 'View Surface Go 3 Deal',
                'image_path' => 'laptop/microsoft-surface-go-3/image.png',
                'image_alt' => 'Microsoft Surface Go 3',
                'slide_class' => 'carousel-slide-2',
                'image_class' => 'home-banner-image-laptop',
                'sort_order' => 20,
                'is_active' => true,
            ],
            [
                'slug' => 'hero-iphone-11',
                'product_name' => 'iPhone 11',
                'carousel' => 'hero',
                'tag' => 'Top Pick',
                'title' => "Apple iPhone 11\nStill a Bestseller",
                'description' => 'Reliable performance, smooth camera system, and excellent value.',
                'cta_text' => 'Explore iPhone 11',
                'image_path' => 'phone/iphone-11/image.png',
                'image_alt' => 'Apple iPhone 11',
                'slide_class' => 'carousel-slide-3',
                'image_class' => 'home-banner-image-phone',
                'sort_order' => 30,
                'is_active' => true,
            ],
            [
                'slug' => 'featured-magnifica-s',
                'product_name' => 'Magnifica S Coffee Machine',
                'carousel' => 'featured',
                'tag' => 'This Week Only',
                'title' => "De'Longhi Magnifica S\nFlash Price",
                'description' => 'Bring cafe-level espresso home with this premium automatic coffee maker.',
                'cta_text' => 'Grab Magnifica S Deal',
                'image_path' => 'coffee-maker/delonghi-magnifica-s/image.png',
                'image_alt' => 'De\'Longhi Magnifica S coffee maker',
                'slide_class' => 'carousel-slide-1',
                'image_class' => 'home-banner-image-appliance',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'slug' => 'featured-apple-watch-6',
                'product_name' => 'Watch Series 6',
                'carousel' => 'featured',
                'tag' => 'Fast Delivery',
                'title' => "Apple Watch 6\nDelivered Fast",
                'description' => 'Order today and get this smartwatch quickly with express shipping options.',
                'cta_text' => 'Shop Apple Watch 6',
                'image_path' => 'watch/apple-watch-6/image.png',
                'image_alt' => 'Apple Watch Series 6',
                'slide_class' => 'carousel-slide-2',
                'image_class' => 'home-banner-image-watch',
                'sort_order' => 20,
                'is_active' => true,
            ],
            [
                'slug' => 'featured-dyson-v11',
                'product_name' => 'V11 Cordless Vacuum',
                'carousel' => 'featured',
                'tag' => 'Just Landed',
                'title' => "Dyson V11 Vacuum\nNow in Store",
                'description' => 'A new stock of the Dyson V11 with powerful intelligent cleaning performance.',
                'cta_text' => 'See New Dyson Stock',
                'image_path' => 'vacuum-cleaner/dyson-v11/image.png',
                'image_alt' => 'Dyson V11 cordless vacuum cleaner',
                'slide_class' => 'carousel-slide-3',
                'image_class' => 'home-banner-image-appliance',
                'sort_order' => 30,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            $productId = Product::where('name', $banner['product_name'])->value('id');
            unset($banner['product_name']);
            $banner['product_id'] = $productId;

            Banner::updateOrCreate(
                ['slug' => $banner['slug']],
                $banner
            );
        }
    }
}
