<section>
    <header class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 bg-amber-500/10 rounded-xl flex items-center justify-center text-amber-500 border border-amber-500/20">
            <span class="material-symbols-outlined text-[20px]">lock</span>
        </div>
        <div>
            <h2 class="text-lg font-black text-gray-900 tracking-tight">
                Perbarui Kata Sandi
            </h2>
            <p class="text-xs font-medium text-gray-500 mt-0.5">
                Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6"
          x-data="{ 
              showCurrent: false,
              showPass: false, 
              showConfirm: false,
              password: '',
              get hasLength() { return this.password.length >= 8; },
              get hasLower() { return /[a-z]/.test(this.password); },
              get hasUpper() { return /[A-Z]/.test(this.password); },
              get hasNumber() { return /[0-9]/.test(this.password); },
              get hasSymbol() { return /[^A-Za-z0-9]/.test(this.password); },
              get score() {
                  let s = 0;
                  if (this.hasLength) s++;
                  if (this.hasLower && this.hasUpper) s++;
                  if (this.hasNumber) s++;
                  if (this.hasSymbol) s++;
                  return s;
              },
              get strengthLabel() {
                  if (this.score <= 1) return 'Lemah';
                  if (this.score === 2) return 'Cukup';
                  if (this.score === 3) return 'Kuat';
                  return 'Sangat Kuat';
              },
              get nextHint() {
                  if (!this.hasLength) return 'Min. 8 karakter';
                  if (!(this.hasLower && this.hasUpper)) return 'Pakai huruf besar & kecil';
                  if (!this.hasNumber) return 'Tambahkan angka';
                  if (!this.hasSymbol) return 'Tambahkan simbol';
                  return 'Sandi memenuhi syarat';
              },
              get activeColor() {
                  if (this.score <= 1) return '#ef4444';
                  if (this.score === 2) return '#f59e0b';
                  return '#10b981';
              },
              get barStyle() {
                  if (this.score <= 1) return 'background-color: #ef4444; box-shadow: 0 0 8px rgba(239,68,68,0.4);';
                  if (this.score === 2) return 'background-color: #f59e0b; box-shadow: 0 0 8px rgba(245,158,11,0.4);';
                  return 'background-color: #10b981; box-shadow: 0 0 8px rgba(16,185,129,0.4);';
              }
          }">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Kata Sandi Saat Ini</label>
            <div class="relative">
                <input id="update_password_current_password" :type="showCurrent ? 'text' : 'password'" name="current_password" autocomplete="current-password"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition pr-10" />
                <button type="button" @click="showCurrent = !showCurrent" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]" x-text="showCurrent ? 'visibility_off' : 'visibility'">visibility</span>
                </button>
            </div>
            @error('current_password', 'updatePassword')
                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="update_password_password" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                <div class="relative">
                    <input id="update_password_password" :type="showPass ? 'text' : 'password'" name="password" autocomplete="new-password" x-model="password"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition pr-10" />
                    <button type="button" @click="showPass = !showPass" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none flex items-center justify-center">
                        <span class="material-symbols-outlined text-[20px]" x-text="showPass ? 'visibility_off' : 'visibility'">visibility</span>
                    </button>
                </div>
                
                <div x-show="password.length > 0" x-transition class="mt-2" style="display: none;">
                    <div class="flex gap-1 h-1 w-full mb-1">
                        <div class="flex-1 rounded-full transition-all duration-300" :style="score >= 1 ? barStyle : 'background-color:#e5e7eb'"></div>
                        <div class="flex-1 rounded-full transition-all duration-300 delay-75" :style="score >= 2 ? barStyle : 'background-color:#e5e7eb'"></div>
                        <div class="flex-1 rounded-full transition-all duration-300 delay-150" :style="score >= 3 ? barStyle : 'background-color:#e5e7eb'"></div>
                        <div class="flex-1 rounded-full transition-all duration-300 delay-200" :style="score >= 4 ? barStyle : 'background-color:#e5e7eb'"></div>
                    </div>
                    <div class="flex justify-between items-center text-[10px]">
                        <span class="font-bold transition-colors duration-300" :style="'color:' + activeColor" x-text="strengthLabel"></span>
                        <span class="text-gray-500 font-medium transition-all duration-300" x-show="score < 4" x-text="nextHint"></span>
                        <span class="text-emerald-500 font-bold flex items-center gap-0.5" x-show="score === 4" style="display: none;">
                            <span class="material-symbols-outlined text-[12px]">check</span> Sempurna!
                        </span>
                    </div>
                </div>

                @error('password', 'updatePassword')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="update_password_password_confirmation" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Konfirmasi Kata Sandi Baru</label>
                <div class="relative">
                    <input id="update_password_password_confirmation" :type="showConfirm ? 'text' : 'password'" name="password_confirmation" autocomplete="new-password"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition pr-10" />
                    <button type="button" @click="showConfirm = !showConfirm" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none flex items-center justify-center">
                        <span class="material-symbols-outlined text-[20px]" x-text="showConfirm ? 'visibility_off' : 'visibility'">visibility</span>
                    </button>
                </div>
                @error('password_confirmation', 'updatePassword')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="px-6 py-2.5 bg-gray-900 text-white text-sm font-bold rounded-xl hover:bg-gray-800 transition shadow-lg shadow-gray-900/20 flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">key</span>
                Ubah Kata Sandi
            </button>


        </div>
    </form>
</section>
