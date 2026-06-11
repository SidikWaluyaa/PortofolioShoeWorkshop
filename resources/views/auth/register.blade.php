<x-guest-layout>
    <x-slot name="pageTitle">Daftar sebagai Donatur</x-slot>

    <!-- Mobile‑only branding -->
    <div style="text-align:center;margin-bottom:1.75rem;" class="lg:hidden">
        <a href="{{ url('/') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:44px;width:auto;">
            <span style="font-weight:800;font-size:1.1rem;color:#111827;">ShoeWorkshop</span>
        </a>
    </div>

    <!-- Heading -->
    <h1>Bergabung sebagai Donatur</h1>
    <p class="subtitle">Daftarkan akun Anda untuk mulai berdonasi sepatu dan melacak riwayat reparasi secara real‑time.</p>

    <form method="POST" action="{{ route('register') }}" style="margin-top:1.5rem;">
        @csrf

        <!-- Name -->
        <div style="margin-bottom:1.125rem;">
            <label for="name" class="auth-label">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="auth-input" placeholder="Masukkan nama lengkap Anda">
            @error('name')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div style="margin-bottom:1.125rem;">
            <label for="email" class="auth-label">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="auth-input" placeholder="nama@email.com">
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone Number -->
        <div style="margin-bottom:1.125rem;">
            <label for="phone" class="auth-label">Nomor Telepon (WhatsApp)</label>
            <div style="position:relative;">
                <span class="phone-prefix">+62</span>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}"
                       class="auth-input" style="padding-left:3.25rem;" placeholder="8123456789">
            </div>
            <p class="auth-hint">Contoh: 8123456789 — tanpa awalan 0 atau +62</p>
            @error('phone')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password row (two‑column on wider screens) -->
        <div style="display:grid;grid-template-columns:1fr;gap:1rem;margin-bottom:1.5rem;">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:1rem;">
                <!-- Password -->
                <div>
                    <label for="password" class="auth-label">Kata Sandi</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="auth-input" placeholder="Min. 8 karakter">
                    @error('password')
                        <p class="auth-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="auth-label">Konfirmasi Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="auth-input" placeholder="Ulangi kata sandi">
                    @error('password_confirmation')
                        <p class="auth-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-cta">
            Daftar & Mulai Berdonasi
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </button>
    </form>

    <!-- Login link -->
    <div class="auth-divider">atau</div>
    <div style="text-align:center;">
        <span style="font-size:0.8125rem;color:#6b7280;">Sudah punya akun?</span>
        <a href="{{ route('login') }}" class="auth-link" style="margin-left:4px;">Masuk di sini</a>
    </div>
</x-guest-layout>
