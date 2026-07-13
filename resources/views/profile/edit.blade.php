@if(auth()->user()->isAdmin())
    <x-app-layout>
        <div class="space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Profil Saya</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi akun dan kata sandi Anda.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-full">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-full">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <x-member-layout>
        <div class="space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Profil Saya</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi akun dan kata sandi Anda.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-full">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-full">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </x-member-layout>
@endif
