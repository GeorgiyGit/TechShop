@extends('layouts.storefront', ['title' => 'TechnoWorld - Products'])

@section('bodyClass', 'products-page')

@section('content')
    @include('partials.storefront-header')

    @if ($featuredBanners->isNotEmpty())
        <div id="featuredProductsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($featuredBanners as $banner)
                    <button type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide-to="{{ $loop->index }}"
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
                                <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-light btn-lg px-4 text-primary-brand fw-600">{{ $banner->cta_text }}</a>
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

            <button class="carousel-control-prev" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif

    <main class="products-main">
        <div class="d-flex justify-content-start align-items-center mb-4 flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2">
                <label class="text-muted small me-1 text-nowrap" for="orderBy">Order by</label>
                <select class="form-select form-select-sm select-brand" id="orderBy" style="min-width: 180px">
                    <option value="">Relevance</option>
                    <option value="price-asc">Low Price First</option>
                    <option value="price-desc">High Price First</option>
                    <option value="newest">New First</option>
                    <option value="popular">Most Popular</option>
                </select>
            </div>
        </div>

        <div class="row g-4 align-items-start">
            <aside class="col-lg-3 col-md-4">
                <div class="filter-sidebar">
                    <h6 class="filter-sidebar-title"><i class="bi bi-sliders2 me-2"></i>Filters</h6>
                    <div class="accordion accordion-flush" id="filterAccordion">
                        <div class="accordion-item filter-accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button filter-btn" type="button" data-bs-toggle="collapse" data-bs-target="#catCollapse" aria-expanded="true">Categories</button>
                            </h2>
                            <div id="catCollapse" class="accordion-collapse collapse show">
                                <div class="accordion-body filter-body">
                                    @foreach (['Smartphones', 'Laptops', 'Tablets', 'Headphones And Audio', 'Cameras', 'Gaming'] as $index => $category)
                                        <div class="form-check filter-check">
                                            <input class="form-check-input" type="checkbox" id="cat{{ $index }}">
                                            <label class="form-check-label" for="cat{{ $index }}">{{ $category }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item filter-accordion-item border-bottom-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button filter-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#priceCollapse" aria-expanded="false">Price</button>
                            </h2>
                            <div id="priceCollapse" class="accordion-collapse collapse">
                                <div class="accordion-body filter-body">
                                    <div class="d-flex gap-2 mb-3">
                                        <input type="number" class="form-control form-control-sm price-input" placeholder="Min EUR" value="0" min="0">
                                        <span class="text-muted align-self-center">-</span>
                                        <input type="number" class="form-control form-control-sm price-input" placeholder="Max EUR" value="5000" min="0">
                                    </div>
                                    <input type="range" class="form-range range-brand" min="0" max="5000" value="5000" id="priceRange" aria-label="Maximum price">
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">0 EUR</small>
                                        <small class="text-muted">5,000 EUR</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary-brand w-100 mt-3 fw-600"><i class="bi bi-search me-2"></i>Apply Filters</button>
                    <button class="btn btn-clear-filters w-100 mt-2">Clear Filters</button>
                </div>
            </aside>

            <section id="products" class="col-lg-9 col-md-8">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-3">
                    @foreach ($products as $product)
                        <div class="col">
                            <article class="product-card card h-100">
                                <img src="{{ url('/images/products/' . ltrim($product->image_path, '/')) }}" alt="{{ $product->name }}" class="product-img">
                                <div class="card-body d-flex flex-column p-3">
                                    <small class="text-muted">{{ $product->brand }}</small>
                                    <h6 class="card-title mt-1">{{ $product->name }}</h6>
                                    <p class="card-text text-muted">{{ $product->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center pt-2 mt-auto">
                                        <span class="product-price">{{ number_format((float) $product->price, 2) }} EUR</span>
                                        @auth
                                            <button type="button" class="btn btn-add-cart btn-sm"><i class="bi bi-cart-plus me-1"></i>Add</button>
                                        @else
                                            <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-add-cart btn-sm"><i class="bi bi-cart-plus me-1"></i>Add</a>
                                        @endauth
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </main>

    @include('partials.storefront-footer')
@endsection
