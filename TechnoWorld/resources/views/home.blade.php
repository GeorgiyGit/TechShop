@extends('layouts.storefront', ['title' => 'TechnoWorld - Home'])

@section('bodyClass', 'home-page')

@section('content')
    <header>
        <nav class="home-header-nav">
            <div class="d-flex align-items-center gap-3 home-header-left">
                <a href="/" class="logo">TechnoWorld</a>
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

    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-slide carousel-slide-1 home-banner">
                    <div class="carousel-slide-content home-banner-content">
                        <span class="tag">New Arrival</span>
                        <h2 class="display-5 fw-bold white-text">Motorola Razr 50 Ultra<br>Has Just Arrived</h2>
                        <p class="lead white-text mb-4">Experience a premium foldable design and flagship-level camera performance.</p>
                        <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-light btn-lg px-4 text-primary-brand fw-600">Discover Razr 50 Ultra</a>
                    </div>
                    <div class="home-banner-media">
                        <div class="home-banner-product-card">
                            <img src="/assets/products/phone/motorola-razr-50-ultra/image.png" alt="Motorola Razr 50 Ultra" class="home-banner-image home-banner-image-phone">
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="carousel-slide carousel-slide-2 home-banner">
                    <div class="carousel-slide-content home-banner-content">
                        <span class="tag">Limited Time</span>
                        <h2 class="display-5 fw-bold white-text">Surface Go 3 Deal<br>Ends This Week</h2>
                        <p class="lead white-text mb-4">Save now on a compact laptop designed for daily work and studies.</p>
                        <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-light btn-lg px-4 text-primary-brand fw-600">View Surface Go 3 Deal</a>
                    </div>
                    <div class="home-banner-media">
                        <div class="home-banner-product-card">
                            <img src="/assets/products/laptop/microsoft-surface-go-3/image.png" alt="Microsoft Surface Go 3" class="home-banner-image home-banner-image-laptop">
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="carousel-slide carousel-slide-3 home-banner">
                    <div class="carousel-slide-content home-banner-content">
                        <span class="tag">Top Pick</span>
                        <h2 class="display-5 fw-bold white-text">Apple iPhone 11<br>Still a Bestseller</h2>
                        <p class="lead white-text mb-4">Reliable performance, smooth camera system, and excellent value.</p>
                        <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-light btn-lg px-4 text-primary-brand fw-600">Explore iPhone 11</a>
                    </div>
                    <div class="home-banner-media">
                        <div class="home-banner-product-card">
                            <img src="/assets/products/phone/iphone-11/image.png" alt="Apple iPhone 11" class="home-banner-image home-banner-image-phone">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section id="about" class="home-about">
        <h2 class="home-quote">Where Innovation Meets Everyday Life</h2>

        <p class="home-text-left">
            At TechnoWorld, we believe great technology should be accessible to everyone. Founded by a team of passionate
            tech enthusiasts, we have carefully curated a premium selection of the latest smartphones, laptops, tablets,
            audio gear, cameras, and much more - all under one roof. Every product in our catalogue is hand-picked and
            reviewed to ensure it meets our standards for quality, performance, and value. We partner with the world's
            leading brands - Apple, Samsung, Sony, Lenovo, and beyond - to bring you cutting-edge technology at
            competitive prices. Whether you are upgrading your current setup, searching for the perfect gift, or simply
            keeping up with the latest innovations, TechnoWorld is your trusted destination for all things tech.
        </p>

        <p class="home-text-right">
            Shopping at TechnoWorld is more than just a transaction - it is an experience built around you. We offer
            fast and secure delivery straight to your door, hassle-free returns, and a dedicated support team ready to
            assist you at every step of your journey. Our platform is designed to make finding the right product
            effortless, with detailed specifications, genuine customer reviews, and personalised expert recommendations.
            From first-time buyers taking their first steps into the world of technology to seasoned professionals
            seeking the highest-performance tools - we are here for everyone. Join thousands of satisfied customers who
            trust TechnoWorld to power their digital lives, day after day.
        </p>
    </section>

    <div id="featuredCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#featuredCarousel" data-bs-slide-to="0" class="active"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#featuredCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#featuredCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-slide carousel-slide-1 home-banner">
                    <div class="carousel-slide-content home-banner-content">
                        <span class="tag">This Week Only</span>
                        <h2 class="display-5 fw-bold white-text">Saeco Royal Professional<br>Flash Price</h2>
                        <p class="lead white-text mb-4">Bring cafe-level espresso home with this premium automatic coffee maker.</p>
                        <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-light btn-lg px-4 text-primary-brand fw-600">Grab Saeco Deal</a>
                    </div>
                    <div class="home-banner-media">
                        <div class="home-banner-product-card">
                            <img src="/assets/products/coffee-maker/saeco-royal-professional/image.png" alt="Saeco Royal Professional coffee maker" class="home-banner-image home-banner-image-appliance">
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="carousel-slide carousel-slide-2 home-banner">
                    <div class="carousel-slide-content home-banner-content">
                        <span class="tag">Fast Delivery</span>
                        <h2 class="display-5 fw-bold white-text">Apple Watch 6<br>Delivered Fast</h2>
                        <p class="lead white-text mb-4">Order today and get this smartwatch quickly with express shipping options.</p>
                        <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-light btn-lg px-4 text-primary-brand fw-600">Shop Apple Watch 6</a>
                    </div>
                    <div class="home-banner-media">
                        <div class="home-banner-product-card">
                            <img src="/assets/products/watch/apple-watch-6/image.png" alt="Apple Watch Series 6" class="home-banner-image home-banner-image-watch">
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="carousel-slide carousel-slide-3 home-banner">
                    <div class="carousel-slide-content home-banner-content">
                        <span class="tag">Just Landed</span>
                        <h2 class="display-5 fw-bold white-text">Miele C3 Vacuum<br>Now in Store</h2>
                        <p class="lead white-text mb-4">A new stock of the Miele Complete C3 with powerful cleaning performance.</p>
                        <a href="{{ route('login') }}" data-auth-modal-target="login" class="btn btn-light btn-lg px-4 text-primary-brand fw-600">See New Miele Stock</a>
                    </div>
                    <div class="home-banner-media">
                        <div class="home-banner-product-card">
                            <img src="/assets/products/vacuum-cleaner/miele-c3/image.png" alt="Miele Complete C3 vacuum cleaner" class="home-banner-image home-banner-image-appliance">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section class="home-categories-section">
        <h2 class="home-categories-title">Categories</h2>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3">
            @foreach ($categories as $category)
                <div class="col">
                    <a href="{{ route('login') }}" data-auth-modal-target="login" class="home-category-card">
                        <div class="home-category-icon"><i class="bi {{ $category->icon }}"></i></div>
                        <span class="home-category-name">{{ $category->name }}</span>
                    </a>
                </div>
            @endforeach

        </div>
    </section>

    <footer>
        <div class="socials">
            <a href="https://www.linkedin.com/in/george-sladkovsky-537a27257/" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.linkedin.com/in/george-sladkovsky-537a27257/" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://www.linkedin.com/in/george-sladkovsky-537a27257/" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Twitter/X"><i class="bi bi-twitter-x"></i></a>
            <a href="https://www.linkedin.com/in/george-sladkovsky-537a27257/" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
        </div>
        <div class="pages">
            <a href="/" class="footer-link">Home</a>
            <a href="{{ route('privacy-policy') }}" class="footer-link">Privacy Policy</a>
            <a href="#about" class="footer-link">About</a>
        </div>
        <div class="emails">
            <p class="footer-email mb-1">xsladkovskyi@stuba.sk</p>
            <p class="footer-email mb-0">xsorochynskyi@stuba.sk</p>
        </div>
    </footer>

@endsection