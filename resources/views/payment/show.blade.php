
@extends('layouts.booking-process')

@section('title','Pembayaran')

@php
    $currentStep = 'payment';
@endphp

@section('content')
@php($film=$booking->showtime->film)
@php($ticketTotal = $booking->ticket->sum('ticket_price'))
@php($fdTotal = $booking->bookingFoodDrink->sum('subtotal'))
@php($grandTotal = ($ticketTotal ?? 0) + ($fdTotal ?? 0))
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-2 space-y-6">
        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="flex items-center gap-4">
                @if($film?->poster_url)
                    <img src="{{ $film->poster_url }}" alt="{{ $film->title }}" class="w-16 h-24 object-cover rounded">
                @endif
                <div>
                    <div class="text-lg font-semibold">{{ $film->title ?? 'Film' }}</div>
                    <div class="text-sm text-white/70">Tanggal: {{ \Illuminate\Support\Carbon::parse($booking->showtime->show_date)->translatedFormat('d M Y') }}</div>
                    <div class="text-sm text-white/70">Waktu: {{ $booking->showtime->start_time }} - {{ $booking->showtime->end_time }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="font-semibold mb-3">Ringkasan Kursi</div>
            <div class="text-sm text-white/80">Jumlah kursi: {{ $booking->ticket->count() }}</div>
            <div class="text-sm text-white/60">Subtotal tiket: Rp {{ number_format($ticketTotal,0,',','.') }}</div>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="font-semibold mb-3">Food & Drink</div>
            @php($fdTotal=$booking->bookingFoodDrink->sum('subtotal'))
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
        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="font-semibold mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                Pembayaran
            </div>
            <form method="POST" action="{{ route('payment.process', $booking) }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-200">Metode Pembayaran</label>
                    <select name="method" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-red-500 transition-all">
                        <option value="e_wallet">E-Wallet (GoPay, OVO, Dana)</option>
                        <option value="qris">QRIS</option>
                        <option value="va">Virtual Account</option>
                    </select>
                    @error('method')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-200">Total Pembayaran</label>
                    {{-- Visible, read-only field so user can't change value in UI --}}
                    <input type="text" value="Rp {{ number_format($grandTotal,0,',','.') }}" readonly class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white font-bold text-lg">
                    {{-- Hidden amount field is included for form completeness but server ignores client value and uses server-side calculation --}}
                    <input type="hidden" name="amount" value="{{ $grandTotal }}">
                </div>
                <div class="flex gap-3 pt-2">
                    <a href="{{ route('booking.review', $booking) }}" 
                       class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-gray-700 hover:bg-gray-600 text-white font-semibold transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali
                    </a>
                    <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold transition-all shadow-lg shadow-red-600/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Bayar Sekarang
                    </button>
                </div>
            </form>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-300">Grand Total</span>
                <span class="font-bold text-2xl text-white">Rp {{ number_format($grandTotal,0,',','.') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection