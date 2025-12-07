@extends('layouts.booking-process')

@section('title','Movie Details')
@section('step','food')

@section('content')
@isset($film)
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-2 space-y-6">
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <div class="flex items-start gap-4">
                @if($film?->poster_url)
                    <img src="{{ $film->poster_url }}" alt="{{ $film->title }}" class="w-24 h-36 object-cover rounded">
                @endif
                <div class="flex-1">
                    <div class="text-lg font-bold">{{ $film->title }}</div>
                    <div class="mt-2 text-sm">
                        <div class="mt-1">Tahun Rilis : <span class="text-lg font-bold">{{ $film->released_year }}</span></div>
                        <div class="mt-1">Publisher : <span class="text-lg font-bold">{{ $film->publisher }}</span></div>
                        <div class="mt-1">Genre : <span class="text-lg font-bold">{{ $film->genre }}</span></div>
                        <div class="mt-1">Durasi : <span class="text-lg font-bold">{{ $film->duration_mins }} minutes</span></div>
                        <div class="mt-1">Rating : <span class="text-lg font-bold">{{ $film->rating }}</span></div>
                        <div class="mt-1">Sinopsis : <span class="text-lg font-bold">{{ $film->sinopsis }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="space-y-6">
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <div class="text-lg font-bold mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Jadwal Tayang
            </div>
            @if(isset($showtimes) && $showtimes->count())
                <ul class="space-y-3">
                    @foreach($showtimes as $showtime)
                        <li class="flex items-center justify-between p-4 bg-white/3 hover:bg-white/5 rounded-lg transition-colors border border-white/5">
                            <div class="flex-1">
                                <div class="font-semibold text-white">{{ \Carbon\Carbon::parse(($showtime->show_date ?? '') . ' ' . ($showtime->start_time ?? '') )->format('d M Y, H:i') }}</div>
                                <div class="text-sm text-gray-400 mt-1">
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        Studio {{ $showtime->studio?->name ?? $showtime->studio_id }}
                                    </span>
                                    <span class="mx-2">•</span>
                                    <span class="font-semibold text-green-400">Rp {{ number_format($showtime->normal_price ?? 0,0,',','.') }}</span>
                                </div>
                            </div>
                            <div>
                                @auth
                                    <a href="{{ route('booking.select-seats', $showtime) }}" 
                                       class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all shadow-lg shadow-red-600/30">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                        </svg>
                                        Pilih Kursi
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="inline-flex items-center gap-2 px-6 py-2.5 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                        </svg>
                                        Login untuk Booking
                                    </a>
                                @endauth
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-sm text-gray-400 text-center py-8">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    Tidak ada jadwal tayang tersedia.
                </div>
            @endif
        </div>
    </div>

</div>
@endisset
@endsection