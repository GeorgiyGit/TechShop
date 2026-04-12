@extends('layouts.storefront', ['title' => 'TechnoWorld - Privacy Policy'])

@section('bodyClass', 'privacy-page')

@section('content')
    <header>
        <nav class="home-header-nav">
            <div class="d-flex align-items-center gap-3 home-header-left">
                <a href="{{ route('home') }}" class="logo">TechnoWorld</a>
            </div>
            <div class="home-header-center">
                <div class="input-group navbar-search home-navbar-search">
                    <input type="text" class="form-control navbar-search-input"
                        placeholder="Search for products, brands and more...">
                    <button class="btn navbar-search-btn" type="button" aria-label="Search">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0 home-header-right">
                <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-nav-icon" aria-label="Cart">
                    <i class="bi bi-cart3 fs-5"></i>
                </a>
                <a href="{{ route('signup.create') }}" data-auth-modal-target="signup" class="btn btn-outline-light btn-sm px-3 fw-500">Sign Up</a>
                <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-light btn-sm px-3 blue-text fw-500">Log In</a>
            </div>
        </nav>
    </header>

    <main class="privacy-main">
        <section class="privacy-section container">
            <h1 class="privacy-title">Privacy Policy</h1>
            <p class="privacy-updated">Last updated: April 12, 2026</p>

            <article class="privacy-card">
                <h2 class="privacy-heading">1. Information We Collect</h2>
                <p>We collect information you provide directly to us, such as your name, email address, phone number, shipping address, and payment-related data needed to process purchases.</p>
                <p>We also collect technical data such as browser type, device information, and usage events to improve performance and user experience.</p>
            </article>

            <article class="privacy-card">
                <h2 class="privacy-heading">2. How We Use Your Information</h2>
                <ul class="privacy-list">
                    <li>To process and deliver your orders</li>
                    <li>To provide customer support and account management</li>
                    <li>To send service notifications and order updates</li>
                    <li>To improve site quality, security, and product recommendations</li>
                </ul>
            </article>

            <article class="privacy-card">
                <h2 class="privacy-heading">3. Data Sharing</h2>
                <p>We do not sell personal information. We may share limited data with logistics providers, payment processors, and analytics tools only when required to operate the service.</p>
            </article>

            <article class="privacy-card">
                <h2 class="privacy-heading">4. Data Retention</h2>
                <p>We keep personal information only for as long as necessary to fulfill legal, accounting, and service obligations. You may request deletion of your account data where permitted by law.</p>
            </article>

            <article class="privacy-card">
                <h2 class="privacy-heading">5. Your Rights</h2>
                <p>Depending on your region, you may have rights to access, correct, delete, or export your personal data. To exercise these rights, contact us using the addresses below.</p>
            </article>

            <article class="privacy-card">
                <h2 class="privacy-heading">6. Contact</h2>
                <p>For privacy requests, contact us at:</p>
                <p class="mb-1">xsladkovskyi@stuba.sk</p>
                <p class="mb-0">xsorochynskyi@stuba.sk</p>
            </article>
        </section>
    </main>

    <footer>
        <div class="socials">
            <a href="https://www.linkedin.com/in/george-sladkovsky-537a27257/" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.linkedin.com/in/george-sladkovsky-537a27257/" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://www.linkedin.com/in/george-sladkovsky-537a27257/" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Twitter/X"><i class="bi bi-twitter-x"></i></a>
            <a href="https://www.linkedin.com/in/george-sladkovsky-537a27257/" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
        </div>
        <div class="pages">
            <a href="{{ route('home') }}" class="footer-link">Home</a>
            <a href="{{ route('privacy-policy') }}" class="footer-link">Privacy Policy</a>
            <a href="{{ route('home') }}#about" class="footer-link">About</a>
        </div>
        <div class="emails">
            <p class="footer-email mb-1">xsladkovskyi@stuba.sk</p>
            <p class="footer-email mb-0">xsorochynskyi@stuba.sk</p>
        </div>
    </footer>

@endsection