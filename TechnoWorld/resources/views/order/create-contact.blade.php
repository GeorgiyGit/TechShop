@extends('layouts.storefront', [
    'title' => 'TechnoWorld - Contact Information',
    'vite' => ['resources/css/create-order.css'],
])

@section('bodyClass', 'products-page')

@section('content')
    @include('partials.storefront-header')

    <main class="create-order-main">
        <section class="create-order-section">
            <h1 class="create-order-title">Create Order</h1>

            @include('order.partials.stepper', ['currentStep' => 2])

            <h2 class="step-heading">Contact Information</h2>

            @if ($errors->any())
                <div class="alert alert-danger py-2" role="alert">
                    Please fill in all required fields correctly.
                </div>
            @endif

            <form class="create-order-form" action="{{ route('order.create.contact.store') }}" method="post">
                @csrf
                <div class="step-form-grid">
                    <div class="form-field">
                        <label class="form-field-label" for="contact-name">First Name</label>
                        <input class="create-order-input" type="text" id="contact-name" name="first_name" placeholder="e.g. John" value="{{ old('first_name', $contact['first_name'] ?? '') }}" required>
                    </div>
                    <div class="form-field">
                        <label class="form-field-label" for="contact-surname">Last Name</label>
                        <input class="create-order-input" type="text" id="contact-surname" name="last_name" placeholder="e.g. Doe" value="{{ old('last_name', $contact['last_name'] ?? '') }}" required>
                    </div>
                    <div class="form-field">
                        <label class="form-field-label" for="contact-email">Email Address</label>
                        <input class="create-order-input" type="email" id="contact-email" name="email" placeholder="e.g. john@example.com" value="{{ old('email', $contact['email'] ?? '') }}" required>
                    </div>
                    <div class="form-field">
                        <label class="form-field-label" for="contact-phone">Phone Number</label>
                        <input class="create-order-input" type="tel" id="contact-phone" name="phone" placeholder="e.g. +421 900 000 000" value="{{ old('phone', $contact['phone'] ?? '') }}" required>
                    </div>
                </div>
                <div class="step-nav">
                    <a href="{{ route('order.create.items') }}" class="step-btn step-btn-prev">
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
