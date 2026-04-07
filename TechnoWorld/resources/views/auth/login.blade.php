<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechnoWorld - Log In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/login.css'])
</head>
<body class="login-screen">
    <div class="login-page-content"></div>

    <div class="login-overlay" aria-hidden="true"></div>

    <section class="login-modal-shell" aria-labelledby="login-title">
        <div class="login-modal-card">
            <div class="login-modal-header">
                <div class="login-close-row">
                    <a href="{{ route('home') }}" class="login-close" aria-label="Close log in window">
                        <i class="bi bi-x-lg fs-3"></i>
                    </a>
                </div>
                <h1 class="login-title" id="login-title">Log In</h1>
                <p
                    class="login-status-message @if ($errors->any()) login-error-message @else login-success-message @endif"
                    @if (!session('status') && !$errors->any()) hidden @endif
                >
                    @if ($errors->any())
                        {{ $errors->first() }}
                    @else
                        {{ session('status') }}
                    @endif
                </p>
            </div>

            <form class="login-form" action="{{ route('login.store') }}" method="POST">
                @csrf
                <input type="email" class="login-input" name="email" id="email" placeholder="Email" aria-label="Email" value="{{ old('email') }}" required>
                <input type="password" class="login-input" name="password" id="password" placeholder="Password" aria-label="Password" required>
                <button type="submit" class="login-submit">Log In</button>
            </form>

            <p class="login-footer-text">Don't have an account? <a href="{{ route('signup.create') }}">Sign Up</a></p>
        </div>
    </section>
</body>
</html>
