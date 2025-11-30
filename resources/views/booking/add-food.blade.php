@extends('layouts.booking-process')

@section('title','Tambah F&B')
@section('step','food')

@section('content')
@php($film = $booking->showtime->film)
@php($fdTotal = $booking->bookingFoodDrink->sum('subtotal'))
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
                        <div>Tanggal : <span class="font-semibold">{{ \Illuminate\Support\Carbon::parse($booking->showtime->show_date)->translatedFormat('l, d-m-Y') }}</span></div>
                        <div class="mt-1">Waktu : <span class="font-semibold">{{ $booking->showtime->start_time }}</span></div>
                        <div class="mt-1">Kursi : <span class="font-semibold">{{ $booking->ticket->count() }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <form id="food-selection-form" method="POST" action="{{ route('booking.store-food-drink', $booking) }}">
            @csrf
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
                <div class="font-semibold mb-4">Pilih Food & Drink</div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @forelse($foods as $fd)
                        <div class="bg-black/30 border border-white/10 rounded p-4">
                            <div class="text-sm font-semibold">{{ $fd->name }}</div>
                            <div class="text-xs text-white/70">{{ strtoupper($fd->type) }}</div>
                            <div class="mt-2 text-sm">Rp {{ number_format($fd->price,0,',','.') }}</div>
                            <div class="mt-3 flex flex-col gap-2">
                                <div class="flex items-center gap-2">
                                    <label class="text-xs text-white/70">Qty:</label>
                                    <input type="number" 
                                           name="foods[{{ $fd->id }}]" 
                                           value="0" 
                                           min="0" 
                                           max="99"
                                           class="w-16 px-2 py-1 rounded bg-white/20 text-white text-center text-sm">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-white/60">Belum ada daftar F&B.</div>
                    @endforelse
                </div>
                <div class="mt-4 text-sm text-white/80">Subtotal F&B saat ini: Rp {{ number_format($fdTotal,0,',','.') }}</div>
            </div>
        </form>
    </div>

    <div class="space-y-6">
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <div class="flex items-center justify-between gap-2">
                <a href="{{ route('booking.select-seats', $booking->showtime) }}" class="px-6 py-2 rounded-full bg-gray-600 text-white font-semibold">Back</a>
                <button type="submit" form="food-selection-form" class="px-6 py-2 rounded-full bg-green-600 text-white font-semibold">Next</button>
            </div>
        </div>
    </div>
</div>
@endsection