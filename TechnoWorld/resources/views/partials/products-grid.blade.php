@if ($products->isNotEmpty())
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-3">
        @foreach ($products as $product)
            <div class="col">
                <article class="product-card card h-100">
                    <div class="product-img-wrap">
                        <img src="{{ url('/images/products/' . ltrim($product->image_path, '/')) }}" alt="{{ $product->name }}" class="product-img">
                        @if (($product->stock_left ?? 0) <= 0)
                            <span class="product-stock-badge out-of-stock">Out of Stock</span>
                        @elseif (($product->stock_left ?? 0) <= 5)
                            <span class="product-stock-badge low-stock">Only {{ $product->stock_left }} left</span>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column p-3">
                        <small class="text-muted">{{ $product->brand }}</small>
                        <h6 class="card-title mt-1">{{ $product->name }}</h6>
                        <p class="card-text text-muted">{{ $product->description }}</p>
                        <div class="d-flex justify-content-between align-items-center pt-2 mt-auto">
                            <span class="product-price">{{ number_format((float) $product->price, 2) }} EUR</span>
                            @if (($product->stock_left ?? 0) <= 0)
                                <button type="button" class="btn btn-add-cart btn-sm" disabled>
                                    <i class="bi bi-cart-x me-1"></i>Unavailable
                                </button>
                            @else
                                @auth
                                    <button type="button" class="btn btn-add-cart btn-sm"><i class="bi bi-cart-plus me-1"></i>Add</button>
                                @else
                                    <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-add-cart btn-sm"><i class="bi bi-cart-plus me-1"></i>Add</a>
                                @endauth
                            @endif
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-light border text-muted mb-0" role="status">
        No products match the selected filters.
    </div>
@endif