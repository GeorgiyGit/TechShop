@extends('layouts.storefront', ['title' => 'TechnoWorld - Products'])

@section('bodyClass', 'products-page')

@section('content')
    @include('partials.storefront-header')

    <main class="products-main">
        @if ($filters['search'])
            <div class="mb-3">
                <span class="text-muted">Search results for: </span>
                <strong>{{ $filters['search'] }}</strong>
                <a href="{{ route('products') }}" class="ms-2 small text-danger"><i class="bi bi-x-circle"></i> Clear</a>
            </div>
        @endif

        <div class="d-flex justify-content-start align-items-center mb-4 flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2">
                <label class="text-muted small me-1 text-nowrap" for="sort">Sort by</label>
                <select class="form-select form-select-sm" id="sort" name="sort" form="productsFiltersForm" style="min-width: 180px" onchange="this.form.submit()">
                    <option value="newest" @selected($filters['sort'] === 'newest')>New First</option>
                    <option value="price_asc" @selected($filters['sort'] === 'price_asc')>Low Price First</option>
                    <option value="price_desc" @selected($filters['sort'] === 'price_desc')>High Price First</option>
                    <option value="popular" @selected($filters['sort'] === 'popular')>Most Popular</option>
                </select>
            </div>
        </div>

        <div class="row g-4 align-items-start">
            <aside class="col-lg-3 col-md-4">
                <form id="productsFiltersForm" method="GET" action="{{ route('products') }}">
                    @if ($filters['search'])
                        <input type="hidden" name="search" value="{{ $filters['search'] }}">
                    @endif
                    <input type="hidden" name="price_changed" value="{{ $filters['price_changed'] ? '1' : '' }}">
                    <div class="filter-sidebar">
                        <h6 class="filter-sidebar-title"><i class="bi bi-sliders2 me-2"></i>Filters</h6>
                        <div class="accordion accordion-flush" id="filterAccordion">

                            {{-- Category --}}
                            <div class="accordion-item filter-accordion-item">
                                <h2 class="accordion-header">
                                    <button @class(['accordion-button', 'filter-btn', 'collapsed' => !$openCategoryFilter]) type="button" data-bs-toggle="collapse" data-bs-target="#catCollapse" aria-expanded="{{ $openCategoryFilter ? 'true' : 'false' }}">Category</button>
                                </h2>
                                <div id="catCollapse" @class(['accordion-collapse', 'collapse', 'show' => $openCategoryFilter])>
                                    <div class="accordion-body filter-body">
                                        @foreach ($categories as $category)
                                            <div class="form-check filter-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="cat{{ $category->id }}"
                                                    name="categories[]"
                                                    value="{{ $category->id }}"
                                                    @checked(in_array($category->id, $filters['categories'], true))
                                                    onchange="this.form.querySelector('[name=price_changed]').value=''; this.form.submit()">
                                                <label class="form-check-label" for="cat{{ $category->id }}">{{ $category->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Availability --}}
                            <div class="accordion-item filter-accordion-item">
                                <h2 class="accordion-header">
                                    <button @class(['accordion-button', 'filter-btn', 'collapsed' => !$openStockFilter]) type="button" data-bs-toggle="collapse" data-bs-target="#stockCollapse" aria-expanded="{{ $openStockFilter ? 'true' : 'false' }}">Availability</button>
                                </h2>
                                <div id="stockCollapse" @class(['accordion-collapse', 'collapse', 'show' => $openStockFilter])>
                                    <div class="accordion-body filter-body">
                                        @foreach ([
                                            'in_stock'    => ['label' => 'In Stock',    'icon' => 'bi-check-circle-fill text-success'],
                                            'low_stock'   => ['label' => 'Low Stock',   'icon' => 'bi-exclamation-circle-fill text-warning'],
                                            'unavailable' => ['label' => 'Unavailable', 'icon' => 'bi-x-circle-fill text-danger'],
                                        ] as $value => $option)
                                            <div class="form-check filter-check">
                                                <input class="form-check-input stock-status-check" type="checkbox"
                                                    id="stock_{{ $value }}"
                                                    name="stock_status"
                                                    value="{{ $value }}"
                                                    @checked($filters['stock_status'] === $value)>
                                                <label class="form-check-label d-flex align-items-center gap-1" for="stock_{{ $value }}">
                                                    <i class="bi {{ $option['icon'] }} small"></i>
                                                    {{ $option['label'] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Brands --}}
                            <div class="accordion-item filter-accordion-item">
                                <h2 class="accordion-header">
                                    <button @class(['accordion-button', 'filter-btn', 'collapsed' => !$openBrandFilter]) type="button" data-bs-toggle="collapse" data-bs-target="#brandCollapse" aria-expanded="{{ $openBrandFilter ? 'true' : 'false' }}">Brand</button>
                                </h2>
                                <div id="brandCollapse" @class(['accordion-collapse', 'collapse', 'show' => $openBrandFilter])>
                                    <div class="accordion-body filter-body">
                                        @forelse ($brands as $brand)
                                            <div class="form-check filter-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="brand{{ $brand->id }}"
                                                    name="brands[]"
                                                    value="{{ $brand->name }}"
                                                    @checked(in_array($brand->name, $filters['brands'], true))>
                                                <label class="form-check-label" for="brand{{ $brand->id }}">{{ $brand->name }}</label>
                                            </div>
                                        @empty
                                            <p class="text-muted small mb-0">No brands available.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="accordion-item filter-accordion-item border-bottom-0">
                                <h2 class="accordion-header">
                                    <button @class(['accordion-button', 'filter-btn', 'collapsed' => !$openPriceFilter]) type="button" data-bs-toggle="collapse" data-bs-target="#priceCollapse" aria-expanded="{{ $openPriceFilter ? 'true' : 'false' }}">Price</button>
                                </h2>
                                <div id="priceCollapse" @class(['accordion-collapse', 'collapse', 'show' => $openPriceFilter])>
                                    <div class="accordion-body filter-body">
                                        @php
                                            $priceMin = max($filters['min_price'] ?? $contextMinPrice, $contextMinPrice);
                                            $priceMax = min($filters['max_price'] ?? $contextMaxPrice, $contextMaxPrice);
                                        @endphp
                                        <div class="d-flex gap-2 mb-3">
                                            <input type="number" class="form-control form-control-sm price-input"
                                                placeholder="Min €"
                                                name="min_price"
                                                value="{{ $priceMin }}"
                                                min="{{ $contextMinPrice }}"
                                                max="{{ $contextMaxPrice }}"
                                                step="0.01">
                                            <span class="text-muted align-self-center">–</span>
                                            <input type="number" class="form-control form-control-sm price-input"
                                                placeholder="Max €"
                                                name="max_price"
                                                value="{{ $priceMax }}"
                                                min="{{ $contextMinPrice }}"
                                                max="{{ $contextMaxPrice }}"
                                                step="0.01">
                                        </div>
                                        <div class="price-range-control" data-price-range>
                                            <div class="price-range-track"></div>
                                            <div class="price-range-fill" data-price-range-fill></div>
                                            <input type="range" class="price-range-input"
                                                min="{{ $contextMinPrice }}"
                                                max="{{ $contextMaxPrice }}"
                                                step="1"
                                                value="{{ $priceMin }}"
                                                id="priceMinRange"
                                                aria-label="Minimum price">
                                            <input type="range" class="price-range-input"
                                                min="{{ $contextMinPrice }}"
                                                max="{{ $contextMaxPrice }}"
                                                step="1"
                                                value="{{ $priceMax }}"
                                                id="priceMaxRange"
                                                aria-label="Maximum price">
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <small class="text-muted" data-price-min-label>{{ number_format($priceMin, 0, ',', ' ') }} €</small>
                                            <small class="text-muted" data-price-max-label>{{ number_format($priceMax, 0, ',', ' ') }} €</small>
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
                @if ($products->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-search" style="font-size: 3rem; color: var(--text-muted);"></i>
                        <p class="fs-5 mt-3 text-muted">No products found.</p>
                        <a href="{{ route('products') }}" class="btn btn-primary-brand mt-2">Clear Filters</a>
                    </div>
                @else
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                        @foreach ($products as $product)
                            <div class="col">
                                <article class="product-card card h-100">
                                    <div class="product-img-wrap">
                                        @if ($product->firstImage)
                                            <img src="{{ url('/images/products/' . $product->firstImage->url) }}" class="product-img" alt="{{ $product->name }}">
                                        @else
                                            <div class="product-img d-flex align-items-center justify-content-center bg-light">
                                                <i class="bi bi-image text-muted fs-1"></i>
                                            </div>
                                        @endif
                                        @if (($product->stock_quantity ?? 0) <= 0)
                                            <span class="product-stock-badge out-of-stock">Out of Stock</span>
                                        @elseif (($product->stock_quantity ?? 0) <= 5)
                                            <span class="product-stock-badge low-stock">Only {{ $product->stock_quantity }} left</span>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column p-3">
                                        <small class="text-muted">{{ $product->brand?->name }}</small>
                                        <h6 class="card-title mt-1">{{ $product->name }}</h6>
                                        <a href="{{ route('product.show', $product) }}" class="stretched-link" aria-label="Open {{ $product->name }}"></a>
                                        <p class="card-text text-muted">{{ $product->short_description }}</p>
                                        <div class="d-flex justify-content-between align-items-center pt-2 mt-auto">
                                            <span class="product-price">{{ number_format((float) $product->price, 2) }} €</span>
                                            <div class="product-card-action">
                                                @if (($product->stock_quantity ?? 0) <= 0)
                                                    <button type="button" class="btn btn-add-cart btn-sm" disabled>
                                                        <i class="bi bi-cart-x me-1"></i>Unavailable
                                                    </button>
                                                @else
                                                    <form method="POST" action="{{ route('cart.add') }}">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button type="submit" class="btn btn-add-cart btn-sm">
                                                            <i class="bi bi-cart-plus me-1"></i>Add
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            </section>
        </div>
    </main>

    @include('partials.storefront-footer')
@endsection

@push('scripts')
<script>
document.querySelectorAll('.stock-status-check').forEach(cb => {
    cb.addEventListener('change', function () {
        document.querySelectorAll('.stock-status-check').forEach(other => {
            if (other !== this) other.checked = false;
        });
    });
});
</script>
@endpush
