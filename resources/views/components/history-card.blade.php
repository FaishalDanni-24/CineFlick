{{-- HISTORY CARD COMPONENT --}}

@php
    $film = $booking->showtime->film ?? null;
    $studio = $booking->showtime->studio ?? null;
    $showtime = $booking->showtime ?? null;
    $seats = $booking->ticket->pluck('seat.seat_position')->toArray();
    $hasFoodDrink = $booking->bookingFoodDrink->count() > 0;
    
    $statusStyles = [
        'pending' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
        'paid' => 'bg-green-500/20 text-green-400 border-green-500/30',
        'cancelled' => 'bg-red-500/20 text-red-400 border-red-500/30',
    ];
    $statusBadge = $statusStyles[$booking->status] ?? 'bg-gray-500/20 text-gray-400 border-gray-500/30';
@endphp

<div 
    data-booking-card 
    class="bg-gradient-to-r from-gray-800/60 to-gray-900/60 backdrop-blur-sm rounded-xl border border-gray-700/50 hover:border-red-600/50 transition-all duration-300"
>
    <div class="p-4">
        <div class="flex items-start justify-between gap-4">
            {{-- Left Side: Film & Showtime Info --}}
            <div class="flex-1 min-w-0">
                @if($film)
                    <h3 class="text-lg font-bold text-white truncate mb-1">{{ $film->title }}</h3>
                    <p class="text-xs text-gray-400 mb-2">{{ $film->genre }} • {{ $film->rating }}</p>
                @else
                    <h3 class="text-lg font-bold text-white">Booking #{{ $booking->id }}</h3>
                @endif

                @if($showtime)
                    <div class="flex flex-wrap items-center gap-3 text-xs text-gray-300 mb-2">
                        {{-- Date --}}
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ \Carbon\Carbon::parse($showtime->show_date)->format('d M Y') }}
                        </span>
                        
                        {{-- Time --}}
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}
                        </span>

                        {{-- Studio --}}
                        @if($studio)
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                                </svg>
                                {{ $studio->name }}
                            </span>
                        @endif

                        {{-- Seats --}}
                        @if(count($seats) > 0)
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2 1 3 3 3h10c2 0 3-1 3-3V7M8 3h8M6 7h12"></path>
                                </svg>
                                {{ implode(', ', $seats) }}
                            </span>
                        @endif
                    </div>
                @endif

                {{-- Badges --}}
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-xs text-gray-400 bg-gray-700/50 px-2 py-1 rounded">
                        {{ $booking->ticket->count() }} {{ $booking->ticket->count() === 1 ? 'Ticket' : 'Tickets' }}
                    </span>
                    
                    @if($hasFoodDrink)
                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-orange-500/20 border border-orange-500/30 rounded text-xs font-medium text-orange-400">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Includes F&B
                        </span>
                    @endif

                    <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-semibold border {{ $statusBadge }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
            </div>

            {{-- Right Side: Price + Action Button --}}
            <div class="flex flex-col items-end justify-between gap-3 flex-shrink-0">
                <div class="text-right">
                    <p class="text-xs text-gray-500 mb-0.5">Total Price</p>
                    <p class="text-xl font-bold text-white whitespace-nowrap">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                </div>

                <a 
                    href="{{ route('history.show', $booking->id) }}" 
                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-all duration-300"
                >
                    View Details
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
