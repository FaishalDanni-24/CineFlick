@extends('layouts.booking-process')

@section('title','Review')

@php
    $currentStep = 'review';
@endphp

@section('content')
@php($film = $booking->showtime->film)
@php($ticketTotal = $booking->ticket->sum('ticket_price'))
@php($fdTotal = $booking->bookingFoodDrink->sum('subtotal'))
@php($grandTotal = ($ticketTotal ?? 0) + ($fdTotal ?? 0))
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
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <div class="font-semibold mb-3">Ringkasan Tiket</div>
            <div class="text-sm text-white/80">Jumlah kursi: {{ $booking->ticket->count() }}</div>
            <div class="text-sm text-white/60">Subtotal tiket: Rp {{ number_format($ticketTotal,0,',','.') }}</div>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <div class="font-semibold mb-3">Food & Drink</div>
            @forelse($booking->bookingFoodDrink as $item)
                <div class="flex justify-between text-sm">
                    <span>{{ $item->foodDrink->name }} × {{ $item->quantity }}</span>
                    <span>Rp {{ number_format($item->subtotal,0,',','.') }}</span>
                </div>
            @empty
                <div class="text-sm text-white/60">Tidak ada tambahan.</div>
            @endforelse
            <div class="mt-2 text-sm text-white/80">Subtotal F&B: Rp {{ number_format($fdTotal,0,',','.') }}</div>
        </div>
    </div>
    <div class="space-y-6">
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <div class="flex justify-between mb-4">
                <span class="font-semibold">Total</span>
                <span class="font-bold text-xl">Rp {{ number_format($grandTotal,0,',','.') }}</span>
            </div>
            <div class="flex items-center justify-between gap-3">
                <a href="{{ route('booking.add-food', $booking) }}" 
                   class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg bg-gray-700 hover:bg-gray-600 text-white font-semibold transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back
                </a>
                <a href="{{ route('payment.show',$booking) }}" 
                   class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold transition-all shadow-lg shadow-red-600/30">
                    Bayar Sekarang
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection