@extends('layouts.storefront', ['title' => 'TechnoWorld - Home'])

@section('bodyClass', 'home-page')

@section('content')
    @include('partials.storefront-header')

    @if ($heroBanners->isNotEmpty())
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($heroBanners as $banner)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $loop->index }}"
                        @class(['active' => $loop->first])
                        aria-label="Slide {{ $loop->iteration }}"></button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @foreach ($heroBanners as $banner)
                    <div @class(['carousel-item', 'active' => $loop->first])>
                        <div class="carousel-slide {{ $banner->slide_class }} home-banner">
                            <div class="carousel-slide-content home-banner-content">
                                <span class="tag">{{ $banner->tag }}</span>
                                <h2 class="display-5 fw-bold white-text">{!! nl2br(e($banner->title)) !!}</h2>
                                <p class="lead white-text mb-4">{{ $banner->description }}</p>
                                <a href="{{ $banner->product_slug ? route('product.show', $banner->product_slug) : '#' }}" class="btn btn-light btn-lg px-4 text-primary-brand fw-600">{{ $banner->cta_text }}</a>
                            </div>
                            <div class="home-banner-media">
                                <div class="home-banner-product-card">
                                    <img src="{{ url('/images/products/' . ltrim($banner->image_path, '/')) }}" alt="{{ $banner->image_alt }}" class="home-banner-image {{ $banner->image_class }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif

    <section id="about" class="home-about">
        <h2 class="home-quote">Where Innovation Meets Everyday Life</h2>

        <p class="home-text-left">
            At TechnoWorld, we believe great technology should be accessible to everyone. Founded by a team of passionate
            tech enthusiasts, we have carefully curated a premium selection of the latest smartphones, laptops, tablets,
            audio gear, cameras, and much more - all under one roof. Every product in our catalogue is hand-picked and
            reviewed to ensure it meets our standards for quality, performance, and value. We partner with the world's
            leading brands - Apple, Samsung, Sony, Lenovo, and beyond - to bring you cutting-edge technology at
            competitive prices. Whether you are upgrading your current setup, searching for the perfect gift, or simply
            keeping up with the latest innovations, TechnoWorld is your trusted destination for all things tech.
        </p>

        <p class="home-text-right">
            Shopping at TechnoWorld is more than just a transaction - it is an experience built around you. We offer
            fast and secure delivery straight to your door, hassle-free returns, and a dedicated support team ready to
            assist you at every step of your journey. Our platform is designed to make finding the right product
            effortless, with detailed specifications, genuine customer reviews, and personalised expert recommendations.
            From first-time buyers taking their first steps into the world of technology to seasoned professionals
            seeking the highest-performance tools - we are here for everyone. Join thousands of satisfied customers who
            trust TechnoWorld to power their digital lives, day after day.
        </p>
    </section>

    @if ($featuredBanners->isNotEmpty())
        <div id="featuredCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($featuredBanners as $banner)
                    <button type="button" data-bs-target="#featuredCarousel" data-bs-slide-to="{{ $loop->index }}"
                        @class(['active' => $loop->first])
                        aria-label="Slide {{ $loop->iteration }}"></button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @foreach ($featuredBanners as $banner)
                    <div @class(['carousel-item', 'active' => $loop->first])>
                        <div class="carousel-slide {{ $banner->slide_class }} home-banner">
                            <div class="carousel-slide-content home-banner-content">
                                <span class="tag">{{ $banner->tag }}</span>
                                <h2 class="display-5 fw-bold white-text">{!! nl2br(e($banner->title)) !!}</h2>
                                <p class="lead white-text mb-4">{{ $banner->description }}</p>
                                <a href="{{ $banner->product_slug ? route('product.show', $banner->product_slug) : '#' }}" class="btn btn-light btn-lg px-4 text-primary-brand fw-600">{{ $banner->cta_text }}</a>
                            </div>
                            <div class="home-banner-media">
                                <div class="home-banner-product-card">
                                    <img src="{{ url('/images/products/' . ltrim($banner->image_path, '/')) }}" alt="{{ $banner->image_alt }}" class="home-banner-image {{ $banner->image_class }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif

    <section class="home-categories-section">
        <h2 class="home-categories-title">Categories</h2>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3">
            @foreach ($categories as $category)
                <div class="col">
                    <a href="{{ route('products', ['categories' => [$category->id]]) }}" class="home-category-card">
                        <div class="home-category-icon"><i class="bi {{ $category->icon }}"></i></div>
                        <span class="home-category-name">{{ $category->name }}</span>
                    </a>
                </div>
            @endforeach

        </div>
    </section>

    @include('partials.storefront-footer', ['aboutHref' => '#about'])

@endsection