@extends('layouts.admin')

@section('content')
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Categories</h1>
            <p class="admin-breadcrumb"><a href="{{ route('admin.categories.index') }}">Admin</a> / Categories</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary-brand fw-600">
            <i class="bi bi-plus-lg me-2"></i>Add New Category
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">
                All Categories <span class="admin-badge ms-1">{{ $categories->total() }}</span>
            </h2>
            <form method="GET" class="admin-filter-bar">
                <input type="text" name="search" class="admin-search-input" placeholder="Search categories..."
                    value="{{ $search }}" aria-label="Search categories">
                <button type="submit" class="btn btn-primary-brand btn-sm fw-500">Search</button>
                @if ($search)
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-clear-filters btn-sm fw-500">Clear</a>
                @endif
            </form>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:48px">#</th>
                        <th style="width:62px">Icon</th>
                        <th>Name</th>
                        <th style="width:90px">Products</th>
                        <th style="width:140px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr>
                            <td>{{ $categories->firstItem() + $index }}</td>
                            <td>
                                <div class="admin-category-icon">
                                    <i class="bi {{ $category->icon }}"></i>
                                </div>
                            </td>
                            <td>{{ $category->name }}</td>
                            <td><span class="admin-badge">{{ $category->products_count }}</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="btn btn-admin-edit">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                          onsubmit="return confirm('Delete this category?')">
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
                            <td colspan="5" class="text-center py-4 text-muted">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="admin-table-footer">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
