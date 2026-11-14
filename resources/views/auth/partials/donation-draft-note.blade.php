{{-- Shown on login, register and verify-email when the visitor filled in the Adapt & Adopt donation form as a guest --}}
@php $pendingDraft = \App\Models\DonationDraft::fromSession(auth()->user()) ?? (auth()->check() ? \App\Models\DonationDraft::where('user_id', auth()->id())->latest('id')->first() : null); @endphp
@if($pendingDraft)
    <div style="margin:1.25rem 0 0;padding:0.875rem 1rem;background:#F5DABF;border-radius:12px;color:#0F3D3B;font-size:0.8125rem;line-height:1.5;">
        <strong>Donasi {{ $pendingDraft->data['nama_sepatu'] }} sudah kami simpan.</strong>
        {{ $verifyStep ?? false
            ? 'Setelah kamu klik link verifikasi di email, kamu langsung diarahkan untuk mengirimnya.'
            : 'Setelah ini kamu langsung diarahkan untuk mengirimnya.' }}
    </div>
@endif
