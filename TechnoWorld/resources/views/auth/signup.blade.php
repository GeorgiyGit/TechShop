<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechnoWorld - Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/signup.css', 'resources/js/signup.js'])
</head>
<body class="signup-screen">
    <div class="signup-page-content"></div>

    <div class="signup-overlay" aria-hidden="true"></div>

    <section class="signup-modal-shell" aria-labelledby="signup-title">
        <div class="signup-modal-card">
            <div class="signup-modal-header">
                <div class="signup-close-row">
                    <a href="{{ $returnTo }}" class="signup-close" aria-label="Close sign up window">
                        <i class="bi bi-x-lg fs-3"></i>
                    </a>
                </div>
                <h1 class="signup-title" id="signup-title">Sign Up</h1>
                <p
                    class="signup-status-message @if ($errors->any()) signup-error-message @else signup-success-message @endif"
                    @if (!session('status') && !$errors->any()) hidden @endif
                >
                    @if ($errors->any())
                        {{ $errors->first() }}
                    @else
                        {{ session('status') }}
                    @endif
                </p>
            </div>

            <form class="signup-form" action="{{ route('signup.store') }}" method="POST">
                @csrf
                <input type="hidden" name="return_to" value="{{ $returnTo }}">
                <input type="hidden" name="name" id="signup-name" value="{{ old('name') }}">
                <input type="email" class="signup-input" name="email" id="email" placeholder="Email" aria-label="Email" value="{{ old('email') }}" required>
                <input type="password" class="signup-input" name="password" id="password" placeholder="Password" aria-label="Password" required>
                <input type="password" class="signup-input" name="password_confirmation" id="password_confirmation" placeholder="Repeat password" aria-label="Repeat password" required>
                <button type="submit" class="signup-submit">Sign Up</button>
            </form>

            <p class="signup-footer-text">Already have an account? <a href="{{ route('login', ['return_to' => $returnTo]) }}">Log In</a></p>
    </section>
</body>
</html>