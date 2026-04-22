<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TechnoWorld Admin' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/products.css', 'resources/css/admin.css'])
    @stack('styles')
</head>

<body class="admin-body">
    <header>
        <nav class="home-header-nav">
            <div class="d-flex align-items-center gap-3 home-header-left">
                <a href="{{ route('home') }}" class="logo">TechnoWorld</a>
                <span class="admin-panel-badge">Admin</span>
            </div>
            <div class="home-header-center"></div>
            <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0 home-header-right">
                <span class="admin-user-avatar"><i class="bi bi-person-fill"></i></span>
                <span class="text-white fw-500 small">{{ auth()->user()->email }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm px-3 blue-text fw-500">Log Out</button>
                </form>
            </div>
        </nav>
    </header>

    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <p class="admin-nav-section">Catalog</p>
            <nav class="admin-nav">
                <a href="{{ route('admin.categories.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-grid-3x3-gap-fill"></i>Categories
                </a>
                <a href="{{ route('admin.brands.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                    <i class="bi bi-tag"></i>Brands
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i>Products
                </a>
            </nav>
            <p class="admin-nav-section">Sales</p>
            <nav class="admin-nav">
                <a href="{{ route('admin.orders.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i>Orders
                </a>
            </nav>
        </aside>

        <main class="admin-content">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
