@extends('layouts.storefront', [
    'title' => 'TechnoWorld - Order Placed',
    'vite' => ['resources/css/create-order.css'],
])

@section('bodyClass', 'products-page')

@section('content')
    @include('partials.storefront-header')

    <main class="create-order-main">
        <section class="create-order-section">
            <div class="success-card">
                <div class="success-icon-circle">
                    <i class="bi bi-check-lg"></i>
                </div>
                <h1 class="success-title">Order Placed Successfully!</h1>
                <p class="success-order-id">Order #{{ substr($order->id, -8) }}</p>
                <p class="success-message">Thank you for your purchase. You can track your order status anytime from your account.</p>

                <div class="success-summary">
                    <div class="create-order-row"><span>Items</span><span class="create-order-dots"></span><span>{{ $order->items->sum('quantity') }}</span></div>
                    <div class="create-order-row"><span>Total</span><span class="create-order-dots"></span><span>{{ number_format((float) $order->total_price, 2) }} &euro;</span></div>
                    @if ($order->payment)
                        <div class="create-order-row"><span>Payment</span><span class="create-order-dots"></span><span>{{ ucfirst(str_replace('_', ' ', $order->payment->payment_method)) }}</span></div>
                    @endif
                    <div class="create-order-row"><span>Delivery</span><span class="create-order-dots"></span><span>{{ $order->delivery_method === 'pickup' ? 'Store Pickup' : 'Courier' }}</span></div>
                    @if ($order->address)
                        <div class="create-order-row"><span>Address</span><span class="create-order-dots"></span><span>{{ $order->address->city }}, {{ $order->address->street }} {{ $order->address->house_number }}</span></div>
                    @endif
                </div>

                <div class="success-actions">
                    <a href="{{ route('dashboard') }}" class="step-btn step-btn-next">
                        <i class="bi bi-receipt"></i> View My Orders
                    </a>
                    <a href="{{ route('home') }}" class="step-btn step-btn-prev">
                        <i class="bi bi-house"></i> Back to Home
                    </a>
                </div>
            </div>
        </section>
    </main>

    @include('partials.storefront-footer')
@endsection
