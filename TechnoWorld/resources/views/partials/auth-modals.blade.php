<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="auth-login-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="login-modal-card modal-content border-0">
            <div class="login-modal-header">
                <div class="login-close-row">
                    <button type="button" class="login-close" data-bs-dismiss="modal" aria-label="Close log in window">
                        <i class="bi bi-x-lg fs-3"></i>
                    </button>
                </div>
                <h1 class="login-title" id="auth-login-title">Log In</h1>
                <p class="login-status-message @if ($authModal === 'login' && $errors->any()) login-error-message @else login-success-message @endif"
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
                <input type="email" class="login-input" name="email" id="auth-login-email" placeholder="Email"
                    aria-label="Email" value="{{ old('email') }}" required>
                <input type="password" class="login-input" name="password" id="auth-login-password"
                    placeholder="Password" aria-label="Password" required>
                <button type="submit" class="login-submit">Log In</button>
            </form>

            <p class="login-footer-text">Don't have an account? <a href="{{ route('signup.create') }}"
                    data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Sign Up</a></p>
        </div>
    </div>
</div>

<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="auth-signup-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="signup-modal-card modal-content border-0">
            <div class="signup-modal-header">
                <div class="signup-close-row">
                    <button type="button" class="signup-close" data-bs-dismiss="modal"
                        aria-label="Close sign up window">
                        <i class="bi bi-x-lg fs-3"></i>
                    </button>
                </div>
                <h1 class="signup-title" id="auth-signup-title">Sign Up</h1>
                <p class="signup-status-message @if ($authModal === 'signup' && $errors->any()) signup-error-message @else signup-success-message @endif"
                    @if ($authModal !== 'signup' || (!session('status') && !$errors->any())) hidden @endif>
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
                <input type="email" class="signup-input" name="email" id="auth-signup-email" placeholder="Email"
                    aria-label="Email" value="{{ old('email') }}" required>
                <input type="password" class="signup-input" name="password" id="auth-signup-password"
                    placeholder="Password" aria-label="Password" required>
                <input type="password" class="signup-input" name="password_confirmation"
                    id="auth-signup-password_confirmation" placeholder="Repeat password" aria-label="Repeat password"
                    required>
                <button type="submit" class="signup-submit">Sign Up</button>
            </form>

            <p class="signup-footer-text">Already have an account? <a href="{{ route('login') }}" data-bs-toggle="modal"
                    data-bs-target="#loginModal" data-bs-dismiss="modal">Log In</a></p>
        </div>
    </div>
</div>