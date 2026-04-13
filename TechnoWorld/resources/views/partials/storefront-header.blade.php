<header>
    <nav class="home-header-nav">
        <div class="d-flex align-items-center gap-3 home-header-left">
            <a href="{{ route('home') }}" class="logo">TechnoWorld</a>
        </div>
        <div class="home-header-center">
            <div class="search-autocomplete" data-search-autocomplete
                data-search-products-url="{{ route('products') }}">
                <div class="input-group navbar-search home-navbar-search">
                    <input type="text" class="form-control navbar-search-input"
                        placeholder="Search for products, brands and more..." aria-label="Search for products, brands and more..."
                        autocomplete="off" data-search-input>
                    <button class="btn navbar-search-btn" type="button" aria-label="Search" data-search-toggle>
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <div class="search-dropdown" data-search-dropdown hidden>
                    <div class="search-dropdown-section" data-search-products-section>
                        <div class="search-dropdown-title">Products</div>
                        <div class="search-dropdown-list" data-search-products-list></div>
                    </div>
                    <div class="search-dropdown-section search-dropdown-brands" data-search-brands-section>
                        <div class="search-dropdown-title">Brands</div>
                        <div class="search-dropdown-list" data-search-brands-list></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0 home-header-right">
            @auth
                <a href="{{ route('cart.index') }}" class="btn btn-nav-icon" aria-label="Cart">
                    <i class="bi bi-cart3 fs-5"></i>
                </a>
                <a href="{{ route('account') }}" class="btn btn-nav-icon" aria-label="Account profile">
                    <i class="bi bi-person-circle fs-5"></i>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="return_to" value="{{ request()->fullUrl() }}">
                    <button type="submit" class="btn btn-light btn-sm px-3 blue-text fw-500">Log off</button>
                </form>
            @else
                <a href="{{ route('cart.index') }}" class="btn btn-nav-icon" aria-label="Cart">
                    <i class="bi bi-cart3 fs-5"></i>
                </a>
                <a href="{{ route('signup.create') }}" data-auth-modal-target="signup" class="btn btn-outline-light btn-sm px-3 fw-500">Sign Up</a>
                <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-light btn-sm px-3 blue-text fw-500">Log In</a>
            @endauth
        </div>
    </nav>
</header>

<script type="application/json" id="searchCatalogData">@json($searchCatalog ?? ['products' => [], 'brands' => []])</script>
