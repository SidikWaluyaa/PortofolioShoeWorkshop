<x-guest-layout>
    <x-slot name="pageTitle">Daftar sebagai Member</x-slot>

    <!-- Mobile‑only branding -->
    <div style="text-align:center;margin-bottom:1.75rem;" class="lg:hidden">
        <a href="{{ url('/') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:44px;width:auto;">
            <span style="font-weight:800;font-size:1.1rem;color:#111827;">ShoeWorkshop</span>
        </a>
    </div>

    <!-- Heading -->
    <h1>Bergabung sebagai Member</h1>
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
            <p class="auth-hint">Contoh: 8123456789 (11-13 digit angka, tanpa awalan 0 atau +62)</p>
            @error('phone')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password row (two‑column on wider screens) -->
        <div style="display:grid;grid-template-columns:1fr;gap:1rem;margin-bottom:1.5rem;" 
             x-data="{ 
                 showPass: false, 
                 showConfirm: false,
                 password: '',
                 // Mirrors the server rule: min. 8 characters, at least one letter and one number.
                 get hasLength() { return this.password.length >= 8; },
                 get hasLetter() { return /[A-Za-z]/.test(this.password); },
                 get hasNumber() { return /[0-9]/.test(this.password); },
                 get score() {
                     return [this.hasLength, this.hasLetter, this.hasNumber].filter(Boolean).length;
                 },
                 get strengthLabel() {
                     if (this.score <= 1) return 'Lemah';
                     if (this.score === 2) return 'Cukup';
                     return 'Kuat';
                 },
                 get nextHint() {
                     if (!this.hasLength) return 'Min. 8 karakter';
                     if (!this.hasLetter) return 'Tambahkan huruf';
                     if (!this.hasNumber) return 'Tambahkan angka';
                     return '';
                 },
                 get activeColor() {
                     if (this.score <= 1) return '#ef4444';
                     if (this.score === 2) return '#f59e0b';
                     return '#10b981';
                 },
                 // Object (not string) so Alpine merges it with the bar's static flex/radius styles.
                 barStyle(n) {
                     if (this.score < n) return { backgroundColor: '#e5e7eb', boxShadow: 'none' };
                     return { backgroundColor: this.activeColor, boxShadow: '0 0 8px ' + this.activeColor + '66' };
                 }
             }">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:1rem;">
                <!-- Password -->
                <div>
                    <label for="password" class="auth-label">Kata Sandi</label>
                    <div style="position:relative;">
                        <input id="password" :type="showPass ? 'text' : 'password'" name="password" required autocomplete="new-password"
                               x-model="password"
                               class="auth-input" style="padding-right:2.5rem;" placeholder="Min. 8 karakter">
                        <button type="button" @click="showPass = !showPass" style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);color:#9ca3af;background:none;border:none;cursor:pointer;padding:0;">
                            <svg x-show="!showPass" style="width:20px;height:20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            <svg x-show="showPass" style="width:20px;height:20px;display:none;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.978 9.978 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                        </button>
                    </div>
                    <div x-show="password.length > 0" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         style="display: none; margin-top: 0.25rem;">
                        
                        <!-- Premium Thin Progress Bar -->
                        <div style="display: flex; gap: 4px; height: 4px; width: 100%; margin-bottom: 0.25rem;">
                            <div style="flex: 1; border-radius: 999px; transition: all 0.4s ease-out;" :style="barStyle(1)"></div>
                            <div style="flex: 1; border-radius: 999px; transition: all 0.4s ease-out 0.05s;" :style="barStyle(2)"></div>
                            <div style="flex: 1; border-radius: 999px; transition: all 0.4s ease-out 0.1s;" :style="barStyle(3)"></div>
                        </div>

                        <!-- Dynamic Single Line Hint -->
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.7rem;">
                            <span style="font-weight: 700; transition: color 0.4s; display: flex; align-items: center; gap: 4px;" :style="{ color: activeColor }">
                                <svg x-show="score === 3" style="width:12px;height:12px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <span x-text="strengthLabel"></span>
                            </span>

                            <span style="color: #6b7280; font-weight: 500; transition: all 0.3s;" x-show="score < 3" x-text="nextHint"></span>
                        </div>
                    </div>
                    @error('password')
                        <p class="auth-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="auth-label">Konfirmasi Sandi</label>
                    <div style="position:relative;">
                        <input id="password_confirmation" :type="showConfirm ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password"
                               class="auth-input" style="padding-right:2.5rem;" placeholder="Ulangi kata sandi">
                        <button type="button" @click="showConfirm = !showConfirm" style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);color:#9ca3af;background:none;border:none;cursor:pointer;padding:0;">
                            <svg x-show="!showConfirm" style="width:20px;height:20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            <svg x-show="showConfirm" style="width:20px;height:20px;display:none;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.978 9.978 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                        </button>
                    </div>
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
