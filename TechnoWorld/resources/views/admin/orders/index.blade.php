@extends('layouts.admin')

@section('content')
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Orders</h1>
            <p class="admin-breadcrumb"><a href="{{ route('admin.orders.index') }}">Admin</a> / Orders</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">
                All Orders <span class="admin-badge ms-1">{{ $orders->total() }}</span>
            </h2>
            <form method="GET" class="admin-filter-bar">
                <input type="text" name="search" class="admin-search-input"
                    placeholder="Search by order # or customer..." value="{{ $search }}" aria-label="Search orders">
                <select name="status" class="admin-filter-select" aria-label="Filter by status" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    @foreach ($statuses as $value)
                        <option value="{{ $value }}" {{ $status === $value ? 'selected' : '' }}>{{ ucfirst($value) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary-brand btn-sm fw-500">Filter</button>
                @if ($search || $status)
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-clear-filters btn-sm fw-500">Clear</a>
                @endif
            </form>
        </div>
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th style="width:110px">Order #</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th style="width:130px">Status</th>
                        <th style="width:100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        @php
                            $name = trim(($order->contact_first_name ?? '') . ' ' . ($order->contact_last_name ?? ''));
                            $email = $order->contact_email ?? $order->user?->email ?? 'Guest';
                            $itemsCount = $order->items->sum('quantity');
                        @endphp
                        <tr>
                            <td><span class="fw-600 text-muted small">#{{ substr($order->id, -8) }}</span></td>
                            <td>
                                @if ($name)
                                    <div class="fw-500">{{ $name }}</div>
                                @endif
                                <div class="text-muted small">{{ $email }}</div>
                            </td>
                            <td class="text-muted small">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                            <td class="text-muted small">{{ $itemsCount }} {{ Str::plural('item', $itemsCount) }}</td>
                            <td class="fw-500">{{ number_format($order->total_price, 2) }} €</td>
                            <td><span class="order-status-badge order-status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('order.show', $order) }}" class="btn btn-admin-edit btn-sm admin-btn-stack" target="_blank">
                                        <i class="bi bi-eye"></i><span>View</span>
                                    </a>
                                    <a href="{{ route('admin.orders.editStatus', $order) }}" class="btn btn-admin-edit btn-sm admin-btn-stack">
                                        <i class="bi bi-arrow-repeat"></i><span>Status</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="admin-table-footer">
            <small class="text-muted">Showing {{ $orders->count() }} of {{ $orders->total() }} orders</small>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
