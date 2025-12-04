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
            <div class="text-lg font-bold mb-4">Jadwal Tayang</div>
            @if(isset($showtimes) && $showtimes->count())
                <ul class="space-y-3">
                    @foreach($showtimes as $showtime)
                        <li class="flex items-center justify-between p-3 bg-white/3 rounded">
                            <div>
                                <div class="font-medium">{{ \Carbon\Carbon::parse(($showtime->show_date ?? '') . ' ' . ($showtime->start_time ?? '') )->format('d M Y, H:i') }}</div>
                                <div class="text-sm">Studio: {{ $showtime->studio?->name ?? $showtime->studio_id }} • Harga: Rp {{ number_format($showtime->normal_price ?? 0,0,',','.') }}</div>
                            </div>
                            <div>
                                @auth
                                    <a href="{{ route('booking.select-seats', $showtime->id) }}" class="inline-block px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">Pilih Kursi</a>
                                @else
                                    <a href="{{ route('login') }}" class="inline-block px-3 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-500">Login untuk Pilih</a>
                                @endauth
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-sm">Tidak ada jadwal tayang tersedia.</div>
            @endif
        </div>
    </div>

</div>
@endisset
@endsection