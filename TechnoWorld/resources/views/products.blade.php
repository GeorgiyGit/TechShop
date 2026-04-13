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
        <form id="productsFiltersForm" method="GET" action="{{ route('products') }}">
            <div class="d-flex justify-content-start align-items-center mb-4 flex-wrap gap-3">
                <div class="d-flex align-items-center gap-2">
                    <label class="text-muted small me-1 text-nowrap" for="orderBy">Order by</label>
                    <select class="form-select form-select-sm select-brand" id="orderBy" name="orderBy" style="min-width: 180px">
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
                    <button type="button" class="btn btn-clear-filters w-100 mt-2" id="clearFiltersButton">Clear Filters</button>
                </div>
            </aside>

            <section id="products" class="col-lg-9 col-md-8">
                <div id="productsGridContainer">
                    @include('partials.products-grid', ['products' => $products])
                </div>
            </section>
            </div>
        </form>
    </main>

    @include('partials.storefront-footer')

    <script>
        (() => {
            const form = document.getElementById('productsFiltersForm');
            const select = document.getElementById('orderBy');
            const gridContainer = document.getElementById('productsGridContainer');
            const clearButton = document.getElementById('clearFiltersButton');
            const minPriceInput = form?.querySelector('input[name="min_price"]');
            const maxPriceInput = form?.querySelector('input[name="max_price"]');
            const priceMinRange = document.getElementById('priceMinRange');
            const priceMaxRange = document.getElementById('priceMaxRange');
            const priceRangeFill = document.querySelector('[data-price-range-fill]');
            const priceMinLabel = document.querySelector('[data-price-min-label]');
            const priceMaxLabel = document.querySelector('[data-price-max-label]');

            if (!form || !select || !gridContainer) {
                return;
            }

            let activeRequest = null;

            const updatePriceRangeFill = () => {
                if (!priceMinRange || !priceMaxRange || !priceRangeFill) {
                    return;
                }

                const min = Number(priceMinRange.min);
                const max = Number(priceMinRange.max);
                const left = Math.min(Number(priceMinRange.value), Number(priceMaxRange.value));
                const right = Math.max(Number(priceMinRange.value), Number(priceMaxRange.value));
                const leftPercent = ((left - min) / (max - min)) * 100;
                const rightPercent = ((right - min) / (max - min)) * 100;

                priceRangeFill.style.left = `${leftPercent}%`;
                priceRangeFill.style.width = `${rightPercent - leftPercent}%`;

                if (priceMinLabel) {
                    priceMinLabel.textContent = `${left.toLocaleString('en-US')} EUR`;
                }

                if (priceMaxLabel) {
                    priceMaxLabel.textContent = `${right.toLocaleString('en-US')} EUR`;
                }
            };

            const syncPriceInputs = () => {
                if (!priceMinRange || !priceMaxRange || !minPriceInput || !maxPriceInput) {
                    return;
                }

                let left = Number(priceMinRange.value);
                let right = Number(priceMaxRange.value);

                if (left > right) {
                    [left, right] = [right, left];
                }

                minPriceInput.value = String(left);
                maxPriceInput.value = String(right);

                updatePriceRangeFill();
            };

            const buildUrl = () => {
                const url = new URL(form.action, window.location.origin);
                const formData = new FormData(form);

                for (const [key, value] of formData.entries()) {
                    url.searchParams.append(key, String(value));
                }

                return { url, formData };
            };

            const updateProductsGrid = async () => {
                const { url, formData } = buildUrl();

                url.searchParams.set('partial', '1');

                if (activeRequest) {
                    activeRequest.abort();
                }

                activeRequest = new AbortController();

                try {
                    const response = await fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        signal: activeRequest.signal,
                    });

                    if (!response.ok) {
                        throw new Error('Failed to load products');
                    }

                    const html = await response.text();
                    gridContainer.innerHTML = html;

                    const publicUrl = new URL(form.action, window.location.origin);
                    for (const [key, value] of formData.entries()) {
                        publicUrl.searchParams.append(key, String(value));
                    }

                    window.history.replaceState({}, '', publicUrl.toString());
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        form.submit();
                    }
                }
            };

            form.addEventListener('submit', (event) => {
                syncPriceInputs();
                event.preventDefault();
                updateProductsGrid();
            });

            if (priceMinRange) {
                priceMinRange.addEventListener('input', () => {
                    if (priceMaxRange && Number(priceMinRange.value) > Number(priceMaxRange.value)) {
                        priceMaxRange.value = priceMinRange.value;
                    }

                    syncPriceInputs();
                });
            }

            if (priceMaxRange) {
                priceMaxRange.addEventListener('input', () => {
                    if (priceMinRange && Number(priceMaxRange.value) < Number(priceMinRange.value)) {
                        priceMinRange.value = priceMaxRange.value;
                    }

                    syncPriceInputs();
                });
            }

            if (minPriceInput) {
                minPriceInput.addEventListener('input', () => {
                    if (priceMinRange) {
                        priceMinRange.value = minPriceInput.value || '0';
                    }

                    syncPriceInputs();
                });
            }

            if (maxPriceInput) {
                maxPriceInput.addEventListener('input', () => {
                    if (priceMaxRange) {
                        priceMaxRange.value = maxPriceInput.value || priceMaxRange.max;
                    }

                    syncPriceInputs();
                });
            }

            if (clearButton) {
                clearButton.addEventListener('click', () => {
                    form.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
                        checkbox.checked = false;
                    });

                    if (minPriceInput) {
                        minPriceInput.value = '0';
                    }

                    if (maxPriceInput) {
                        maxPriceInput.value = '5000';
                    }

                    if (priceMinRange) {
                        priceMinRange.value = '0';
                    }

                    if (priceMaxRange) {
                        priceMaxRange.value = '5000';
                    }

                    select.value = 'relevance';
                    syncPriceInputs();
                    updateProductsGrid();
                });
            }

            syncPriceInputs();
        })();
    </script>
@endsection
