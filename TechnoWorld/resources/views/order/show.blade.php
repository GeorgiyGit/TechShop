@extends('layouts.storefront', [
    'title' => 'TechnoWorld - Order #' . substr($order->id, -8),
    'vite' => ['resources/css/order.css'],
])

@section('bodyClass', 'products-page')

@section('content')
    @include('partials.storefront-header')

    <main class="order-main">
        <section class="order-section container-fluid px-0">
            <h1 class="order-title">Order #{{ substr($order->id, -8) }}</h1>

            <div class="order-layout">
                <div class="order-items-list">
                    @foreach ($order->items as $item)
                        <article class="order-item-card">
                            @if ($item->product?->firstImage)
                                <img src="{{ url('/images/products/' . $item->product->firstImage->url) }}"
                                    alt="{{ $item->product->name }}"
                                    class="order-item-image">
                            @else
                                <div class="order-item-image d-flex align-items-center justify-content-center bg-light">
                                    <i class="bi bi-image text-muted fs-3"></i>
                                </div>
                            @endif
                            <div class="order-item-content">
                                <div class="order-item-top">
                                    <h2 class="order-item-name">
                                        {{ $item->product?->brand?->name }} {{ $item->product?->name ?? 'Product removed' }}
                                    </h2>
                                    <p class="order-item-total">{{ number_format((float) $item->unit_price * $item->quantity, 2) }} &euro;</p>
                                </div>
                                <p class="order-item-math">{{ $item->quantity }} &times; {{ number_format((float) $item->unit_price, 2) }} &euro;</p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <aside class="order-details-panel" aria-label="Order details">
                    <h2 class="order-details-title">Order details</h2>

                    <div class="order-details-group">
                        <h3 class="order-details-group-title">Delivery</h3>
                        <div class="order-detail-row">
                            <span>Type</span>
                            <span class="order-detail-dots"></span>
                            <span>{{ $order->delivery_method === 'pickup' ? 'Store Pickup' : 'Courier' }}</span>
                        </div>
                        @if ($order->address)
                            <div class="order-detail-row">
                                <span>Country</span>
                                <span class="order-detail-dots"></span>
                                <span>{{ $order->address->country }}</span>
                            </div>
                            <div class="order-detail-row">
                                <span>City</span>
                                <span class="order-detail-dots"></span>
                                <span>{{ $order->address->city }}</span>
                            </div>
                            <div class="order-detail-row">
                                <span>Street</span>
                                <span class="order-detail-dots"></span>
                                <span>{{ $order->address->street }}</span>
                            </div>
                            <div class="order-detail-row">
                                <span>House</span>
                                <span class="order-detail-dots"></span>
                                <span>{{ $order->address->house_number }}</span>
                            </div>
                            <div class="order-detail-row">
                                <span>Post code</span>
                                <span class="order-detail-dots"></span>
                                <span>{{ $order->address->postal_code }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="order-details-group order-details-summary">
                        <div class="order-detail-row">
                            <span>Items</span>
                            <span class="order-detail-dots"></span>
                            <span>{{ $order->items->sum('quantity') }}</span>
                        </div>
                        @if ($order->payment)
                            <div class="order-detail-row">
                                <span>Payment</span>
                                <span class="order-detail-dots"></span>
                                <span>{{ ucfirst(str_replace('_', ' ', $order->payment->payment_method)) }}</span>
                            </div>
                        @endif
                        <div class="order-detail-row">
                            <span>Total price</span>
                            <span class="order-detail-dots"></span>
                            <span>{{ number_format((float) $order->total_price, 2) }} &euro;</span>
                        </div>
                        <div class="order-detail-row">
                            <span>Status</span>
                            <span class="order-detail-dots"></span>
                            <span>{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('account') }}" class="step-btn step-btn-prev w-100 d-flex justify-content-center mt-3">
                        <i class="bi bi-arrow-left me-2"></i> Back to My Orders
                    </a>
                </aside>
            </div>
        </section>
    </main>

    @include('partials.storefront-footer')
@endsection
