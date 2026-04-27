@extends('layouts.admin')

@section('content')
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Products</h1>
            <p class="admin-breadcrumb"><a href="{{ route('admin.products.index') }}">Admin</a> / Products</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary-brand fw-600">
            <i class="bi bi-plus-lg me-2"></i>Add New Product
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">
                All Products <span class="admin-badge ms-1">{{ $products->total() }}</span>
            </h2>
            <form method="GET" class="admin-filter-bar">
                <input type="text" name="search" class="admin-search-input" placeholder="Search products..."
                    value="{{ $search }}" aria-label="Search products">
                <select name="category_id" class="admin-filter-select" aria-label="Filter by category">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary-brand btn-sm fw-500">Filter</button>
                @if ($search || $categoryId)
                    <a href="{{ route('admin.products.index') }}" class="btn btn-clear-filters btn-sm fw-500">Clear</a>
                @endif
            </form>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:48px">#</th>
                        <th style="width:62px">Image</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th style="width:140px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $product)
                        <tr>
                            <td>{{ $products->firstItem() + $index }}</td>
                            <td>
                                @if ($product->firstImage)
                                    <img src="{{ route('images.products', $product->firstImage->image_path) }}"
                                         alt="{{ $product->name }}" class="admin-product-thumb">
                                @else
                                    <div class="admin-product-thumb d-flex align-items-center justify-content-center bg-light">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-600 small">{{ $product->name }}</div>
                                @if ($product->short_description)
                                    <div class="text-muted" style="font-size:0.78rem">{{ Str::limit($product->short_description, 60) }}</div>
                                @endif
                            </td>
                            <td class="small">{{ $product->category?->name ?? '—' }}</td>
                            <td class="small">{{ $product->brand }}</td>
                            <td class="small fw-600">€{{ number_format($product->price, 2) }}</td>
                            <td>
                                @if ($product->stock_left <= 0)
                                    <span class="stock-badge stock-badge-out">Out of Stock</span>
                                @elseif ($product->stock_left <= 5)
                                    <span class="stock-badge stock-badge-low">Low ({{ $product->stock_left }})</span>
                                @else
                                    <span class="stock-badge stock-badge-in">In Stock</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-admin-edit">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                          onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-admin-delete">
                                            <i class="bi bi-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="admin-table-footer">
            <span class="small text-muted">
                Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} products
            </span>
            {{ $products->links() }}
        </div>
    </div>
@endsection
