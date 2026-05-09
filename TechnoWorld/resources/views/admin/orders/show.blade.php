@extends('layouts.admin')

@section('content')
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Order #{{ substr($order->id, -8) }}</h1>
            <p class="admin-breadcrumb">
                <a href="{{ route('admin.orders.index') }}">Admin</a> /
                <a href="{{ route('admin.orders.index') }}">Orders</a> /
                #{{ substr($order->id, -8) }}
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
        <div class="col-lg-7">
            <div class="admin-form-card mb-4">
                <p class="admin-form-section-title">Order Information</p>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Order Reference</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">#{{ substr($order->id, -8) }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Order Date</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Customer</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">{{ $order->user?->email ?? 'Guest' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Delivery Method</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">{{ $order->delivery_method === 'pickup' ? 'Store Pickup' : 'Courier' }}</p>
                    </div>
                    @if ($order->address)
                        <div class="col-12">
                            <p class="admin-form-label mb-1">Delivery Address</p>
                            <p class="admin-form-control" style="background:var(--gray-soft)">
                                {{ $order->address->street }} {{ $order->address->house_number }},
                                {{ $order->address->city }}, {{ $order->address->postal_code }},
                                {{ $order->address->country }}
                            </p>
                        </div>
                    @endif
                    @if ($order->payment)
                        <div class="col-sm-6">
                            <p class="admin-form-label mb-1">Payment Method</p>
                            <p class="admin-form-control" style="background:var(--gray-soft)">{{ ucfirst(str_replace('_', ' ', $order->payment->payment_method)) }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="admin-form-label mb-1">Payment Amount</p>
                            <p class="admin-form-control" style="background:var(--gray-soft)">€{{ number_format($order->payment->amount, 2) }}</p>
                        </div>
                    @endif
                    <div class="col-sm-6">
                        <p class="admin-form-label mb-1">Items</p>
                        <p class="admin-form-control" style="background:var(--gray-soft)">{{ $order->items->sum('quantity') }} items</p>
                    </div>
                    <div class="col-12">
                        <p class="admin-form-label mb-1">Total</p>
                        <p class="admin-form-control fw-600" style="background:var(--gray-soft)">€{{ number_format($order->total_price, 2) }}</p>
                    </div>
                    <div class="col-12">
                        <p class="admin-form-label mb-1">Current Status</p>
                        <span class="order-status-badge order-status-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
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
                                        @if ($item->product)
                                            <div class="fw-600 small">{{ $item->product->name }}</div>
                                            <div class="text-muted" style="font-size:0.78rem">{{ $item->product->brand?->name }}</div>
                                        @else
                                            <div class="fw-600 small text-muted">[Product deleted]</div>
                                        @endif
                                    </td>
                                    <td class="small">{{ $item->quantity }}</td>
                                    <td class="small">€{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="small fw-600">€{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="admin-form-card">
                <p class="admin-form-section-title">Update Status</p>

                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="orderStatus" class="admin-form-label">New Status <span class="text-danger">*</span></label>
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

                    <div class="admin-form-actions">
                        <button type="submit" class="btn btn-primary-brand fw-600">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
