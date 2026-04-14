@if ($products->count() > 0)
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-3">
        @foreach ($products as $product)
            <div class="col">
                <article class="product-card card h-100">
                    <div class="product-img-wrap">
                        <img src="{{ $product->firstImage ? url('/images/products/' . $product->firstImage->image_path) : '' }}" alt="{{ $product->name }}" class="product-img">
                        @if (($product->stock_left ?? 0) <= 0)
                            <span class="product-stock-badge out-of-stock">Out of Stock</span>
                        @elseif (($product->stock_left ?? 0) <= 5)
                            <span class="product-stock-badge low-stock">Only {{ $product->stock_left }} left</span>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column p-3">
                        <small class="text-muted">{{ $product->brand }}</small>
                        <h6 class="card-title mt-1">{{ $product->name }}</h6>
                        <a href="{{ route('product.show', $product->slug) }}" class="stretched-link" aria-label="Open {{ $product->name }}"></a>
                        <p class="card-text text-muted">{{ $product->short_description }}</p>
                        <div class="d-flex justify-content-between align-items-center pt-2 mt-auto">
                            <span class="product-price">{{ number_format((float) $product->price, 2) }} €</span>
                            <div style="position: relative; z-index: 1;">
                            @if (($product->stock_left ?? 0) <= 0)
                                <button type="button" class="btn btn-add-cart btn-sm" disabled>
                                    <i class="bi bi-cart-x me-1"></i>Unavailable
                                </button>
                            @else
                                <button type="button" class="btn btn-add-cart btn-sm"
                                    data-add-to-cart="{{ $product->id }}">
                                    <i class="bi bi-cart-plus me-1"></i>Add
                                </button>
                            @endif
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>

    @if ($products->hasPages())
        @php($paginationWindow = \Illuminate\Pagination\UrlWindow::make($products->onEachSide(1)))
        <div class="d-flex justify-content-center justify-content-md-end mt-4">
            <nav aria-label="Products pagination">
                <ul class="pagination my-pagination mb-0">
                    <li @class(['page-item', 'disabled' => $products->onFirstPage()])>
                        <a class="page-link" href="{{ $products->previousPageUrl() ?? '#' }}" aria-label="Previous">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>

                    @if (is_array($paginationWindow['first'] ?? null))
                        @foreach ($paginationWindow['first'] as $page => $url)
                            <li @class(['page-item', 'active' => $page === $products->currentPage()])>
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                    @endif

                    @if (is_array($paginationWindow['slider'] ?? null))
                        @if (is_array($paginationWindow['first'] ?? null))
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif

                        @foreach ($paginationWindow['slider'] as $page => $url)
                            <li @class(['page-item', 'active' => $page === $products->currentPage()])>
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if (is_array($paginationWindow['last'] ?? null))
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                    @endif

                    @if (is_array($paginationWindow['last'] ?? null))
                        @foreach ($paginationWindow['last'] as $page => $url)
                            <li @class(['page-item', 'active' => $page === $products->currentPage()])>
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                    @endif

                    <li @class(['page-item', 'disabled' => ! $products->hasMorePages()])>
                        <a class="page-link" href="{{ $products->nextPageUrl() ?? '#' }}" aria-label="Next">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    @endif
@else
    <div class="alert alert-light border text-muted mb-0" role="status">
        No products match the selected filters.
    </div>
@endif