@if(session('success') || session('error') || session('warning') || session('info') || $errors->any())
    <div id="global-toast-container" class="fixed top-4 right-4 z-50 flex flex-col gap-3 pointer-events-none w-full max-w-sm">
        @if(session('success'))
            <div class="toast-message pointer-events-auto flex items-start gap-3 px-5 py-4 rounded-2xl shadow-2xl text-white text-sm font-medium bg-emerald-600 transform translate-x-full opacity-0 transition-all duration-300 ease-out">
                <span class="text-lg flex-shrink-0 mt-0.5">✅</span>
                <span class="leading-relaxed flex-1">{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-white/70 hover:text-white text-lg font-bold flex-shrink-0 ml-2">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="toast-message pointer-events-auto flex items-start gap-3 px-5 py-4 rounded-2xl shadow-2xl text-white text-sm font-medium bg-red-600 transform translate-x-full opacity-0 transition-all duration-300 ease-out">
                <span class="text-lg flex-shrink-0 mt-0.5">❌</span>
                <span class="leading-relaxed flex-1">{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-white/70 hover:text-white text-lg font-bold flex-shrink-0 ml-2">&times;</button>
            </div>
        @endif

        @if(session('warning'))
            <div class="toast-message pointer-events-auto flex items-start gap-3 px-5 py-4 rounded-2xl shadow-2xl text-white text-sm font-medium bg-amber-500 transform translate-x-full opacity-0 transition-all duration-300 ease-out">
                <span class="text-lg flex-shrink-0 mt-0.5">⚠️</span>
                <span class="leading-relaxed flex-1">{{ session('warning') }}</span>
                <button onclick="this.parentElement.remove()" class="text-white/70 hover:text-white text-lg font-bold flex-shrink-0 ml-2">&times;</button>
            </div>
        @endif

        @if(session('info'))
            <div class="toast-message pointer-events-auto flex items-start gap-3 px-5 py-4 rounded-2xl shadow-2xl text-white text-sm font-medium bg-slate-700 transform translate-x-full opacity-0 transition-all duration-300 ease-out">
                <span class="text-lg flex-shrink-0 mt-0.5">ℹ️</span>
                <span class="leading-relaxed flex-1">{{ session('info') }}</span>
                <button onclick="this.parentElement.remove()" class="text-white/70 hover:text-white text-lg font-bold flex-shrink-0 ml-2">&times;</button>
            </div>
        @endif

        @if($errors->any())
            <div class="toast-message pointer-events-auto flex items-start gap-3 px-5 py-4 rounded-2xl shadow-2xl text-white text-sm font-medium bg-red-600 transform translate-x-full opacity-0 transition-all duration-300 ease-out">
                <span class="text-lg flex-shrink-0 mt-0.5">❌</span>
                <div class="leading-relaxed flex-1">
                    <p class="font-bold mb-1">Terjadi Kesalahan Validasi:</p>
                    <ul class="list-disc list-inside text-xs">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="this.parentElement.remove()" class="text-white/70 hover:text-white text-lg font-bold flex-shrink-0 ml-2">&times;</button>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toasts = document.querySelectorAll('.toast-message');
            toasts.forEach((toast, index) => {
                // Animate in with a slight delay for each toast
                setTimeout(() => {
                    requestAnimationFrame(() => {
                        toast.classList.remove('translate-x-full', 'opacity-0');
                        toast.classList.add('translate-x-0', 'opacity-100');
                    });
                }, index * 100 + 50);

                // Auto dismiss after 6 seconds
                setTimeout(() => {
                    toast.classList.remove('translate-x-0', 'opacity-100');
                    toast.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => toast.remove(), 300);
                }, 6000 + (index * 100));
            });
        });
    </script>
@endif
