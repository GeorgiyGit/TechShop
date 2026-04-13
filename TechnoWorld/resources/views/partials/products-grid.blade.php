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