<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.reviews.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <span>Edit Review – {{ $review->name }}</span>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('admin.reviews.update', $review) }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-6">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Pelanggan <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $review->name) }}" required
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $review->location) }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Rating <span class="text-red-500">*</span></label>
                <div class="flex gap-3">
                    @for($i = 5; $i >= 1; $i--)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="rating" value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'checked' : '' }} class="text-[#22AF85]">
                        <span class="text-sm font-semibold">{{ $i }} ★</span>
                    </label>
                    @endfor
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Isi Review <span class="text-red-500">*</span></label>
                <textarea name="content" rows="4" required
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20">{{ old('content', $review->content) }}</textarea>
                @error('content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Urutan Tampil</label>
                    <input type="number" name="order" value="{{ old('order', $review->order) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20">
                </div>
                <div class="flex items-end pb-1">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $review->is_active) ? 'checked' : '' }}
                               class="w-5 h-5 text-[#22AF85] border-gray-300 rounded focus:ring-[#22AF85]">
                        <span class="text-sm font-bold text-gray-700">Tampilkan di website</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 pt-2 border-t border-gray-100">
                <button type="submit" class="px-6 py-3 bg-[#22AF85] text-white text-sm font-bold rounded-xl hover:bg-[#178a67] transition-colors">
                    Update Review
                </button>
                <a href="{{ route('admin.reviews.index') }}" class="px-6 py-3 border border-gray-200 text-sm font-bold text-gray-600 rounded-xl hover:bg-gray-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>