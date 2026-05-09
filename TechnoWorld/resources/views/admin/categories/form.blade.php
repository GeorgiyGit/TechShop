@extends('layouts.admin')

@push('scripts')
    @vite('resources/js/admin-category-form.js')
@endpush

@section('content')
    @php $editing = $category !== null; @endphp

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">{{ $editing ? 'Edit Category' : 'New Category' }}</h1>
            <p class="admin-breadcrumb">
                <a href="{{ route('admin.categories.index') }}">Admin</a> /
                <a href="{{ route('admin.categories.index') }}">Categories</a> /
                {{ $editing ? 'Edit' : 'New' }}
            </p>
        </div>
    </div>

    <form action="{{ $editing ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
          method="POST">
        @csrf
        @if ($editing)
            @method('PUT')
        @endif

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="admin-form-card">
                    <p class="admin-form-section-title">Category Information</p>

                    <div class="mb-4">
                        <label for="catName" class="admin-form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" id="catName" name="name" class="admin-form-control"
                            placeholder="e.g. Smartphones" value="{{ old('name', $category?->name) }}" required>
                        @error('name')
                            <p class="admin-form-hint text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="catIcon" class="admin-form-label">Icon Class <span class="text-danger">*</span></label>
                        <input type="text" id="catIcon" name="icon" class="admin-form-control"
                            placeholder="e.g. bi-phone" value="{{ old('icon', $category?->icon) }}" required
                            oninput="updateIconPreview(this.value)">
                        <p class="admin-form-hint">Enter a Bootstrap Icons class name.</p>
                        @error('icon')
                            <p class="admin-form-hint text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="admin-form-actions">
                        <button type="submit" class="btn btn-primary-brand fw-600">
                            {{ $editing ? 'Save Changes' : 'Create Category' }}
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-clear-filters fw-500">Cancel</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="admin-form-card">
                    <p class="admin-form-section-title">Icon Preview</p>

                    <div class="admin-category-icon-preview mb-3" id="iconPreviewBox">
                        <i id="iconPreview" class="bi {{ old('icon', $category?->icon ?? 'bi-grid') }}"></i>
                    </div>

                    <p class="admin-form-section-title mt-4">Quick Select</p>
                    <div class="admin-icon-picker">
                        @foreach (['bi-phone', 'bi-laptop', 'bi-tablet', 'bi-headphones', 'bi-camera', 'bi-controller', 'bi-watch', 'bi-tv', 'bi-speaker', 'bi-printer', 'bi-wifi', 'bi-bag', 'bi-cpu', 'bi-battery-charging', 'bi-house', 'bi-house-gear', 'bi-vr', 'bi-drone'] as $icon)
                            <button type="button" class="admin-icon-option" onclick="setIcon('{{ $icon }}')" title="{{ $icon }}">
                                <i class="bi {{ $icon }}"></i>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
