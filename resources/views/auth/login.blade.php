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
        <div style="margin-bottom:1rem;" x-data="{ showPass: false }">
            <label for="password" class="auth-label">Kata Sandi Aman</label>
            <div style="position:relative;">
                <input id="password" :type="showPass ? 'text' : 'password'" name="password" required autocomplete="current-password"
                       class="auth-input" style="padding-right:2.5rem;" placeholder="••••••••">
                <button type="button" @click="showPass = !showPass" style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);color:#9ca3af;background:none;border:none;cursor:pointer;padding:0;">
                    <svg x-show="!showPass" style="width:20px;height:20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    <svg x-show="showPass" style="width:20px;height:20px;display:none;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.978 9.978 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                </button>
            </div>
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
            <a href="{{ route('register') }}" class="auth-link" style="margin-left:4px;">Daftar sebagai Member</a>
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
