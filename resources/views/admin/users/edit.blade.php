<x-app-layout>
<div class="space-y-6 max-w-4xl mx-auto">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-indigo-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Edit Pengguna</h1>
            </div>
            <p class="text-sm text-gray-500 mt-1 ml-8">Ubah informasi profil atau hak akses pengguna.</p>
        </div>
        
        @if($user->is_active)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span> Akun Aktif
            </span>
        @else
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 border border-red-200">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span> Akun Suspended
            </span>
        @endif
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat {{ $errors->count() }} kesalahan:</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @csrf
        @method('PUT')
        
        <div class="p-6 md:p-8 space-y-8">
            {{-- Personal Info Section --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3 mb-5">Informasi Pribadi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors">
                    </div>
                </div>
            </div>

            {{-- Account Section --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3 mb-5">Pengaturan Akun</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors">
                    </div>
                    
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role / Hak Akses <span class="text-red-500">*</span></label>
                        @if(auth()->id() === $user->id)
                            <select disabled class="w-full rounded-xl border-gray-300 shadow-sm bg-gray-100 text-gray-500 cursor-not-allowed">
                                <option value="{{ $user->role }}">{{ ucfirst($user->role) }} (Anda sendiri)</option>
                            </select>
                            <input type="hidden" name="role" value="{{ $user->role }}">
                            <p class="text-xs text-gray-500 mt-1">Anda tidak dapat mengubah role Anda sendiri.</p>
                        @else
                            <select name="role" id="role" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors">
                                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Member</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                @if(auth()->user()->role === 'super_admin')
                                    <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                @endif
                            </select>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Security Section --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3 mb-5">Keamanan (Opsional)</h3>
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-5">
                    <label for="password" class="block text-sm font-medium text-amber-900 mb-2">Reset Password</label>
                    <input type="text" name="password" id="password" minlength="8" placeholder="Kosongkan jika tidak ingin mereset password"
                        class="w-full rounded-xl border-amber-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 bg-white transition-colors">
                    <p class="text-xs text-amber-700 mt-2">Jika Anda mengisi kolom ini, password pengguna akan diubah. Pastikan Anda memberi tahu pengguna mengenai password baru mereka.</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-50/80 px-6 md:px-8 py-5 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-200 rounded-xl transition-colors">
                Batal
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-medium transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
</x-app-layout>
