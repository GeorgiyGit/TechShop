<div data-auth-modal="login" hidden aria-hidden="true">
    <div class="login-overlay" data-auth-modal-backdrop aria-hidden="true"></div>
    <section class="login-modal-shell" aria-labelledby="auth-login-title">
        <div class="login-modal-card">
            <div class="login-modal-header">
                <div class="login-close-row">
                    <a href="{{ $returnTo }}" class="login-close" data-auth-modal-close aria-label="Close log in window">
                        <i class="bi bi-x-lg fs-3"></i>
                    </a>
                </div>
                <h1 class="login-title" id="auth-login-title">Log In</h1>
                <p
                    class="login-status-message @if ($authModal === 'login' && $errors->any()) login-error-message @else login-success-message @endif"
                    @if ($authModal !== 'login' || (!session('status') && !$errors->any())) hidden @endif>
                    @if ($authModal === 'login' && $errors->any())
                        {{ $errors->first() }}
                    @else
                        {{ session('status') }}
                    @endif
                </p>
            </div>

            <form class="login-form" action="{{ route('login.store') }}" method="POST">
                @csrf
                <input type="hidden" name="return_to" value="{{ $returnTo }}">
                <input type="email" class="login-input" name="email" id="auth-login-email" placeholder="Email" aria-label="Email" value="{{ old('email') }}" required>
                <input type="password" class="login-input" name="password" id="auth-login-password" placeholder="Password" aria-label="Password" required>
                <button type="submit" class="login-submit">Log In</button>
            </form>

            <p class="login-footer-text">Don't have an account? <a href="{{ route('signup.create') }}" data-auth-modal-switch="signup">Sign Up</a></p>
        </div>
    </section>
</div>

<div data-auth-modal="signup" hidden aria-hidden="true">
    <div class="signup-overlay" data-auth-modal-backdrop aria-hidden="true"></div>
    <section class="signup-modal-shell" aria-labelledby="auth-signup-title">
        <div class="signup-modal-card">
            <div class="signup-modal-header">
                <div class="signup-close-row">
                    <a href="{{ $returnTo }}" class="signup-close" data-auth-modal-close aria-label="Close sign up window">
                        <i class="bi bi-x-lg fs-3"></i>
                    </a>
                </div>
                <h1 class="signup-title" id="auth-signup-title">Sign Up</h1>
                <p
                    class="signup-status-message @if ($authModal === 'signup' && $errors->any()) signup-error-message @else signup-success-message @endif"
                    @if ($authModal !== 'signup' || (!session('status') && !$errors->any())) hidden @endif
                >
                    @if ($authModal === 'signup' && $errors->any())
                        {{ $errors->first() }}
                    @else
                        {{ session('status') }}
                    @endif
                </p>
            </div>

            <form class="signup-form" action="{{ route('signup.store') }}" method="POST">
                @csrf
                <input type="hidden" name="return_to" value="{{ $returnTo }}">
                <input type="hidden" name="name" id="auth-signup-name" value="{{ old('name') }}">
                <input type="email" class="signup-input" name="email" id="auth-signup-email" placeholder="Email" aria-label="Email" value="{{ old('email') }}" required>
                <input type="password" class="signup-input" name="password" id="auth-signup-password" placeholder="Password" aria-label="Password" required>
                <input type="password" class="signup-input" name="password_confirmation" id="auth-signup-password_confirmation" placeholder="Repeat password" aria-label="Repeat password" required>
                <button type="submit" class="signup-submit">Sign Up</button>
            </form>

            <p class="signup-footer-text">Already have an account? <a href="{{ route('login') }}" data-auth-modal-switch="login">Log In</a></p>
        </div>
    </section>
</div>
