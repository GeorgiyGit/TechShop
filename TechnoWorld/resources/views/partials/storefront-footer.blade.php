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
        <a href="{{ $aboutHref ?? (route('home') . '#about') }}" class="footer-link">About</a>
    </div>
    <div class="emails">
        <p class="footer-email mb-1">xsladkovskyi@stuba.sk</p>
        <p class="footer-email mb-0">xsorochynskyi@stuba.sk</p>
    </div>
</footer>
