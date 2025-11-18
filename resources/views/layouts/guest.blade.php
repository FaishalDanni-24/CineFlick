<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'CineFlick') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative min-h-screen bg-cover bg-center bg-no-repeat"
      style="background-image: url('{{ asset('images/bg.jpeg') }}')">

    <!-- 🔥 LOGO (Mobile turun + padding, Desktop kembali normal) -->
    <div class="
        absolute 
        w-full 
        flex justify-center
        top-20 px-4      <!-- 📱 Tambah jarak turun + padding horizontal -->
        md:top-6 md:left-6 md:px-0 md:justify-start
        z-50
    ">
        <img src="{{ asset('images/Logo_CineFlick.png') }}" 
             alt="CineFlick Logo"
             class="h-20 object-contain">
    </div>

    <!-- 🔥 FORM (Mobile padding + turun sedikit) -->
    <div class="
        w-full min-h-screen 
        flex items-start justify-center
        pt-40 px-6        <!-- 📱 Form turun + padding kiri/kanan -->
        md:pt-0 md:items-center md:px-0
        bg-black/70 
    ">
        {{ $slot }}
    </div>

</body>
</html>
