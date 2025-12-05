{{--
    BOOKING PROCESS LAYOUT
    
    Navigation dengan step indicator yang clickable:
    1. Pilih Kursi (select-seats) - Step awal
    2. Tambah F&B (add-food) - Bisa diakses setelah pilih kursi
    3. Review (review) - Bisa diakses setelah tambah F&B
    4. Pembayaran (payment) - Bisa diakses setelah review
    
    Rules:
    - Hanya bisa akses step yang sudah dilalui atau step saat ini
    - Tidak bisa skip ke step yang belum dilalui
    - Bisa kembali ke step sebelumnya
--}}
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Booking Process')</title>
</head>
<body class="bg-gray-900 text-white">
    <header class="border-b border-white/10 sticky top-0 z-50 bg-gray-900/95 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between gap-4 mb-4">
                {{-- Logo --}}
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" class="inline-block">
                        <img src="{{ asset('images/Logo_CineFlick.png') }}" alt="CineFlick" class="h-8">
                    </a>
                </div>
                {{-- Home Button --}}
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-sm font-medium transition-colors">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Home
                </a>
            </div>

            {{-- Booking Steps Navigation --}}
            @php
                $currentStep = $currentStep ?? 'select';
                $booking = $booking ?? null;
                $showtime = $showtime ?? ($booking ? $booking->showtime : null);
                
                // Determine which steps are accessible
                $steps = [
                    'select' => [
                        'label' => 'Pilih Kursi',
                        'accessible' => true,
                        'url' => $showtime ? route('booking.select-seats', $showtime) : '#',
                        'clickable' => (bool)$showtime,
                        'icon' => 'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z M15 13a3 3 0 11-6 0 3 3 0 016 0z'
                    ],
                    'food' => [
                        'label' => 'Tambah F&B',
                        'accessible' => $booking && in_array($currentStep, ['food', 'review', 'payment']),
                        'url' => $booking ? route('booking.add-food', $booking) : '#',
                        'clickable' => (bool)$booking,
                        'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'
                    ],
                    'review' => [
                        'label' => 'Review',
                        'accessible' => $booking && in_array($currentStep, ['review', 'payment']),
                        'url' => $booking ? route('booking.review', $booking) : '#',
                        'clickable' => (bool)$booking,
                        'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'
                    ],
                    'payment' => [
                        'label' => 'Pembayaran',
                        'accessible' => $booking && $currentStep === 'payment',
                        'url' => $booking ? route('payment.show', $booking) : '#',
                        'clickable' => (bool)$booking,
                        'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'
                    ]
                ];
            @endphp

            <nav class="flex items-center justify-center gap-2 flex-wrap">
                @foreach(['select', 'food', 'review', 'payment'] as $index => $stepKey)
                    @php($step = $steps[$stepKey])
                    
                    {{-- Step Item --}}
                    @if($step['accessible'] && $step['clickable'])
                        <a href="{{ $step['url'] }}" 
                           class="group flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-200
                                  {{ $currentStep === $stepKey 
                                     ? 'bg-red-600 text-white shadow-lg shadow-red-600/30' 
                                     : 'bg-white/10 hover:bg-white/20 text-gray-300 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/>
                            </svg>
                            <span class="text-sm font-semibold hidden sm:inline">{{ $step['label'] }}</span>
                            <span class="text-sm font-semibold sm:hidden">{{ $index + 1 }}</span>
                        </a>
                    @elseif($step['accessible'] && !$step['clickable'])
                        {{-- Accessible tapi belum ada data (showtime/booking) --}}
                        <div class="flex items-center gap-2 px-4 py-2 rounded-lg bg-white/10 text-gray-400 cursor-not-allowed opacity-50"
                             title="Data belum tersedia">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/>
                            </svg>
                            <span class="text-sm font-semibold hidden sm:inline">{{ $step['label'] }}</span>
                            <span class="text-sm font-semibold sm:hidden">{{ $index + 1 }}</span>
                        </div>
                    @else
                        {{-- Not accessible yet --}}
                        <div class="flex items-center gap-2 px-4 py-2 rounded-lg bg-white/5 text-gray-500 cursor-not-allowed"
                             title="Belum dapat diakses">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/>
                            </svg>
                            <span class="text-sm font-semibold hidden sm:inline">{{ $step['label'] }}</span>
                            <span class="text-sm font-semibold sm:hidden">{{ $index + 1 }}</span>
                        </div>
                    @endif
                    
                    {{-- Arrow Separator --}}
                    @if($index < 3)
                        <svg class="w-4 h-4 text-white/20 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    @endif
                @endforeach
            </nav>
        </div>  
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">  
         @yield('content')
    </div>
</body>
</html>