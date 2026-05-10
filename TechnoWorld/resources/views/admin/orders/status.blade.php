@extends('layouts.admin')

@section('content')
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Change Order Status</h1>
            <p class="admin-breadcrumb">
                <a href="{{ route('admin.orders.index') }}">Admin</a> /
                <a href="{{ route('admin.orders.index') }}">Orders</a> /
                Update Status
            </p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-clear-filters fw-500">
            <i class="bi bi-arrow-left me-1"></i>Back to Orders
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <form class="row g-4" action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="col-lg-8 d-flex flex-column gap-4">
            <div class="admin-form-card">
                <p class="admin-form-section-title">Order Information</p>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <p class="admin-form-label">Order Number</p>
                        <p class="admin-form-control admin-readonly mb-0">#{{ substr($order->id, -8) }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label">Order Date</p>
                        <p class="admin-form-control admin-readonly mb-0">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</p>
                    </div>
                    @php
                        $name = trim(($order->contact_first_name ?? '') . ' ' . ($order->contact_last_name ?? ''));
                        $email = $order->contact_email ?? $order->user?->email ?? '—';
                        $itemsCount = $order->items->sum('quantity');
                    @endphp
                    @if ($name)
                        <div class="col-sm-6">
                            <p class="admin-form-label">Customer</p>
                            <p class="admin-form-control admin-readonly mb-0">{{ $name }}</p>
                        </div>
                    @endif
                    <div class="col-sm-6">
                        <p class="admin-form-label">Email</p>
                        <p class="admin-form-control admin-readonly mb-0">{{ $email }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label">Items</p>
                        <p class="admin-form-control admin-readonly mb-0">{{ $itemsCount }} {{ Str::plural('item', $itemsCount) }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label">Total</p>
                        <p class="admin-form-control admin-readonly mb-0">{{ number_format($order->total_price, 2) }} €</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 d-flex flex-column gap-4">
            <div class="admin-form-card">
                <p class="admin-form-section-title">Status Update</p>
                <div class="mb-0">
                    <label class="admin-form-label" for="orderStatus">
                        New Status <span class="text-danger">*</span>
                    </label>
                    <select id="orderStatus" name="status" class="admin-form-control" required>
                        @foreach ($statuses as $value)
                            <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                                {{ ucfirst($value) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="admin-form-hint text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="admin-form-card">
                <p class="admin-form-section-title">Current Status</p>
                <p class="mb-0">
                    <span class="order-status-badge order-status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                </p>
            </div>
        </div>

        <div class="col-12">
            <div class="admin-form-actions">
                <button type="submit" class="btn btn-primary-brand fw-600 px-4">
                    <i class="bi bi-check-lg me-2"></i>Save Status
                </button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-clear-filters">Cancel</a>
            </div>
        </div>
    </form>
@endsection
