<x-guest-layout>
    <x-slot name="pageTitle">Masuk ke Portal Donasi</x-slot>

    <!-- Mobile‑only branding -->
    <div style="text-align:center;margin-bottom:2rem;" class="lg:hidden">
        <a href="{{ url('/') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:44px;width:auto;">
            <span style="font-weight:800;font-size:1.1rem;color:#111827;">ShoeWorkshop</span>
        </a>
    </div>

    <!-- Heading -->
    <h1>Selamat datang kembali</h1>
    <p class="subtitle">Masuk untuk mengelola donasi Anda dan melacak alur reparasi sepatu.</p>

    <!-- Session Status -->
    @if (session('status'))
        <div style="margin-top:1rem;padding:0.75rem 1rem;background:#ecfdf5;border:1px solid #a7f3d0;border-radius:10px;color:#065f46;font-size:0.8125rem;font-weight:500;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" style="margin-top:1.75rem;">
        @csrf

        <!-- Email -->
        <div style="margin-bottom:1.25rem;">
            <label for="email" class="auth-label">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="auth-input" placeholder="nama@email.com">
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div style="margin-bottom:1rem;">
            <label for="password" class="auth-label">Kata Sandi Aman</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="auth-input" placeholder="••••••••">
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember + Forgot -->
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.75rem;">
            <label for="remember_me" style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                <input id="remember_me" type="checkbox" name="remember" class="auth-check">
                <span style="font-size:0.8125rem;color:#374151;font-weight:500;">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link">Lupa Kata Sandi?</a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-cta">
            Masuk ke Portal
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </button>
    </form>

    <!-- Register link -->
    @if (Route::has('register'))
        <div class="auth-divider">atau</div>
        <div style="text-align:center;">
            <span style="font-size:0.8125rem;color:#6b7280;">Belum punya akun?</span>
            <a href="{{ route('register') }}" class="auth-link" style="margin-left:4px;">Daftar sebagai Donatur</a>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const rememberCheckbox = document.getElementById('remember_me');
            const form = rememberCheckbox ? rememberCheckbox.closest('form') : null;

            if (emailInput && passwordInput && rememberCheckbox && form) {
                // Load credentials if they exist in localStorage
                const savedEmail = localStorage.getItem('remembered_email');
                const savedPassword = localStorage.getItem('remembered_password');

                if (savedEmail) {
                    emailInput.value = savedEmail;
                    rememberCheckbox.checked = true;
                    if (savedPassword) {
                        passwordInput.value = savedPassword;
                    }
                }

                // Listen for form submit to store or clear credentials
                form.addEventListener('submit', function() {
                    if (rememberCheckbox.checked) {
                        localStorage.setItem('remembered_email', emailInput.value);
                        localStorage.setItem('remembered_password', passwordInput.value);
                    } else {
                        localStorage.removeItem('remembered_email');
                        localStorage.removeItem('remembered_password');
                    }
                });
            }
        });
    </script>
</x-guest-layout>
