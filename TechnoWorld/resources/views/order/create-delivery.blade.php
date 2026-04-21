@extends('layouts.storefront', [
    'title' => 'TechnoWorld - Delivery Method',
    'vite' => ['resources/css/create-order.css'],
])

@section('bodyClass', 'products-page')

@section('content')
    @include('partials.storefront-header')

    @php($isPickup = $activeDeliveryMethod === 'pickup')

    <main class="create-order-main">
        <section class="create-order-section">
            <h1 class="create-order-title">Create Order</h1>

            @include('order.partials.stepper', ['currentStep' => 3])

            <h2 class="step-heading">{{ $isPickup ? 'Store Pickup' : 'Delivery Method' }}</h2>

            @if ($errors->any())
                <div class="alert alert-danger py-2" role="alert">
                    Please provide all required delivery information.
                </div>
            @endif

            <form class="create-order-form" action="{{ route('order.create.delivery.store') }}" method="post">
                @csrf

                <div class="delivery-method-group" role="radiogroup" aria-label="Delivery method">
                    <a href="{{ route('order.create.delivery') }}" @class(['delivery-method-card', 'selected' => ! $isPickup])>
                        <span class="delivery-method-icon"><i class="bi bi-truck"></i></span>
                        <span class="delivery-method-info">
                            <span class="delivery-method-name">Courier Delivery</span>
                            <span class="delivery-method-desc">Delivered to your door in 2-5 business days</span>
                        </span>
                        <span class="delivery-method-price">10.00 &euro;</span>
                    </a>

                    <a href="{{ route('order.create.pickup') }}" @class(['delivery-method-card', 'selected' => $isPickup])>
                        <span class="delivery-method-icon"><i class="bi bi-shop"></i></span>
                        <span class="delivery-method-info">
                            <span class="delivery-method-name">Store Pickup</span>
                            <span class="delivery-method-desc">Pick up from our store, ready in 1-2 days</span>
                        </span>
                        <span class="delivery-method-price">Free</span>
                    </a>
                </div>

                @if ($isPickup)
                    <input type="hidden" name="delivery_method" value="pickup">

                    <h3 class="step-subheading">Shipping Address</h3>

                    <div class="step-form-grid" aria-label="Store address details">
                        <div class="form-field">
                            <label class="form-field-label">Country</label>
                            <div class="create-order-readonly">{{ $delivery['country'] }}</div>
                        </div>
                        <div class="form-field">
                            <label class="form-field-label">City</label>
                            <div class="create-order-readonly">{{ $delivery['city'] }}</div>
                        </div>
                        <div class="form-field full-width">
                            <label class="form-field-label">Street</label>
                            <div class="create-order-readonly">{{ $delivery['street'] }}</div>
                        </div>
                        <div class="form-field">
                            <label class="form-field-label">House Number</label>
                            <div class="create-order-readonly">{{ $delivery['house_number'] }}</div>
                        </div>
                        <div class="form-field">
                            <label class="form-field-label">Post Code</label>
                            <div class="create-order-readonly">{{ $delivery['post_code'] }}</div>
                        </div>
                    </div>
                @else
                    <input type="hidden" name="delivery_method" value="courier">

                    <h3 class="step-subheading">Shipping Address</h3>

                    <div class="step-form-grid">
                        <div class="form-field">
                            <label class="form-field-label" for="addr-country">Country</label>
                            <input class="create-order-input" type="text" id="addr-country" name="country" placeholder="e.g. Slovakia" value="{{ old('country', $delivery['country'] ?? '') }}" required>
                        </div>
                        <div class="form-field">
                            <label class="form-field-label" for="addr-city">City</label>
                            <input class="create-order-input" type="text" id="addr-city" name="city" placeholder="e.g. Bratislava" value="{{ old('city', $delivery['city'] ?? '') }}" required>
                        </div>
                        <div class="form-field full-width">
                            <label class="form-field-label" for="addr-street">Street</label>
                            <input class="create-order-input" type="text" id="addr-street" name="street" placeholder="e.g. Stare Grunty, Karlova Ves" value="{{ old('street', $delivery['street'] ?? '') }}" required>
                        </div>
                        <div class="form-field">
                            <label class="form-field-label" for="addr-house">House Number</label>
                            <input class="create-order-input" type="text" id="addr-house" name="house_number" placeholder="e.g. 53" value="{{ old('house_number', $delivery['house_number'] ?? '') }}" required>
                        </div>
                        <div class="form-field">
                            <label class="form-field-label" for="addr-postcode">Post Code</label>
                            <input class="create-order-input" type="text" id="addr-postcode" name="post_code" placeholder="e.g. 841 04" value="{{ old('post_code', $delivery['post_code'] ?? '') }}" required>
                        </div>
                    </div>
                @endif

                <div class="step-nav">
                    <a href="{{ route('order.create.contact') }}" class="step-btn step-btn-prev">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="step-btn step-btn-next">
                        Continue <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </form>
        </section>
    </main>

    @include('partials.storefront-footer')
@endsection
