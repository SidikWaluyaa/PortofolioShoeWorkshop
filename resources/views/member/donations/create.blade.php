<x-member-layout>
    <x-slot name="header">Donasikan Sepatu</x-slot>

    @include('member.donations._form', [
        'action' => route('member.donations.store'),
        'submitLabel' => 'Kirim Pengajuan Donasi',
    ])
</x-member-layout>
