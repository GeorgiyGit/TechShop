@extends('layouts.storefront', ['title' => 'TechnoWorld - ' . $product->name])

@section('bodyClass', 'products-page')

@section('content')
    @include('partials.storefront-header')

    <main class="px-3 px-md-4 px-lg-5 py-3 py-md-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="blue-text text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products') }}" class="blue-text text-decoration-none">Products</a></li>
                @if ($product->category)
                    <li class="breadcrumb-item">
                        <a href="{{ route('products', ['categories' => [$product->category_id]]) }}" class="blue-text text-decoration-none">{{ $product->category->name }}</a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <section class="product-detail-hero row g-4 mb-5">
            <div class="col-12 col-md-6 d-flex gap-3">
                <div class="d-flex flex-column gap-2" style="width: 80px;">
                    <button class="btn btn-light p-0 border"><i class="bi bi-chevron-up"></i></button>
                    <img src="{{ url('/images/products/' . ltrim($product->image_path, '/')) }}" class="gallery-thumb active border rounded" alt="{{ $product->name }}">
                    <button class="btn btn-light p-0 border"><i class="bi bi-chevron-down"></i></button>
                </div>
                <div class="flex-grow-1 border rounded bg-white d-flex align-items-center justify-content-center p-4">
                    <img src="{{ url('/images/products/' . ltrim($product->image_path, '/')) }}" class="img-fluid product-main-image" alt="{{ $product->name }}">
                </div>
            </div>

            <div class="col-12 col-md-6 d-flex flex-column" style="padding: 30px;">
                <h1 class="fw-bold mb-2">{{ $product->name }}</h1>
                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                    <a href="{{ route('products', ['brands' => [$product->brand]]) }}" class="product-detail-tag">
                        {{ $product->brand }}
                    </a>
                    @if ($product->category)
                        <a href="{{ route('products', ['categories' => [$product->category_id]]) }}" class="product-detail-tag">
                            <i class="bi bi-grid me-1"></i>{{ $product->category->name }}
                        </a>
                    @endif
                </div>
                <p class="text-muted fs-5 mb-4">Code: #{{ $product->id }}</p>

                <div class="flex-grow-1">
                    <p class="fs-5 mb-4 text-dark">{{ $product->description }}</p>
                </div>

                <div class="product-detail-action d-flex align-items-center justify-content-between mt-auto pt-4">
                    <span class="display-5 fw-bold mb-0">{{ number_format((float) $product->price, 2) }} €</span>
                    <div class="d-flex align-items-center gap-3">
                        @if (($product->stock_left ?? 0) <= 0)
                            <span class="badge bg-danger fs-6 px-3 py-2">Out of Stock</span>
                        @else
                            <div class="product-item-qty">
                                <button class="product-qty-btn" aria-label="Decrease quantity">&#8722;</button>
                                <input type="number" class="product-qty-value" value="1" min="1" max="{{ $product->stock_left }}" aria-label="Quantity">
                                <button class="product-qty-btn" aria-label="Increase quantity">+</button>
                            </div>
                            @auth
                                <button type="button" class="btn btn-primary-brand btn-lg px-5 py-3 fw-600 fs-5 d-flex align-items-center gap-2">
                                    Add to cart
                                </button>
                            @else
                                <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-primary-brand btn-lg px-5 py-3 fw-600 fs-5 d-flex align-items-center gap-2">
                                    Add to cart
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @if ($product->description)
            <section class="mb-5">
                <h2 class="text-center fw-bold mb-4">Detailed description</h2>
                <div class="fs-5 lh-lg text-dark">
                    <p>{{ $product->description }}</p>
                </div>
            </section>
        @endif

        @if ($product->characteristics->isNotEmpty())
            <section class="mb-5">
                <h2 class="text-center fw-bold mb-4">Characteristics</h2>
                <div class="table-responsive bg-transparent">
                    <table class="table table-bordered table-transparent mb-0 align-middle border-dark" style="background-color: transparent; --bs-table-bg: transparent; --bs-table-border-color: #000;">
                        <tbody>
                            @foreach ($product->characteristics as $characteristic)
                                <tr>
                                    <th class="w-50 p-3 fs-5" style="background-color: transparent; border-color: #000;">{{ $characteristic->name }}</th>
                                    <td class="w-50 p-3 fs-5" style="background-color: transparent; border-color: #000;">{{ $characteristic->value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        @endif

        @if ($similarProducts->isNotEmpty())
            <section class="mb-5">
                <h2 class="text-center fw-bold mb-4">Similar products</h2>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-5 g-3">
                    @foreach ($similarProducts as $similar)
                        <div class="col">
                            <article class="product-card card h-100">
                                <div class="product-img-wrap">
                                    <img src="{{ url('/images/products/' . ltrim($similar->image_path, '/')) }}" class="product-img" alt="{{ $similar->name }}">
                                    @if (($similar->stock_left ?? 0) <= 0)
                                        <span class="product-stock-badge out-of-stock">Out of Stock</span>
                                    @elseif (($similar->stock_left ?? 0) <= 5)
                                        <span class="product-stock-badge low-stock">Only {{ $similar->stock_left }} left</span>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column p-3">
                                    <small class="text-muted">{{ $similar->brand }}</small>
                                    <h6 class="card-title mt-1">{{ $similar->name }}</h6>
                                    <a href="{{ route('product.show', $similar->slug) }}" class="stretched-link" aria-label="Open {{ $similar->name }}"></a>
                                    <p class="card-text text-muted">{{ $similar->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center pt-2 mt-auto">
                                        <span class="product-price">{{ number_format((float) $similar->price, 2) }} €</span>
                                        @if (($similar->stock_left ?? 0) <= 0)
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
            </section>
        @endif
    </main>

    @include('partials.storefront-footer')
@endsection
