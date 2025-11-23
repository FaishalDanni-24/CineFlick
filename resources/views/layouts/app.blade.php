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
    
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #111827;
            background-image: url('{{ asset("images/pattern 3.png") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: repeat;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(17, 24, 39, 0.88);
            pointer-events: none;
            z-index: 0;
        }
        
        .app-wrapper {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="app-wrapper">
        <div class="min-h-screen flex w-full">
            <!-- Sidebar -->
            <x-sidebar />
            
            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col w-full">
                <!-- Navbar -->
                <x-navbar />
                
                <!-- Page Content -->
                <main class="flex-1 w-full overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    
    <!-- Trailer Modal -->
    <x-trailer-modal />
</body>
</html>
