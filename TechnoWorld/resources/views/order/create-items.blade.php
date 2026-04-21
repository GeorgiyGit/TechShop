@extends('layouts.storefront', [
    'title' => 'TechnoWorld - Review Items',
    'vite' => ['resources/css/create-order.css'],
])

@section('bodyClass', 'products-page')

@section('content')
    @include('partials.storefront-header')

    <main class="create-order-main">
        <section class="create-order-section">
            <h1 class="create-order-title">Create Order</h1>

            @include('order.partials.stepper', ['currentStep' => 1])

            <h2 class="step-heading">Review Your Items</h2>

            <div class="create-order-items-list">
                @foreach ($cart->items as $item)
                    <article class="create-order-item-card">
                        <img src="{{ $item->product->firstImage ? url('/images/products/' . $item->product->firstImage->image_path) : '' }}" alt="{{ $item->product->name }}" class="create-order-item-image">
                        <div class="create-order-item-content">
                            <div class="create-order-item-top">
                                <h3 class="create-order-item-name">{{ $item->product->brand }} {{ $item->product->name }}</h3>
                                <p class="create-order-item-total">{{ number_format((float) $item->product->price * $item->quantity, 2) }} &euro;</p>
                            </div>
                            <div class="create-order-item-bottom">
                                <p class="create-order-item-math">{{ $item->quantity }} x {{ number_format((float) $item->product->price, 2) }} &euro;</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="step-summary-bar">
                <div class="create-order-row"><span>Subtotal ({{ $itemsCount }} items)</span><span class="create-order-dots"></span><span>{{ number_format((float) $subtotal, 2) }} &euro;</span></div>
            </div>

            <div class="step-nav">
                <a href="{{ route('cart.index') }}" class="step-btn step-btn-prev">
                    <i class="bi bi-arrow-left"></i> Back to Cart
                </a>
                <a href="{{ route('order.create.contact') }}" class="step-btn step-btn-next">
                    Continue <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </section>
    </main>

    @include('partials.storefront-footer')
@endsection
