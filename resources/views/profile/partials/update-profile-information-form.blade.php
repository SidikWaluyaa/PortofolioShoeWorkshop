@php
    /** @var \App\Models\User $user */
@endphp
<section>
    <header class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 bg-[#22AF85]/10 rounded-xl flex items-center justify-center text-[#22AF85] border border-[#22AF85]/20">
            <span class="material-symbols-outlined text-[20px]">person</span>
        </div>
        <div>
            <h2 class="text-lg font-black text-gray-900 tracking-tight">
                Informasi Profil
            </h2>
            <p class="text-xs font-medium text-gray-500 mt-0.5">
                Perbarui informasi profil dan alamat email akun Anda.
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Avatar Field --}}
        <div>
            <label for="avatar" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Foto Profil (Avatar)</label>
            <div class="mt-2 flex items-center gap-5">
                <div class="relative group">
                    @if ($user->avatar_path)
                        <img id="avatar-preview" src="{{ asset('storage/' . $user->avatar_path) }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-2xl object-cover border-2 border-gray-100 shadow-sm transition group-hover:border-[#22AF85]/50">
                    @else
                        <div id="avatar-preview-placeholder" class="w-20 h-20 rounded-2xl bg-gray-50 flex items-center justify-center border-2 border-dashed border-gray-200 text-gray-400 font-black text-2xl shadow-sm transition group-hover:border-[#22AF85]/50 group-hover:text-[#22AF85]">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center border border-gray-100 text-gray-500 group-hover:text-[#22AF85] pointer-events-none">
                        <span class="material-symbols-outlined text-[16px]">photo_camera</span>
                    </div>
                </div>
                
                <div class="flex-1">
                    <input type="file" id="avatar" name="avatar" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#22AF85]/10 file:text-[#22AF85] hover:file:bg-[#22AF85]/20 file:transition file:cursor-pointer cursor-pointer" />
                    <p class="text-[10px] text-gray-400 font-medium mt-1">Format JPG, PNG, atau GIF (Maks. 2MB)</p>
                </div>
            </div>
            @error('avatar')
                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autocomplete="name"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition" />
                @error('name')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Nomor Telepon</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition" />
                @error('phone')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="email" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Alamat Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition" />
            @error('email')
                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
            @enderror

            @if ($user instanceof \App\Models\User && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-amber-50 border border-amber-100 rounded-xl flex items-start gap-3">
                    <span class="material-symbols-outlined text-amber-500 text-[18px]">warning</span>
                    <div>
                        <p class="text-xs font-bold text-amber-800">Email Anda belum diverifikasi.</p>
                        <button form="send-verification" class="text-xs font-bold text-amber-600 hover:text-amber-700 underline mt-1 transition">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-1 font-bold text-[10px] text-emerald-600">
                                Link verifikasi baru telah dikirim ke email Anda!
                            </p>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="px-6 py-2.5 bg-[#22AF85] text-white text-sm font-bold rounded-xl hover:bg-[#1a936f] transition shadow-lg shadow-[#22AF85]/30 flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">save</span>
                Simpan Perubahan
            </button>


        </div>
    </form>
</section>
