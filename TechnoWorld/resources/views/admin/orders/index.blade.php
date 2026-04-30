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
                <select name="status" class="admin-filter-select" aria-label="Filter by status">
                    <option value="">All Statuses</option>
                    @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}" {{ $status === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary-brand btn-sm fw-500">Filter</button>
                @if ($search || $status)
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-clear-filters btn-sm fw-500">Clear</a>
                @endif
            </form>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
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
                        <tr>
                            <td class="fw-600 small">#{{ $order->order_number }}</td>
                            <td>
                                <div class="fw-600 small">{{ $order->first_name }} {{ $order->last_name }}</div>
                                <div class="text-muted" style="font-size:0.78rem">{{ $order->email }}</div>
                            </td>
                            <td class="small">{{ $order->placed_at->format('d M Y') }}</td>
                            <td class="small">{{ $order->items->sum('quantity') }}</td>
                            <td class="small fw-600">€{{ number_format($order->total, 2) }}</td>
                            <td>
                                <span class="order-status-badge order-status-{{ $order->status }}">
                                    {{ $statuses[$order->status] ?? ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1 admin-btn-stack">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="btn btn-admin-edit d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-eye"></i>
                                        <span>View</span>
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
            <span class="small text-muted">
                Showing {{ $orders->firstItem() }}–{{ $orders->lastItem() }} of {{ $orders->total() }} orders
            </span>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
