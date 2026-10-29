<x-member-layout>
    <x-slot name="header">Ubah Data Donasi</x-slot>

    @include('member.donations._form', [
        'donation' => $donation,
        'action' => route('member.donations.update', $donation),
        'submitLabel' => 'Simpan Perubahan',
    ])
</x-member-layout>
