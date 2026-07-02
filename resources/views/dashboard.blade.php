<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- ═══════════════════════════════════════════════════════════════
         SECTION 1 — Actionable KPI Cards
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- Donasi Menunggu --}}
        <a href="{{ route('admin.donations.index') }}" class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 right-0 h-24 w-24 bg-amber-50 rounded-full -translate-y-8 translate-x-8 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="h-12 w-12 rounded-2xl bg-amber-50 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h4 class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.2em] mb-1">Donasi Menunggu</h4>
                <div class="flex items-end gap-2">
                    <p class="text-4xl font-black text-gray-900 tracking-tight">{{ $stats['donations_pending'] }}</p>
                    @if($stats['donations_pending'] > 0)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 mb-1 animate-pulse">Perlu Aksi</span>
                    @endif
                </div>
            </div>
        </a>

        {{-- Permintaan Katalog Baru --}}
        <a href="{{ route('admin.donation-requests.index') }}" class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 right-0 h-24 w-24 bg-rose-50 rounded-full -translate-y-8 translate-x-8 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="h-12 w-12 rounded-2xl bg-rose-50 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                </div>
                <h4 class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.2em] mb-1">Permintaan Baru</h4>
                <div class="flex items-end gap-2">
                    <p class="text-4xl font-black text-gray-900 tracking-tight">{{ $stats['donation_requests_pending'] }}</p>
                    @if($stats['donation_requests_pending'] > 0)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 mb-1 animate-pulse">Perlu Aksi</span>
                    @endif
                </div>
            </div>
        </a>

        {{-- Item Tersedia di Katalog --}}
        <a href="{{ route('admin.donation-items.index') }}" class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 right-0 h-24 w-24 bg-emerald-50 rounded-full -translate-y-8 translate-x-8 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="h-12 w-12 rounded-2xl bg-emerald-50 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h4 class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.2em] mb-1">Katalog Tersedia</h4>
                <p class="text-4xl font-black text-gray-900 tracking-tight">{{ $stats['catalog_available'] }}</p>
            </div>
        </a>

        {{-- Total Donatur --}}
        <div class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 right-0 h-24 w-24 bg-violet-50 rounded-full -translate-y-8 translate-x-8 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="h-12 w-12 rounded-2xl bg-violet-50 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h4 class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.2em] mb-1">Total Donatur</h4>
                <p class="text-4xl font-black text-gray-900 tracking-tight">{{ $stats['total_donators'] }}</p>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         SECTION 2 — Pending Donations Table + Pending Requests
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Donasi Menunggu Verifikasi --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-2.5 w-2.5 rounded-full bg-amber-400 animate-pulse"></div>
                    <h3 class="font-bold text-gray-900">Donasi Menunggu Verifikasi</h3>
                </div>
                <a href="{{ route('admin.donations.index') }}" class="text-xs font-semibold text-[#22AF85] hover:underline">
                    Lihat Semua →
                </a>
            </div>

            @if($pendingDonations->isEmpty())
                <div class="px-6 py-10 text-center">
                    <svg class="h-10 w-10 text-gray-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-gray-400">Tidak ada donasi yang menunggu verifikasi 🎉</p>
                </div>
            @else
                <div class="divide-y divide-gray-50">
                    @foreach($pendingDonations as $donation)
                        <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50/50 transition-colors">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-500 font-mono">{{ $donation->spk }}</span>
                                </div>
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ $donation->nama_sepatu }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    oleh {{ $donation->user->name ?? 'Unknown' }} · {{ $donation->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <a href="{{ route('admin.donations.show', $donation) }}" class="shrink-0 ml-4 inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 text-amber-700 text-xs font-bold rounded-lg hover:bg-amber-100 transition-colors">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Review
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Permintaan Katalog Terbaru --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-2.5 w-2.5 rounded-full bg-rose-400 animate-pulse"></div>
                    <h3 class="font-bold text-gray-900">Permintaan Katalog Terbaru</h3>
                </div>
                <a href="{{ route('admin.donation-requests.index') }}" class="text-xs font-semibold text-[#22AF85] hover:underline">
                    Lihat Semua →
                </a>
            </div>

            @if($pendingRequests->isEmpty())
                <div class="px-6 py-10 text-center">
                    <svg class="h-10 w-10 text-gray-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-gray-400">Tidak ada permintaan baru saat ini 🎉</p>
                </div>
            @else
                <div class="divide-y divide-gray-50">
                    @foreach($pendingRequests as $req)
                        <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50/50 transition-colors">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ $req->nama_pemohon }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    Meminta: <span class="font-medium text-gray-600">{{ $req->donationItem->nama ?? '-' }}</span> · {{ $req->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <span class="shrink-0 ml-4 inline-flex items-center px-2.5 py-1 bg-rose-50 text-rose-600 text-[10px] font-bold rounded-full uppercase tracking-wider">Pending</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         SECTION 3 — Chart + Activity Feed
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Grafik Aktivitas 7 Hari Terakhir --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Aktivitas 7 Hari Terakhir</h3>
                <p class="text-xs text-gray-400 mt-0.5">Donasi masuk vs permintaan katalog</p>
            </div>
            <div class="p-6">
                <canvas id="activityChart" height="220"></canvas>
            </div>
        </div>

        {{-- Feed Aktivitas Terbaru --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Aktivitas Terbaru</h3>
                <p class="text-xs text-gray-400 mt-0.5">Timeline seluruh sistem</p>
            </div>

            @if($activityFeed->isEmpty())
                <div class="px-6 py-10 text-center">
                    <p class="text-sm text-gray-400">Belum ada aktivitas</p>
                </div>
            @else
                <div class="divide-y divide-gray-50 max-h-[340px] overflow-y-auto">
                    @foreach($activityFeed as $activity)
                        <div class="px-6 py-3.5 flex gap-3 hover:bg-gray-50/50 transition-colors">
                            <div class="shrink-0 mt-0.5 text-lg leading-none">{{ $activity->icon }}</div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm text-gray-700 leading-snug">{{ $activity->message }}</p>
                                <p class="text-[10px] text-gray-400 mt-1">{{ $activity->time_human }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Chart.js CDN + Init --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('activityChart');
            if (!ctx) return;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [
                        {
                            label: 'Donasi Masuk',
                            data: @json($chartData['donations']),
                            backgroundColor: 'rgba(245, 158, 11, 0.15)',
                            borderColor: 'rgb(245, 158, 11)',
                            borderWidth: 2,
                            borderRadius: 8,
                            borderSkipped: false,
                        },
                        {
                            label: 'Permintaan Katalog',
                            data: @json($chartData['requests']),
                            backgroundColor: 'rgba(244, 63, 94, 0.15)',
                            borderColor: 'rgb(244, 63, 94)',
                            borderWidth: 2,
                            borderRadius: 8,
                            borderSkipped: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 20,
                                font: { size: 11, weight: '600' }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                font: { size: 11 },
                                color: '#9ca3af',
                            },
                            grid: { color: '#f3f4f6' },
                            border: { display: false }
                        },
                        x: {
                            ticks: {
                                font: { size: 11 },
                                color: '#9ca3af',
                            },
                            grid: { display: false },
                            border: { display: false }
                        }
                    }
                }
            });
        });
    </script>

    {{-- ═══════════════════════════════════════════════════════════════
         SECTION 4 — Content Counters (secondary)
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="mt-8">
        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Ringkasan Konten Website</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @php
                $contentCards = [
                    ['label' => 'Portfolio',       'value' => $stats['projects'],    'color' => 'blue',   'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    ['label' => 'Layanan',         'value' => $stats['services'],    'color' => 'emerald','icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                    ['label' => 'Artikel',         'value' => $stats['posts'],       'color' => 'amber',  'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM12 9H7m5 4H7m8 4h-8'],
                    ['label' => 'Workflow',        'value' => $stats['workflows'],   'color' => 'purple', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                    ['label' => 'Trust Items',     'value' => $stats['trust_items'], 'color' => 'red',    'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ];
            @endphp

            @foreach($contentCards as $card)
                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="h-9 w-9 rounded-xl bg-{{ $card['color'] }}-50 flex items-center justify-center shrink-0">
                            <svg class="h-4.5 w-4.5 text-{{ $card['color'] }}-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-lg font-black text-gray-900">{{ $card['value'] }}</p>
                            <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">{{ $card['label'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         SECTION 4 — Quick Links
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="mt-8 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div class="flex items-center gap-3 mb-5">
            <div class="h-2.5 w-2.5 rounded-full bg-[#22AF85] animate-pulse"></div>
            <h3 class="font-bold text-gray-900">Aksi Cepat</h3>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <a href="{{ route('admin.projects.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gray-50 hover:bg-[#22AF85]/10 hover:text-[#22AF85] text-sm font-semibold text-gray-600 transition-all group">
                <svg class="h-5 w-5 text-gray-400 group-hover:text-[#22AF85] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Portfolio
            </a>
            <a href="{{ route('admin.donations.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gray-50 hover:bg-amber-50 hover:text-amber-700 text-sm font-semibold text-gray-600 transition-all group">
                <svg class="h-5 w-5 text-gray-400 group-hover:text-amber-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Moderasi Donasi
            </a>
            <a href="{{ route('admin.donation-items.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-emerald-700 text-sm font-semibold text-gray-600 transition-all group">
                <svg class="h-5 w-5 text-gray-400 group-hover:text-emerald-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Kelola Katalog
            </a>
            <a href="{{ route('admin.posts.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gray-50 hover:bg-violet-50 hover:text-violet-700 text-sm font-semibold text-gray-600 transition-all group">
                <svg class="h-5 w-5 text-gray-400 group-hover:text-violet-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Tulis Artikel
            </a>
        </div>
    </div>

</x-app-layout>
