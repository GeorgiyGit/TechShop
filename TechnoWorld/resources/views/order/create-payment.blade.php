@extends('layouts.storefront', [
    'title' => 'TechnoWorld - Payment',
    'vite' => ['resources/css/create-order.css', 'resources/js/create-order-payment.js'],
])

@section('bodyClass', 'products-page')

@section('content')
    @include('partials.storefront-header')

    @php($selectedMethod = old('payment_method', 'card'))

    <main class="create-order-main">
        <section class="create-order-section">
            <h1 class="create-order-title">Create Order</h1>

            @include('order.partials.stepper', ['currentStep' => 4])

            <h2 class="step-heading">Payment &amp; Confirmation</h2>

            @if ($errors->any())
                <div class="alert alert-danger py-2" role="alert">
                    {{ $errors->first('cart') ?? 'Please select a valid payment method.' }}
                </div>
            @endif

            <form class="create-order-form" action="{{ route('order.create.store') }}" method="post">
                @csrf

                <div class="payment-method-group" role="radiogroup" aria-label="Payment method">
                    <label @class(['payment-method-card', 'selected' => $selectedMethod === 'card'])>
                        <input type="radio" name="payment_method" value="card" class="visually-hidden" {{ $selectedMethod === 'card' ? 'checked' : '' }}>
                        <span class="payment-method-icon"><i class="bi bi-credit-card"></i></span>
                        <span class="payment-method-name">Credit / Debit Card</span>
                    </label>

                    <label @class(['payment-method-card', 'selected' => $selectedMethod === 'google_pay'])>
                        <input type="radio" name="payment_method" value="google_pay" class="visually-hidden" {{ $selectedMethod === 'google_pay' ? 'checked' : '' }}>
                        <span class="payment-method-icon"><i class="bi bi-google"></i></span>
                        <span class="payment-method-name">Google Pay</span>
                    </label>

                    <label @class(['payment-method-card', 'selected' => $selectedMethod === 'cash'])>
                        <input type="radio" name="payment_method" value="cash" class="visually-hidden" {{ $selectedMethod === 'cash' ? 'checked' : '' }}>
                        <span class="payment-method-icon"><i class="bi bi-cash-stack"></i></span>
                        <span class="payment-method-name">Cash on Delivery / Pickup</span>
                    </label>
                </div>

                <div class="order-confirm-summary">
                    <h3 class="step-subheading">Order Summary</h3>
                    <div class="create-order-row"><span>Items ({{ $itemsCount }})</span><span class="create-order-dots"></span><span>{{ number_format((float) $subtotal, 2) }} &euro;</span></div>
                    <div class="create-order-row total-row"><span>Total</span><span class="create-order-dots"></span><span>{{ number_format((float) $subtotal, 2) }} &euro;</span></div>
                </div>

                <div class="step-nav">
                    <a href="{{ route('order.create.delivery') }}" class="step-btn step-btn-prev">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="step-btn step-btn-submit" data-payment-submit>
                        <i class="bi bi-check-lg"></i> <span data-payment-submit-label>Pay for Order</span>
                    </button>
                </div>
            </form>
        </section>
    </main>

    @include('partials.storefront-footer')
@endsection
