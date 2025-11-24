{{--
    MAIN LAYOUT - APP.BLADE.PHP
    
    Layout utama aplikasi CineFlick
    Digunakan oleh semua halaman yang extends 'layouts.app'
    
    Fitur:
    - Include navigation untuk halaman yang membutuhkan (dashboard, profile, dll)
    - Support untuk homepage dengan sidebar+navbar custom
    - Stack untuk CSS dan JavaScript tambahan
    - CSRF token untuk security
    - Responsive meta viewport
    
    Catatan:
    - Homepage (home.blade.php) TIDAK menggunakan @include('layouts.navigation')
      karena punya sidebar dan navbar sendiri
    - Halaman lain (dashboard, profile) tetap pakai navigation.blade.php
--}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CineFlick') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/Logo_CineFlick_Small.png') }}">

    <!-- Scripts Vite (Tailwind CSS + JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Stack untuk CSS tambahan dari child views -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-900 text-white">
    <div class="min-h-screen relative">
        {{-- 
            Background Pattern (Reusable)
            Default: AKTIF
            Untuk disable di halaman tertentu: set $showPattern = false
            File: public/images/pattern 3.png
        --}}
        @if(!isset($showPattern) || $showPattern !== false)
            <div class="fixed inset-0 z-0 pointer-events-none">
                {{-- Fallback solid background --}}
                <div class="absolute inset-0 bg-gray-900"></div>
                
                {{-- Pattern overlay - menggunakan CSS background-image untuk handle spasi --}}
                <div 
                    class="absolute inset-0 w-full h-full opacity-60 mix-blend-soft-light"
                    style="background-image: url('{{ asset('images/pattern 3.png') }}'); background-size: cover; background-position: center; background-repeat: repeat;"
                ></div>
            </div>
        @endif

        {{-- Main content wrapper dengan z-index lebih tinggi dari background --}}
        <div class="relative z-10">
            {{-- 
                Navigation Bar (Laravel Breeze default)
                Default: TIDAK AKTIF
                Untuk enable di halaman tertentu: set $showNavigation = true
            --}}
            @if(isset($showNavigation) && $showNavigation)
                @include('layouts.navigation')
            @endif
            
            {{-- 
                Page Heading (optional)
                Biasanya digunakan untuk halaman dashboard/admin
            --}}
            @isset($header)
                <header class="bg-gray-800 border-b border-gray-700">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Main Content Area --}}
            <main>
                @yield('content')
            </main>
        </div>
    </div>
    
    {{-- Stack untuk JavaScript tambahan dari child views --}}
    @stack('scripts')
</body>
</html>