<x-guest-layout>
    <x-slot name="pageTitle">Lupa Kata Sandi</x-slot>

    <!-- Mobile‑only branding -->
    <div style="text-align:center;margin-bottom:1.75rem;" class="lg:hidden">
        <a href="{{ url('/') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:44px;width:auto;">
            <span style="font-weight:800;font-size:1.1rem;color:#111827;">ShoeWorkshop</span>
        </a>
    </div>

    <h1>Lupa Kata Sandi?</h1>
    <p class="subtitle">Tidak masalah. Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi.</p>

    <!-- Session Status -->
    @if (session('status'))
        <div style="margin-top:1rem;padding:0.75rem 1rem;background:#ecfdf5;border:1px solid #a7f3d0;border-radius:10px;color:#065f46;font-size:0.8125rem;font-weight:500;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" style="margin-top:1.75rem;">
        @csrf

        <div style="margin-bottom:1.5rem;">
            <label for="email" class="auth-label">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="auth-input" placeholder="nama@email.com">
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-cta">
            Kirim Tautan Reset
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </button>
    </form>

    <div style="text-align:center;margin-top:1.5rem;">
        <a href="{{ route('login') }}" class="auth-link">← Kembali ke halaman masuk</a>
    </div>
</x-guest-layout>
