@extends('layouts.admin')

@section('content')
    @php $editing = $brand !== null; @endphp

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">{{ $editing ? 'Edit Brand' : 'New Brand' }}</h1>
            <p class="admin-breadcrumb">
                <a href="{{ route('admin.brands.index') }}">Admin</a> /
                <a href="{{ route('admin.brands.index') }}">Brands</a> /
                {{ $editing ? 'Edit' : 'New' }}
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form action="{{ $editing ? route('admin.brands.update', $brand) : route('admin.brands.store') }}"
                  method="POST">
                @csrf
                @if ($editing)
                    @method('PUT')
                @endif

                <div class="admin-form-card">
                    <p class="admin-form-section-title">Brand Information</p>

                    <div class="mb-4">
                        <label for="brandName" class="admin-form-label">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" id="brandName" name="name" class="admin-form-control"
                            placeholder="e.g. Samsung" value="{{ old('name', $brand?->name) }}" required>
                        <p class="admin-form-hint">Enter the official brand name as it should appear on products.</p>
                        @error('name')
                            <p class="admin-form-hint text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="admin-form-actions">
                        <button type="submit" class="btn btn-primary-brand fw-600">
                            {{ $editing ? 'Save Changes' : 'Create Brand' }}
                        </button>
                        <a href="{{ route('admin.brands.index') }}" class="btn btn-clear-filters fw-500">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
