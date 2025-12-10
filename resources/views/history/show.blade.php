@extends('layouts.app')

@php
    $showNavigation = false;
    $showPattern = true;
@endphp

@section('content')
{{-- Sidebar --}}
@include('components.sidebar')

{{-- Main Content Area --}}
<div class="ml-0 md:ml-64 min-h-screen bg-slate-900">
    {{-- Background Pattern --}}
    @if($showPattern)
    <div class="absolute inset-0 pointer-events-none opacity-5"
         style="background-image: url('{{ asset('images/pattern 3.png') }}'); 
                background-repeat: repeat; 
                background-size: 1600px;
                z-index: 0;">
    </div>
    @endif
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Page Content --}}
    <div class="px-6 py-8">
        {{-- Back Button --}}
        <a href="{{ route('history.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors mb-6">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to History
        </a>

        <div class="max-w-6xl mx-auto">
            {{-- Booking Code Section --}}
            <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-2xl p-6 mb-6 shadow-xl">
                <p class="text-sm text-red-100 mb-2">Booking Code</p>
                <div class="flex items-center justify-between">
                    <h1 class="text-4xl font-bold tracking-wider text-white">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</h1>
                    <button onclick="copyBookingCode()" class="p-2 hover:bg-red-800 rounded-lg transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center gap-3 mt-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ 
                        $booking->status === 'pending' ? 'bg-yellow-500 text-yellow-900' : 
                        ($booking->status === 'paid' ? 'bg-green-500 text-green-900' : 'bg-red-500 text-red-900')
                    }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                    <span class="text-sm text-red-100">
                        Paid on {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y, H:i') }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Left Column: Film Info --}}
                <div class="lg:col-span-1">
                    <div class="bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-700">
                        <h3 class="text-sm text-gray-400 mb-2">{{ $booking->showtime->film->title ?? 'Film' }}</h3>
                        <h2 class="text-2xl font-bold text-white mb-3">{{ $booking->showtime->film->title ?? 'N/A' }}</h2>
                        <div class="space-y-2 text-sm text-gray-300">
                            <p><span class="text-gray-400">Genre:</span> {{ $booking->showtime->film->genre ?? 'N/A' }}</p>
                            <p><span class="text-gray-400">Rating:</span> {{ $booking->showtime->film->rating ?? 'N/A' }}</p>
                            <p><span class="text-gray-400">Duration:</span> {{ $booking->showtime->film->duration_mins ?? 0 }} min</p>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Booking Details --}}
                <div class="lg:col-span-2 space-y-6">
                    {{-- Showtime Details --}}
                    <div class="bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-700">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-white">Showtime Details</h3>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-gray-300">
                            <div>
                                <p class="text-sm text-gray-400 mb-1">Date</p>
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($booking->showtime->show_date)->format('l, d F Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400 mb-1">Time</p>
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->showtime->end_time)->format('H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400 mb-1">Studio</p>
                                <p class="font-semibold">{{ $booking->showtime->studio->name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400 mb-1">Seats</p>
                                <p class="font-semibold">{{ $booking->ticket->pluck('seat.seat_position')->implode(', ') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Tickets --}}
                    <div class="bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-700">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-white">Tickets</h3>
                        </div>
                        @foreach($booking->ticket as $ticket)
                            <div class="flex items-center justify-between py-3 border-b border-slate-700 last:border-0 text-gray-300">
                                <span>Seat {{ $ticket->seat->seat_number }}</span>
                                <span class="font-semibold">Rp {{ number_format($ticket->ticket_price, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                        <div class="flex items-center justify-between pt-4 mt-4 border-t border-slate-600">
                            <span class="font-semibold text-white">Subtotal ({{ $booking->ticket->count() }} tickets)</span>
                            <span class="text-xl font-bold text-red-500">Rp {{ number_format($booking->ticket->sum('ticket_price'), 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Food & Drink --}}
                    @if($booking->bookingFoodDrink->count() > 0)
                        <div class="bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-700">
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <h3 class="text-lg font-semibold text-white">Food & Drink</h3>
                            </div>
                            @foreach($booking->bookingFoodDrink as $item)
                                <div class="flex items-center justify-between py-3 border-b border-slate-700 last:border-0 text-gray-300">
                                    <div>
                                        <p class="font-medium">{{ $item->foodDrink->name }}</p>
                                        <p class="text-sm text-gray-400">Qty: {{ $item->quantity }}</p>
                                    </div>
                                    <span class="font-semibold">Rp {{ number_format($item->foodDrink->price * $item->quantity, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                            <div class="flex items-center justify-between pt-4 mt-4 border-t border-slate-600">
                                <span class="font-semibold text-white">Subtotal F&B</span>
                                <span class="text-xl font-bold text-red-500">Rp {{ number_format($booking->bookingFoodDrink->sum(function($item) { return $item->foodDrink->price * $item->quantity; }), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- Total Amount --}}
                    <div class="bg-gradient-to-r from-slate-800 to-slate-700 rounded-xl p-6 shadow-xl border border-slate-600">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-lg font-semibold text-white">Total Amount</span>
                            <span class="text-sm text-gray-400">Payment Method</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold text-white">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                            <span class="text-sm text-gray-300">
                                {{ optional($booking->payment->first())->payment_method ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyBookingCode() {
    const code = '#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}';
    navigator.clipboard.writeText(code);
    alert('Booking code copied!');
}
</script>
@endsection
