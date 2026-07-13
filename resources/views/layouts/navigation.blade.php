<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}">
                        <x-application-logo class="block h-14 w-auto" />
                    </a>
                </div>
                <div class="hidden space-x-6 sm:-my-px sm:ms-8 sm:flex">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-nav-link>
                    <x-nav-link :href="route('admin.hero.index')" :active="request()->routeIs('admin.hero.*')">Hero</x-nav-link>
                    <x-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">Layanan</x-nav-link>
                    <x-nav-link :href="route('admin.projects.index')" :active="request()->routeIs('admin.projects.*')">Portfolio</x-nav-link>
                    <x-nav-link :href="route('admin.reviews.index')" :active="request()->routeIs('admin.reviews.*')">Reviews</x-nav-link>
                    <x-nav-link :href="route('admin.trust.index')" :active="request()->routeIs('admin.trust.*')">Trust</x-nav-link>
                    <x-nav-link :href="route('admin.workflow.index')" :active="request()->routeIs('admin.workflow.*')">Workflow</x-nav-link>
                    <x-nav-link :href="route('admin.about.index')" :active="request()->routeIs('admin.about.*')">About</x-nav-link>
                    <x-nav-link :href="route('admin.cta.index')" :active="request()->routeIs('admin.cta.*')">CTA</x-nav-link>
                    <x-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.*')">Artikel</x-nav-link>
                    <x-nav-link :href="route('admin.tracking.index')" :active="request()->routeIs('admin.tracking.*')">Tracking</x-nav-link>
                    <x-nav-link :href="route('admin.warranty-claims.index')" :active="request()->routeIs('admin.warranty-claims.index')">Klaim Garansi</x-nav-link>
                    <x-nav-link :href="route('admin.campaigns.index')" :active="request()->routeIs('admin.campaigns.*')">Kampanye</x-nav-link>
                    <x-nav-link :href="route('admin.settings.index')" :active="request()->routeIs('admin.settings.*')">Settings</x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-1.5 focus:outline-none group">
                            <div class="relative flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full group-hover:bg-gray-200 group-active:scale-95 transition-all overflow-hidden shrink-0 border border-gray-200 shadow-sm">
                                @if (Auth::user()->avatar_path)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar_path) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-gray-600 font-black text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                @endif
                            </div>
                            <span class="material-symbols-outlined text-[18px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200">keyboard_arrow_down</span>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')" class="font-medium py-2 mt-1">
                            Profil Saya
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="font-medium text-red-600 hover:bg-red-50 hover:text-red-700 py-2 mb-1"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Keluar (Logout)
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.hero.index')" :active="request()->routeIs('admin.hero.*')">Hero</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">Layanan</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.projects.index')" :active="request()->routeIs('admin.projects.*')">Portfolio</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.reviews.index')" :active="request()->routeIs('admin.reviews.*')">Reviews</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.*')">Artikel</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.tracking.index')" :active="request()->routeIs('admin.tracking.*')">Tracking</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.warranty-claims.index')" :active="request()->routeIs('admin.warranty-claims.index')">Klaim Garansi</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.campaigns.index')" :active="request()->routeIs('admin.campaigns.*')">Kampanye</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.settings.index')" :active="request()->routeIs('admin.settings.*')">Settings</x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>