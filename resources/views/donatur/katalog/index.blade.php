<x-donatur-layout>
    <x-slot name="header">Katalog Donasi</x-slot>

    <div x-data="catalogApp()" x-init="initApp()" class="space-y-6 pb-12">
        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filter -->
            <aside class="lg:col-span-1 space-y-6">
                <!-- Search Bar -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 !text-[18px]">search</span>
                        Cari Barang
                    </h3>
                    <div class="flex items-center bg-gray-50 rounded-xl px-4 py-3 border border-gray-200 focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-500 transition-all">
                        <input type="text" x-model="search" @input.debounce.300ms="fetchFilter()"
                               placeholder="Nama atau brand..." class="bg-transparent border-none p-0 focus:ring-0 text-sm w-full text-gray-700 placeholder-gray-400"/>
                    </div>
                </div>

                <!-- Kategori Filter -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 !text-[18px]">category</span>
                        Kategori
                    </h3>
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="kategori_filter" :checked="category === ''" @change="setCategory('')"
                                   class="w-5 h-5 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Semua Kategori</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="kategori_filter" :checked="category === 'sepatu'" @change="setCategory('sepatu')"
                                   class="w-5 h-5 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Sepatu</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="kategori_filter" :checked="category === 'tas'" @change="setCategory('tas')"
                                   class="w-5 h-5 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Tas</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="kategori_filter" :checked="category === 'topi'" @change="setCategory('topi')"
                                   class="w-5 h-5 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Topi</span>
                        </label>
                    </div>
                </div>

                <!-- Kondisi Filter -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 !text-[18px]">verified</span>
                        Kondisi
                    </h3>
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="kondisi_filter" :checked="condition === ''" @change="setCondition('')"
                                   class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Semua Kondisi</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="kondisi_filter" :checked="condition === 'baru'" @change="setCondition('baru')"
                                   class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Baru</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="kondisi_filter" :checked="condition === 'seperti_baru'" @change="setCondition('seperti_baru')"
                                   class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Like New</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="kondisi_filter" :checked="condition === 'sudah_diperbaiki'" @change="setCondition('sudah_diperbaiki')"
                                   class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Refurbished</span>
                        </label>
                    </div>
                </div>
            </aside>

            <!-- Product Grid Area -->
            <div class="lg:col-span-3 relative">
                <!-- Loading Overlay -->
                <div x-show="loading" x-transition class="absolute inset-0 bg-white/70 z-10 flex items-center justify-center rounded-2xl" style="display: none;">
                    <div class="flex flex-col items-center gap-3">
                        <svg class="animate-spin h-8 w-8 text-emerald-500" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-wider">Memuat data...</span>
                    </div>
                </div>

                <!-- Items Container -->
                <div id="item-grid-container">
                    @include('donatur.katalog.partials.item-grid', ['items' => $items])
                </div>
            </div>
        </div>

        <!-- Detail Modal -->
        <div x-show="detailOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" style="display: none;" x-cloak>
            <div class="bg-white rounded-2xl max-w-4xl w-full overflow-hidden relative shadow-2xl flex flex-col md:flex-row max-h-[90vh] md:max-h-none overflow-y-auto">
                <!-- Close Button -->
                <button class="absolute top-4 right-4 z-10 p-2 bg-white/95 rounded-full hover:bg-gray-100 border border-gray-200 flex items-center justify-center shadow-sm" @click="closeDetail()">
                    <span class="material-symbols-outlined text-gray-600">close</span>
                </button>
                
                <!-- Left Column: Photo View -->
                <div class="w-full md:w-1/2 bg-gray-50 p-6 border-b md:border-b-0 md:border-r border-gray-100 flex flex-col space-y-4 justify-center">
                    <div class="flex-grow aspect-[4/3] rounded-xl border border-gray-200 overflow-hidden bg-white relative flex items-center justify-center p-4">
                        <img :src="activeImage" :alt="activeItem?.nama" class="max-h-full max-w-full object-contain">
                    </div>
                    <!-- Detail thumbs -->
                    <div class="flex gap-2 overflow-x-auto py-1">
                        <button @click="activeImage = activeItem ? activeItem.foto_utama_url : ''"
                                :class="activeImage === (activeItem ? activeItem.foto_utama_url : '') ? 'border-2 border-emerald-500' : 'border border-gray-200 hover:border-emerald-500'"
                                class="w-14 h-14 rounded-lg overflow-hidden bg-white flex-shrink-0 p-1 flex items-center justify-center">
                            <img :src="activeItem ? activeItem.foto_utama_url : ''" class="max-h-full max-w-full object-contain">
                        </button>
                        <template x-for="(photoUrl, idx) in activeItem?.foto_detail_urls" :key="idx">
                            <button @click="activeImage = photoUrl"
                                    :class="activeImage === photoUrl ? 'border-2 border-emerald-500' : 'border border-gray-200 hover:border-emerald-500'"
                                    class="w-14 h-14 rounded-lg overflow-hidden bg-white flex-shrink-0 p-1 flex items-center justify-center">
                                <img :src="photoUrl" class="max-h-full max-w-full object-contain">
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Right Column: Detail Info -->
                <div class="w-full md:w-1/2 p-8 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest" x-text="activeItem?.brand"></span>
                            <span class="px-2.5 py-0.5 bg-gray-100 text-gray-600 rounded-full font-bold text-[10px] tracking-wide uppercase" x-text="activeItem?.kategori"></span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 leading-snug" x-text="activeItem?.nama"></h2>
                        
                        <div class="grid grid-cols-2 gap-3 border-t border-b border-gray-100 py-4 my-2">
                            <div>
                                <span class="text-[10px] font-bold text-gray-400 uppercase">Kondisi</span>
                                <p class="text-sm font-bold text-gray-800 mt-0.5" x-text="activeItem ? formatCondition(activeItem.kondisi) : ''"></p>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-gray-400 uppercase">Ukuran</span>
                                <p class="text-sm font-bold text-gray-800 mt-0.5" x-text="activeItem?.ukuran || '-'"></p>
                            </div>
                        </div>
                        
                        <div class="space-y-3 pt-2">
                            <h4 class="text-xs font-bold text-gray-900 uppercase tracking-wider">Catatan Kurator</h4>
                            <p class="text-sm text-gray-500 leading-relaxed font-normal" x-text="activeItem?.deskripsi || '-'"></p>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 mt-6 flex gap-3">
                        <button class="flex-grow py-3.5 bg-emerald-500 text-white rounded-xl text-xs font-bold hover:bg-emerald-600 active:scale-[0.98] transition-all flex items-center justify-center gap-2"
                                :disabled="activeItem?.status !== 'tersedia'"
                                @click="openForm()">
                            <span class="material-symbols-outlined !text-[16px]">send</span>
                            Ajukan Permohonan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Form Modal -->
        <div x-show="formOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" style="display: none;" x-cloak>
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
                <button class="absolute top-4 right-4 p-2 rounded-full hover:bg-gray-100" @click="closeForm()">
                    <span class="material-symbols-outlined text-gray-600">close</span>
                </button>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Form Pengajuan Barang</h3>
                <p class="text-xs text-gray-500 mb-6">Lengkapi data berikut untuk mengirimkan permohonan donasi.</p>
                
                <form class="space-y-4" @submit.prevent="submitRequest">
                    <div x-show="generalError" x-text="generalError" class="p-3 bg-red-50 text-red-600 text-xs font-semibold rounded-xl border border-red-100" style="display: none;"></div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Lengkap Pemohon</label>
                        <input class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-55 text-sm"
                               type="text" x-model="form.nama_pemohon" required placeholder="Contoh: Budi Santoso"/>
                        <span x-show="errors.nama_pemohon" x-text="errors.nama_pemohon" class="text-xs text-red-600 mt-1 block font-semibold" style="display: none;"></span>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Nomor WhatsApp</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-xs font-black text-gray-400 select-none">+62</span>
                            <input class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-55 text-sm"
                                   type="tel" x-model="form.kontak_pemohon" required placeholder="8123456789"/>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1 font-semibold">Tulis tanpa angka 0 atau +62 di depan</p>
                        <span x-show="errors.kontak_pemohon" x-text="errors.kontak_pemohon" class="text-xs text-red-600 mt-1 block font-semibold" style="display: none;"></span>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Alamat Lengkap Pengiriman</label>
                        <textarea class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-55 text-sm"
                                  rows="3" x-model="form.alamat_pengiriman" required placeholder="Alamat lengkap jalan, nomor, RT/RW, kecamatan..."></textarea>
                        <span x-show="errors.alamat_pengiriman" x-text="errors.alamat_pengiriman" class="text-xs text-red-600 mt-1 block font-semibold" style="display: none;"></span>
                    </div>
                    
                    <button class="w-full py-4 bg-emerald-500 text-white rounded-xl font-bold text-sm hover:bg-emerald-600 active:scale-[0.99] transition-all shadow-md shadow-emerald-500/10 mt-6 flex items-center justify-center gap-2"
                            type="submit" :disabled="submitting">
                        <span x-show="!submitting">Kirim Pengajuan</span>
                        <span x-show="submitting" class="flex items-center gap-1.5" style="display: none;">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mengirim...
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Success Message Modal -->
        <div x-show="successOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm" style="display: none;" x-cloak>
            <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl text-center space-y-4 border border-gray-100">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto">
                    <span class="material-symbols-outlined !text-[40px]">check_circle</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Pengajuan Berhasil!</h3>
                    <p class="text-xs text-gray-500 mt-2 leading-relaxed">Data Anda telah kami simpan. Hubungi WhatsApp Admin untuk memverifikasi dan mempercepat proses pengiriman.</p>
                </div>
                <a class="block w-full py-4 bg-[#25D366] text-white rounded-xl text-sm font-bold hover:opacity-90 active:scale-[0.99] transition-all flex items-center justify-center gap-2 shadow-sm"
                   :href="whatsappUrl" target="_blank">
                    Hubungi via WhatsApp
                </a>
                <button class="text-xs text-gray-500 hover:underline" @click="closeAll()">Kembali ke Katalog</button>
            </div>
        </div>
    </div>

    <script>
    function catalogApp() {
        return {
            search: '',
            category: '',
            condition: '',
            loading: false,
            detailOpen: false,
            formOpen: false,
            successOpen: false,
            submitting: false,
            whatsappUrl: '#',
            activeItem: null,
            activeImage: '',
            
            form: {
                nama_pemohon: '',
                kontak_pemohon: '',
                alamat_pengiriman: ''
            },
            errors: {
                nama_pemohon: '',
                kontak_pemohon: '',
                alamat_pengiriman: ''
            },
            generalError: '',

            initApp() {
                const urlParams = new URLSearchParams(window.location.search);
                this.search = urlParams.get('search') || '';
                this.category = urlParams.get('category') || '';
                this.condition = urlParams.get('condition') || '';
                
                window.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        this.closeDetail();
                        this.closeForm();
                    }
                });
            },

            formatCondition(cond) {
                const map = {
                    'baru': '🆕 Baru',
                    'seperti_baru': '✨ Seperti Baru',
                    'sudah_diperbaiki': '🔧 Refurbished'
                };
                return map[cond] || cond;
            },

            async fetchFilter() {
                this.loading = true;
                try {
                    const url = new URL("{{ route('donatur.katalog.filter') }}", window.location.origin);
                    if (this.search) url.searchParams.set('search', this.search);
                    if (this.category) url.searchParams.set('category', this.category);
                    if (this.condition) url.searchParams.set('condition', this.condition);

                    const response = await fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        const html = await response.text();
                        document.getElementById('item-grid-container').innerHTML = html;
                    } else {
                        console.error('Filtering failed');
                    }
                } catch (err) {
                    console.error('Connection error:', err);
                } finally {
                    this.loading = false;
                }
            },

            setCategory(cat) {
                this.category = cat;
                this.fetchFilter();
                
                const url = new URL(window.location.href);
                if (cat) {
                    url.searchParams.set('category', cat);
                } else {
                    url.searchParams.delete('category');
                }
                window.history.pushState({}, '', url.toString());
            },

            setCondition(cond) {
                this.condition = cond;
                this.fetchFilter();
                
                const url = new URL(window.location.href);
                if (cond) {
                    url.searchParams.set('condition', cond);
                } else {
                    url.searchParams.delete('condition');
                }
                window.history.pushState({}, '', url.toString());
            },

            openDetail(item) {
                this.activeItem = item;
                this.activeImage = item.foto_utama_url;
                this.detailOpen = true;
            },

            closeDetail() {
                this.detailOpen = false;
            },

            openForm() {
                this.detailOpen = false;
                this.formOpen = true;
                this.generalError = '';
                this.errors = { nama_pemohon: '', kontak_pemohon: '', alamat_pengiriman: '' };
                
                this.form.nama_pemohon = "{{ Auth::user()->name }}";
                this.form.kontak_pemohon = "{{ Auth::user()->phone ? (str_starts_with(Auth::user()->phone, '62') ? substr(Auth::user()->phone, 2) : Auth::user()->phone) : '' }}";
            },

            closeForm() {
                this.formOpen = false;
                this.resetFormFields();
            },

            resetFormFields() {
                this.form = { nama_pemohon: '', kontak_pemohon: '', alamat_pengiriman: '' };
                this.errors = { nama_pemohon: '', kontak_pemohon: '', alamat_pengiriman: '' };
                this.generalError = '';
            },

            closeAll() {
                this.successOpen = false;
                this.formOpen = false;
                this.detailOpen = false;
                this.resetFormFields();
            },

            async submitRequest() {
                this.submitting = true;
                this.generalError = '';
                this.errors = { nama_pemohon: '', kontak_pemohon: '', alamat_pengiriman: '' };

                try {
                    const url = `/donatur/katalog/${this.activeItem.id}/request`;
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(this.form)
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        this.formOpen = false;
                        this.successOpen = true;
                        this.whatsappUrl = data.redirect_url;
                        
                        this.activeItem.status = 'disalurkan';
                        this.fetchFilter();

                        setTimeout(() => {
                            window.open(data.redirect_url, '_blank');
                        }, 800);
                    } else if (response.status === 422) {
                        if (data.errors) {
                            Object.keys(data.errors).forEach(key => {
                                this.errors[key] = data.errors[key][0];
                            });
                        } else {
                            this.generalError = data.message || 'Validasi gagal. Harap periksa form Anda.';
                        }
                    } else {
                        this.generalError = data.message || 'Gagal memproses pengajuan. Silakan coba lagi.';
                    }
                } catch (err) {
                    console.error('Submission error:', err);
                    this.generalError = 'Terjadi gangguan jaringan. Pastikan Anda terhubung ke internet.';
                } finally {
                    this.submitting = false;
                }
            }
        }
    }
    </script>
</x-donatur-layout>
