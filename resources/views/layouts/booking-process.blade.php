<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Booking Process')</title>
</head>
<body class="bg-gray-900 text-white">
    <header class="border-b border-white/10">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center">
            <div>
                <a href="{{ url('/') }}" class="inline-block">
                    <img src="{{ asset('images/Logo_Cineflick_Small.png') }}" alt="CineFlick" class="h-8">
                </a>
            </div>
            <nav class="flex items-center gap-3 text-sm">
                <span class="px-3 py-1 rounded-full bg-white/10">Pilih Kursi</span>
                <span class="text-white/40">›</span>
                <span class="px-3 py-1 rounded-full bg-white/10">Tambah F&B</span>
                <span class="text-white/40">›</span>
                <span class="px-3 py-1 rounded-full bg-white/10">Review</span>
                <span class="text-white/40">›</span>
                <span class="px-3 py-1 rounded-full bg-red-600 text-white">Pembayaran</span>
            </nav>
        </div>  

    <div class="max-w-6xl mx-auto px-6 py-8">  
         @yield('content')
    </div>
    
    </header>

    
</body>
</html>