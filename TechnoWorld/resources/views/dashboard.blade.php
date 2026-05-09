@extends('layouts.storefront')

@php $title = 'My Account'; @endphp
@php $vite = ['resources/css/account.css']; @endphp

@section('bodyClass', 'products-page')

@section('content')
    @include('partials.storefront-header')

    <main class="account-main">
        <section class="account-section container py-5">
            <h1 class="account-title">Account Information</h1>

            @if ($orders->isEmpty())
                <div class="account-empty">
                    <i class="bi bi-bag-x"></i>
                    <p class="fs-5">You haven't placed any orders yet.</p>
                    <a href="{{ route('products') }}" class="btn btn-primary-brand fw-600 mt-3">Browse Products</a>
                </div>
            @else
                <div class="account-orders-list">
                    @foreach ($orders as $order)
                        <div class="account-order-card">
                            <div class="account-order-info">
                                <div class="account-order-topline">
                                    <h2 class="account-order-code">#{{ substr($order->id, -8) }}</h2>
                                    <p class="account-order-status">
                                        <span class="order-status-badge order-status-{{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </p>
                                </div>
                                <p class="account-order-date">
                                    Purchased on {{ \Carbon\Carbon::parse($order->created_at)->format('F d, Y') }}
                                </p>
                                @if ($order->payment)
                                    <p class="account-order-payment text-muted small">
                                        {{ ucfirst(str_replace('_', ' ', $order->payment->payment_method)) }}
                                    </p>
                                @endif
                                @if ($order->address)
                                    <p class="account-order-address text-muted small">
                                        {{ $order->address->city }}, {{ $order->address->country }}
                                    </p>
                                @else
                                    <p class="account-order-address text-muted small">Store Pickup</p>
                                @endif
                            </div>
                            <div class="account-order-actions">
                                <div class="account-order-total-wrap">
                                    <p class="account-order-total-label">Total Price</p>
                                    <p class="account-order-total-value">€{{ number_format($order->total_price, 2) }}</p>
                                </div>
                                <a href="{{ route('order.show', $order) }}" class="account-order-details-btn">
                                    Order details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </section>
    </main>

    @include('partials.storefront-footer')
@endsection
