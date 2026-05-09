@extends('layouts.admin')

@section('content')
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Brands</h1>
            <p class="admin-breadcrumb"><a href="{{ route('admin.brands.index') }}">Admin</a> / Brands</p>
        </div>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary-brand fw-600">
            <i class="bi bi-plus-lg me-2"></i>Add New Brand
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">
                All Brands <span class="admin-badge ms-1">{{ $brands->count() }}</span>
            </h2>
            <form method="GET" class="admin-filter-bar">
                <input type="text" name="search" class="admin-search-input" placeholder="Search by brand name..."
                    value="{{ $search }}" aria-label="Search brands">
                <button type="submit" class="btn btn-primary-brand btn-sm fw-500">Search</button>
                @if ($search)
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-clear-filters btn-sm fw-500">Clear</a>
                @endif
            </form>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:48px">#</th>
                        <th>Name</th>
                        <th style="width:90px">Products</th>
                        <th style="width:140px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $index => $brand)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $brand->name }}</td>
                            <td><span class="admin-badge">{{ $brand->products_count }}</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-admin-edit">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST"
                                          onsubmit="return confirm('Delete this brand?')">
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
                            <td colspan="4" class="text-center py-4 text-muted">No brands found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="admin-table-footer">
            <span class="small text-muted">Showing {{ $brands->count() }} brands</span>
        </div>
    </div>
@endsection
