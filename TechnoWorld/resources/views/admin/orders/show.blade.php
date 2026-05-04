@extends('layouts.admin')

@section('content')
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Order #{{ $order->order_number }}</h1>
            <p class="admin-breadcrumb">
                <a href="{{ route('admin.orders.index') }}">Admin</a> /
                <a href="{{ route('admin.orders.index') }}">Orders</a> /
                #{{ $order->order_number }}
            </p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-clear-filters fw-500">
            <i class="bi bi-arrow-left me-1"></i>Back to Orders
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        {{-- Order details --}}
        <div class="col-lg-7">
            <div class="admin-form-card mb-4">
                <p class="admin-form-section-title">Order Information</p>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Order Number</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">#{{ $order->order_number }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Order Date</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">{{ $order->placed_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Customer</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">{{ $order->first_name }} {{ $order->last_name }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Email</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">{{ $order->email }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Phone</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">{{ $order->phone }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Items</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">{{ $order->items->sum('quantity') }} items</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Delivery</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">{{ $order->delivery_label }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Payment</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">{{ $order->payment_label }}</p>
                    </div>
                    <div class="col-12">
                        <p class="admin-form-label mb-1">Total</p>
                        <p class="admin-form-control fw-600" style="background:var(--gray-soft)">€{{ number_format($order->total, 2) }}</p>
                    </div>
                    <div class="col-12">
                        <p class="admin-form-label mb-1">Current Status</p>
                        <span class="order-status-badge order-status-{{ $order->status }}">
                            {{ $statuses[$order->status] ?? ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="admin-form-card">
                <p class="admin-form-section-title">Order Items</p>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="fw-600 small">{{ $item->product_name }}</div>
                                        <div class="text-muted" style="font-size:0.78rem">{{ $item->product_brand }}</div>
                                    </td>
                                    <td class="small">{{ $item->quantity }}</td>
                                    <td class="small">€{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="small fw-600">€{{ number_format($item->total_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Status update --}}
        <div class="col-lg-5">
            <div class="admin-form-card">
                <p class="admin-form-section-title">Update Status</p>

                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="orderStatus" class="admin-form-label">New Status <span class="text-danger">*</span></label>
                        <select id="orderStatus" name="status" class="admin-form-control" required>
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="admin-form-hint text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="admin-form-actions">
                        <button type="submit" class="btn btn-primary-brand fw-600">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
