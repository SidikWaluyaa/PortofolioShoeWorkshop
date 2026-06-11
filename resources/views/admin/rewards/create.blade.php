<x-app-layout>
    <x-slot name="header">Tambah Reward</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <form action="{{ route('admin.rewards.store') }}" method="POST">
                @csrf
                @include('admin.rewards._form')

                <div class="flex items-center gap-4 mt-6">
                    <button type="submit" class="px-8 py-3 bg-[#22AF85] text-white text-sm font-bold rounded-xl hover:bg-[#1d9a75] transition shadow-md">Simpan Reward</button>
                    <a href="{{ route('admin.rewards.index') }}" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
