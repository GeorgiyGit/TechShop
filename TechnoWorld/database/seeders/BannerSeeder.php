<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'slug' => 'hero-motorola-razr-50-ultra',
                'product_slug' => 'motorola-razr-50-ultra',
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
                'product_slug' => 'microsoft-surface-go-3',
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
                'product_slug' => 'iphone-11',
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
                'slug' => 'featured-saeco-royal-professional',
                'product_slug' => 'saeco-royal-professional',
                'carousel' => 'featured',
                'tag' => 'This Week Only',
                'title' => "Saeco Royal Professional\nFlash Price",
                'description' => 'Bring cafe-level espresso home with this premium automatic coffee maker.',
                'cta_text' => 'Grab Saeco Deal',
                'image_path' => 'coffee-maker/saeco-royal-professional/image.png',
                'image_alt' => 'Saeco Royal Professional coffee maker',
                'slide_class' => 'carousel-slide-1',
                'image_class' => 'home-banner-image-appliance',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'slug' => 'featured-apple-watch-6',
                'product_slug' => 'apple-watch-6',
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
                'slug' => 'featured-miele-c3',
                'product_slug' => 'miele-c3',
                'carousel' => 'featured',
                'tag' => 'Just Landed',
                'title' => "Miele C3 Vacuum\nNow in Store",
                'description' => 'A new stock of the Miele Complete C3 with powerful cleaning performance.',
                'cta_text' => 'See New Miele Stock',
                'image_path' => 'vacuum-cleaner/miele-c3/image.png',
                'image_alt' => 'Miele Complete C3 vacuum cleaner',
                'slide_class' => 'carousel-slide-3',
                'image_class' => 'home-banner-image-appliance',
                'sort_order' => 30,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(
                ['slug' => $banner['slug']],
                $banner
            );
        }
    }
}
