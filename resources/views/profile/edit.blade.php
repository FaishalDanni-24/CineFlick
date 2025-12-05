{{--
    PROFILE EDIT PAGE
    
    Styling yang konsisten dengan website CineFlick:
    - Dark theme (gray-900/800) dengan aksen merah
    - Card style dengan border dan shadow
    - Smooth transitions dan hover effects
--}}

<x-user-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('Profile Settings') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            {{-- Profile Information Card --}}
            <div class="bg-gray-800/80 backdrop-blur-sm border border-gray-700/50 shadow-xl rounded-xl overflow-hidden">
                <div class="p-6 sm:p-8">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            {{-- Update Password Card --}}
            <div class="bg-gray-800/80 backdrop-blur-sm border border-gray-700/50 shadow-xl rounded-xl overflow-hidden">
                <div class="p-6 sm:p-8">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            {{-- Delete Account Card --}}
            <div class="bg-gray-800/80 backdrop-blur-sm border border-red-900/30 shadow-xl rounded-xl overflow-hidden">
                <div class="p-6 sm:p-8">
                    <div class="max-w-2xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
