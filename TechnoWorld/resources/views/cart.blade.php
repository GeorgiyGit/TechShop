@extends('layouts.storefront', [
    'title' => 'TechnoWorld - Shopping Cart',
    'vite' => ['resources/css/cart.css'],
])

@section('bodyClass', 'products-page')

@section('content')
    @include('partials.storefront-header')

    <main class="cart-main">
        <section class="cart-section container-fluid px-0">
            <h1 class="cart-title">Shopping Cart</h1>

            @if ($cart && $cart->items->isNotEmpty())
                <div class="cart-layout">
                    <div class="cart-items-list">
                        @foreach ($cart->items as $item)
                            <article class="cart-item-card">
                                <a href="{{ route('product.show', $item->product->slug) }}">
                                    <img src="{{ $item->product->firstImage ? url('/images/products/' . $item->product->firstImage->image_path) : '' }}" alt="{{ $item->product->name }}" class="cart-item-image">
                                </a>
                                <div class="cart-item-content">
                                    <div class="cart-item-top">
                                        <h2 class="cart-item-name">
                                            <a href="{{ route('product.show', $item->product->slug) }}" class="text-decoration-none text-dark">
                                                {{ $item->product->brand }} {{ $item->product->name }}
                                            </a>
                                        </h2>
                                        <p class="cart-item-price">{{ number_format((float) $item->product->price, 2) }} €</p>
                                    </div>
                                    <div class="cart-item-bottom">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="cart-item-qty-form">
                                            @csrf
                                            @method('PATCH')
                                            <div class="cart-item-qty" role="group" aria-label="Item quantity">
                                                <button class="cart-qty-btn" type="button" aria-label="Decrease quantity"
                                                    onclick="const i=this.parentNode.querySelector('input[name=quantity]');if(i.value>1){i.stepDown();i.form.requestSubmit();}">&#8722;</button>
                                                <input type="number" class="cart-qty-value" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_left }}" aria-label="Quantity"
                                                    onchange="this.form.requestSubmit()">
                                                <button class="cart-qty-btn" type="button" aria-label="Increase quantity"
                                                    onclick="const i=this.parentNode.querySelector('input[name=quantity]');i.stepUp();i.form.requestSubmit();">+</button>
                                            </div>
                                        </form>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="cart-remove-btn" type="submit">
                                                <i class="bi bi-trash"></i>
                                                <span>Remove</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <aside class="cart-summary-panel" aria-label="Order summary">
                        <h2 class="cart-summary-title">Shopping Cart</h2>
                        <div class="cart-summary-row">
                            <span>Items</span>
                            <span class="cart-summary-dots" aria-hidden="true"></span>
                            <span>{{ $cart->items->sum('quantity') }}</span>
                        </div>
                        <div class="cart-summary-row">
                            <span>Total</span>
                            <span class="cart-summary-dots" aria-hidden="true"></span>
                            <span>{{ number_format($cart->items->sum(fn ($item) => $item->quantity * $item->product->price), 2) }} €</span>
                        </div>
                        <a href="{{ route('home') }}" class="cart-create-order-btn">Create Order</a>
                    </aside>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-cart-x" style="font-size: 4rem; color: var(--text-muted);"></i>
                    <p class="fs-4 mt-3 text-muted">Your cart is empty</p>
                    <a href="{{ route('products') }}" class="btn btn-primary-brand btn-lg px-5 mt-2">Browse Products</a>
                </div>
            @endif
        </section>
    </main>

    @include('partials.storefront-footer')
@endsection
