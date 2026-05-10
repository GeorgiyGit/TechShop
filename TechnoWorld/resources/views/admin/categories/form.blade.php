@extends('layouts.admin')

@push('scripts')
    @vite('resources/js/admin-category-form.js')
@endpush

@section('content')
    @php $editing = $category !== null; @endphp

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">{{ $editing ? 'Edit Category' : 'Add Category' }}</h1>
            <p class="admin-breadcrumb">
                <a href="{{ route('admin.categories.index') }}">Admin</a> /
                <a href="{{ route('admin.categories.index') }}">Categories</a> /
                {{ $editing ? 'Edit' : 'Add Category' }}
            </p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-clear-filters fw-500">
            <i class="bi bi-arrow-left me-1"></i>Back to Categories
        </a>
    </div>

    <form action="{{ $editing ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
          method="POST">
        @csrf
        @if ($editing)
            @method('PUT')
        @endif

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="admin-form-card">
                    <p class="admin-form-section-title">Basic Information</p>

                    <div class="mb-0">
                        <label for="catName" class="admin-form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" id="catName" name="name" class="admin-form-control"
                            placeholder="e.g. Smartphones"
                            value="{{ old('name', $category?->name) }}" required>
                        @error('name')
                            <p class="admin-form-hint text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-4 d-flex flex-column gap-4">
                <div class="admin-form-card">
                    <p class="admin-form-section-title">Category Icon</p>

                    <div class="admin-category-icon-preview mb-3">
                        <i id="iconPreview" class="bi {{ old('icon', $category?->icon ?? 'bi-grid') }}"></i>
                    </div>

                    <div class="mb-3">
                        <label for="catIcon" class="admin-form-label">Bootstrap Icon Class</label>
                        <input type="text" id="catIcon" name="icon" class="admin-form-control"
                            placeholder="e.g. bi-phone"
                            value="{{ old('icon', $category?->icon) }}"
                            oninput="updateIconPreview(this.value)">
                        @error('icon')
                            <p class="admin-form-hint text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <p class="admin-form-label mb-2">Quick select</p>
                    <div class="admin-icon-picker">
                        @foreach ([
                            'bi-phone' => 'Smartphones',
                            'bi-laptop' => 'Laptops',
                            'bi-tablet' => 'Tablets',
                            'bi-headphones' => 'Headphones',
                            'bi-camera' => 'Cameras',
                            'bi-controller' => 'Gaming',
                            'bi-smartwatch' => 'Smart Watches',
                            'bi-tv' => 'TVs',
                            'bi-speaker' => 'Speakers',
                            'bi-printer' => 'Printers',
                            'bi-router' => 'Networking',
                            'bi-bag' => 'Accessories',
                            'bi-cpu' => 'PC Components',
                            'bi-lightbulb' => 'Smart Home',
                            'bi-badge-vr' => 'VR & AR',
                            'bi-airplane' => 'Drones',
                        ] as $icon => $label)
                            <button type="button" class="admin-icon-option" title="{{ $label }}"
                                onclick="setIcon('{{ $icon }}')">
                                <i class="bi {{ $icon }}"></i>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="admin-form-actions">
                    <button type="submit" class="btn btn-primary-brand fw-600 px-4">
                        <i class="bi bi-check-lg me-2"></i>{{ $editing ? 'Save Changes' : 'Save Category' }}
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-clear-filters">Cancel</a>
                </div>
            </div>

        </div>
    </form>
@endsection
