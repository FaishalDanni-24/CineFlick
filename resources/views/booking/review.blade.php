@extends('layouts.booking-process')

@section('title','Review')
@section('step','review')

@section('content')
@php($film = $booking->showtime->film)
@php($fdTotal = $booking->bookingFoodDrink->sum('subtotal'))
@php($grandTotal = ($booking->total_price ?? 0) + ($fdTotal ?? 0))
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
            <div class="text-sm text-white/60">Subtotal tiket: Rp {{ number_format($booking->total_price,0,',','.') }}</div>
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
            <div class="flex justify-between">
                <span class="font-semibold">Total</span>
                <span class="font-bold">Rp {{ number_format($grandTotal,0,',','.') }}</span>
            </div>
            <a href="{{ route('payment.show',$booking) }}" class="mt-4 block w-full text-center px-4 py-2 rounded bg-red-600 text-white font-semibold">Bayar</a>
        </div>
    </div>
</div>
@endsection