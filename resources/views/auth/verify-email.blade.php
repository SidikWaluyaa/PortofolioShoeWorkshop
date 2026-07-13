<x-guest-layout>
    <x-slot name="pageTitle">Verifikasi Email</x-slot>

    <!-- Mobile‑only branding -->
    <div style="text-align:center;margin-bottom:1.75rem;" class="lg:hidden">
        <a href="{{ url('/') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:44px;width:auto;">
            <span style="font-weight:800;font-size:1.1rem;color:#111827;">ShoeWorkshop</span>
        </a>
    </div>

    <div style="text-align:center;">
        <div style="display:inline-flex;align-items:center;justify-content:center;width:64px;height:64px;border-radius:50%;background:#ecfdf5;color:#10b981;margin-bottom:1rem;">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:32px;height:32px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h1 style="font-size:1.5rem;font-weight:800;color:#111827;margin-bottom:0.5rem;">Cek Email Anda</h1>
        <p class="subtitle" style="margin-bottom:1.5rem;">
            Pendaftaran Anda berhasil! Namun, Anda perlu memverifikasi alamat email dengan mengklik tautan yang baru saja kami kirimkan. Hal ini diperlukan untuk mengakses Dashboard Member.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div style="margin-bottom:1.5rem;padding:1rem;background:#ecfdf5;border:1px solid #a7f3d0;border-radius:12px;color:#065f46;font-size:0.875rem;font-weight:600;text-align:center;">
            Tautan verifikasi baru telah dikirim ke email Anda!
        </div>
    @endif

    <div style="display:flex;flex-direction:column;gap:1rem;margin-top:1rem;">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-cta">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="width:100%;padding:0.875rem;border:2px solid #e5e7eb;border-radius:12px;background:white;color:#4b5563;font-size:0.9375rem;font-weight:700;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.borderColor='#d1d5db';this.style.color='#1f2937'" onmouseout="this.style.borderColor='#e5e7eb';this.style.color='#4b5563'">
                Keluar (Logout)
            </button>
        </form>
    </div>
</x-guest-layout>
