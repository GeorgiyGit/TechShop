@extends('layouts.admin')

@push('scripts')
    @vite('resources/js/admin-product-form.js')
@endpush

@section('content')
    @php $editing = $product !== null; @endphp

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">{{ $editing ? 'Edit Product' : 'New Product' }}</h1>
            <p class="admin-breadcrumb">
                <a href="{{ route('admin.products.index') }}">Admin</a> /
                <a href="{{ route('admin.products.index') }}">Products</a> /
                {{ $editing ? 'Edit' : 'New' }}
            </p>
        </div>
    </div>

    <form action="{{ $editing ? route('admin.products.update', $product) : route('admin.products.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if ($editing)
            @method('PUT')
        @endif

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="admin-form-card mb-4">
                    <p class="admin-form-section-title">Basic Information</p>

                    <div class="mb-3">
                        <label for="prodName" class="admin-form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" id="prodName" name="name" class="admin-form-control"
                            placeholder="Product name" value="{{ old('name', $product?->name) }}" required>
                        @error('name')<p class="admin-form-hint text-danger">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="prodBrand" class="admin-form-label">Brand <span class="text-danger">*</span></label>
                        <select id="prodBrand" name="brand_id" class="admin-form-control" required>
                            <option value="">Select brand...</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ old('brand_id', $product?->brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')<p class="admin-form-hint text-danger">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="prodCategory" class="admin-form-label">Category <span class="text-danger">*</span></label>
                        <select id="prodCategory" name="category_id" class="admin-form-control" required>
                            <option value="">Select category...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product?->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<p class="admin-form-hint text-danger">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="prodShortDesc" class="admin-form-label">Short Description</label>
                        <input type="text" id="prodShortDesc" name="short_description" class="admin-form-control"
                            placeholder="Brief summary" value="{{ old('short_description', $product?->short_description) }}">
                        <p class="admin-form-hint">Keep it under 80 characters.</p>
                        @error('short_description')<p class="admin-form-hint text-danger">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="prodDesc" class="admin-form-label">Full Description</label>
                        <textarea id="prodDesc" name="description" class="admin-form-control" rows="6"
                            placeholder="Detailed product description">{{ old('description', $product?->description) }}</textarea>
                        @error('description')<p class="admin-form-hint text-danger">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="admin-form-card mb-4">
                    <p class="admin-form-section-title">Product Images</p>

                    <label class="admin-image-upload" for="productImages">
                        <input type="file" id="productImages" name="images[]" multiple accept="image/*">
                        <i class="bi bi-cloud-upload upload-icon"></i>
                        <p>Click or drag images here</p>
                        <small>PNG, JPG, WEBP — max 5MB each</small>
                    </label>

                    @if ($editing && $product->images->isNotEmpty())
                        <div class="admin-image-previews mt-3">
                            @foreach ($product->images as $img)
                                <div class="admin-image-preview-item">
                                    <img src="{{ route('images.products', $img->url) }}" alt="">
                                    <form action="{{ route('admin.product-images.destroy', $img) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-image"
                                            onclick="return confirm('Delete this image?')" title="Delete image">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div id="imagePreviewContainer" class="admin-image-previews"></div>

                    @error('images.*')<p class="admin-form-hint text-danger mt-2">{{ $message }}</p>@enderror
                </div>

                <div class="admin-form-card">
                    <p class="admin-form-section-title">Pricing & Inventory</p>

                    <div class="mb-3">
                        <label for="prodPrice" class="admin-form-label">Price <span class="text-danger">*</span></label>
                        <div class="admin-input-group">
                            <span class="admin-input-group-text">€</span>
                            <input type="number" id="prodPrice" name="price" class="admin-form-control"
                                placeholder="0.00" value="{{ old('price', $product?->price) }}"
                                min="0" step="0.01" required>
                        </div>
                        @error('price')<p class="admin-form-hint text-danger">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="prodStock" class="admin-form-label">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" id="prodStock" name="stock_quantity" class="admin-form-control"
                            placeholder="0" value="{{ old('stock_quantity', $product?->stock_quantity) }}" min="0" step="1" required>
                        @error('stock_quantity')<p class="admin-form-hint text-danger">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="admin-form-card">
                    <p class="admin-form-section-title">Key Specifications</p>

                    <div id="characteristicsContainer">
                        @if ($editing && $product->characteristics->isNotEmpty())
                            @foreach ($product->characteristics as $char)
                                <div class="row g-2 mb-2 spec-row">
                                    <div class="col-5">
                                        <input type="text" name="char_name[]" class="admin-form-control"
                                            placeholder="Name" value="{{ $char->name }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="char_value[]" class="admin-form-control"
                                            placeholder="Value" value="{{ $char->value }}">
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-admin-delete w-100 remove-spec">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row g-2 mb-2 spec-row">
                                <div class="col-5">
                                    <input type="text" name="char_name[]" class="admin-form-control" placeholder="Name">
                                </div>
                                <div class="col-6">
                                    <input type="text" name="char_value[]" class="admin-form-control" placeholder="Value">
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-admin-delete w-100 remove-spec">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <button type="button" id="addSpecBtn" class="btn btn-clear-filters btn-sm fw-500 mt-1">
                        <i class="bi bi-plus-lg me-1"></i>Add Specification
                    </button>
                </div>
            </div>
        </div>

        <div class="admin-form-actions mt-4">
            <button type="submit" class="btn btn-primary-brand fw-600">
                {{ $editing ? 'Save Changes' : 'Create Product' }}
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-clear-filters fw-500">Cancel</a>
        </div>
    </form>
@endsection
