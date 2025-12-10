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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>
<body class="font-sans antialiased">
    {{-- Background Container --}}
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 relative overflow-hidden">
        
        {{-- Pattern Background Image Overlay --}}
        @if(!isset($showPattern) || $showPattern)
            <div class="absolute inset-0 pointer-events-none opacity-10 z-0">
                <img 
                    src="{{ asset('images/pattern 3.png') }}" 
                    alt="Background Pattern" 
                    class="w-full h-full object-cover"
                />
            </div>
        @endif

        {{-- Navigation (Conditional) --}}
        @if(!isset($showNavigation) || $showNavigation)
            @include('layouts.navigation')
        @endif

        {{-- Page Content --}}
        <main class="relative z-10">
            @yield('content')
        </main>
    </div>

    {{-- Scripts Stack --}}
    @stack('scripts')
</body>
</html>
