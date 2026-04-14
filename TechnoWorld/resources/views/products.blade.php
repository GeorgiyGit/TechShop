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
        @if ($search)
            <div class="mb-3">
                <span class="text-muted">Search results for: </span>
                <strong>{{ $search }}</strong>
                <a href="{{ route('products') }}" class="ms-2 small text-danger"><i class="bi bi-x-circle"></i> Clear</a>
            </div>
        @endif

        <div class="d-flex justify-content-start align-items-center mb-4 flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2">
                <label class="text-muted small me-1 text-nowrap" for="orderBy">Order by</label>
                <select class="form-select form-select-sm select-brand" id="orderBy" name="orderBy" form="productsFiltersForm" style="min-width: 180px" onchange="this.form.submit()">
                    <option value="relevance" @selected($orderBy === 'relevance')>Relevance</option>
                    <option value="price-asc" @selected($orderBy === 'price-asc')>Low Price First</option>
                    <option value="price-desc" @selected($orderBy === 'price-desc')>High Price First</option>
                    <option value="newest" @selected($orderBy === 'newest')>New First</option>
                    <option value="popular" @selected($orderBy === 'popular')>Most Popular</option>
                </select>
            </div>
        </div>

        <div class="row g-4 align-items-start">
            <aside class="col-lg-3 col-md-4">
                <form id="productsFiltersForm" method="GET" action="{{ route('products') }}">
                    @if ($search)
                        <input type="hidden" name="search" value="{{ $search }}">
                    @endif
                    <div class="filter-sidebar">
                        <h6 class="filter-sidebar-title"><i class="bi bi-sliders2 me-2"></i>Filters</h6>
                        <div class="accordion accordion-flush" id="filterAccordion">
                            <div class="accordion-item filter-accordion-item">
                                <h2 class="accordion-header">
                                    <button @class(['accordion-button', 'filter-btn', 'collapsed' => ! $openCategoryFilter]) type="button" data-bs-toggle="collapse" data-bs-target="#catCollapse" aria-expanded="{{ $openCategoryFilter ? 'true' : 'false' }}">Categories</button>
                                </h2>
                                <div id="catCollapse" @class(['accordion-collapse', 'collapse', 'show' => $openCategoryFilter])>
                                    <div class="accordion-body filter-body">
                                        @foreach ($categories as $category)
                                            <div class="form-check filter-check">
                                                <input class="form-check-input" type="checkbox" id="cat{{ $category->id }}" name="categories[]" value="{{ $category->id }}" @checked(in_array($category->id, $selectedCategoryIds, true))>
                                                <label class="form-check-label" for="cat{{ $category->id }}">{{ $category->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item filter-accordion-item">
                                <h2 class="accordion-header">
                                    <button @class(['accordion-button', 'filter-btn', 'collapsed' => ! $openBrandFilter]) type="button" data-bs-toggle="collapse" data-bs-target="#brandCollapse" aria-expanded="{{ $openBrandFilter ? 'true' : 'false' }}">Brands</button>
                                </h2>
                                <div id="brandCollapse" @class(['accordion-collapse', 'collapse', 'show' => $openBrandFilter])>
                                    <div class="accordion-body filter-body">
                                        @foreach ($brands as $index => $brand)
                                            <div class="form-check filter-check">
                                                <input class="form-check-input" type="checkbox" id="brand{{ $index }}" name="brands[]" value="{{ $brand }}" @checked(in_array($brand, $selectedBrands, true))>
                                                <label class="form-check-label" for="brand{{ $index }}">{{ $brand }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item filter-accordion-item">
                                <h2 class="accordion-header">
                                    <button @class(['accordion-button', 'filter-btn', 'collapsed' => ! $openStatusFilter]) type="button" data-bs-toggle="collapse" data-bs-target="#statusCollapse" aria-expanded="{{ $openStatusFilter ? 'true' : 'false' }}">Status</button>
                                </h2>
                                <div id="statusCollapse" @class(['accordion-collapse', 'collapse', 'show' => $openStatusFilter])>
                                    <div class="accordion-body filter-body">
                                        @foreach ($statusOptions as $statusValue => $statusLabel)
                                            <div class="form-check filter-check">
                                                <input class="form-check-input" type="checkbox" id="status{{ $loop->index }}" name="statuses[]" value="{{ $statusValue }}" @checked(in_array($statusValue, $selectedStatuses, true))>
                                                <label class="form-check-label" for="status{{ $loop->index }}">{{ $statusLabel }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item filter-accordion-item border-bottom-0">
                                <h2 class="accordion-header">
                                    <button @class(['accordion-button', 'filter-btn', 'collapsed' => ! $openPriceFilter]) type="button" data-bs-toggle="collapse" data-bs-target="#priceCollapse" aria-expanded="{{ $openPriceFilter ? 'true' : 'false' }}">Price</button>
                                </h2>
                                <div id="priceCollapse" @class(['accordion-collapse', 'collapse', 'show' => $openPriceFilter])>
                                    <div class="accordion-body filter-body">
                                        <div class="d-flex gap-2 mb-3">
                                            <input type="number" class="form-control form-control-sm price-input" placeholder="Min EUR" name="min_price" value="{{ $minPrice ?? 0 }}" min="0">
                                            <span class="text-muted align-self-center">-</span>
                                            <input type="number" class="form-control form-control-sm price-input" placeholder="Max EUR" name="max_price" value="{{ $maxPrice ?? 5000 }}" min="0">
                                        </div>
                                        <div class="price-range-control" data-price-range>
                                            <div class="price-range-track"></div>
                                            <div class="price-range-fill" data-price-range-fill></div>
                                            <input type="range" class="price-range-input" min="0" max="5000" step="1" value="{{ $minPrice ?? 0 }}" id="priceMinRange" aria-label="Minimum price">
                                            <input type="range" class="price-range-input" min="0" max="5000" step="1" value="{{ $maxPrice ?? 5000 }}" id="priceMaxRange" aria-label="Maximum price">
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <small class="text-muted" data-price-min-label>{{ number_format((float) ($minPrice ?? 0), 0, ',', ' ') }} EUR</small>
                                            <small class="text-muted" data-price-max-label>{{ number_format((float) ($maxPrice ?? 5000), 0, ',', ' ') }} EUR</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary-brand w-100 mt-3 fw-600"><i class="bi bi-search me-2"></i>Apply Filters</button>
                        <a href="{{ route('products') }}" class="btn btn-clear-filters w-100 mt-2">Clear Filters</a>
                    </div>
                </form>
            </aside>

            <section id="products" class="col-lg-9 col-md-8">
                @include('partials.products-grid', ['products' => $products])
            </section>
        </div>
    </main>

    @include('partials.storefront-footer')
@endsection
