
@extends('layouts.booking-process')
@section('title','Pembayaran')
@section('step','payment')
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
            <div class="font-semibold mb-4">Pembayaran</div>
            <form method="POST" action="{{ route('payment.process', $booking) }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm mb-1">Metode</label>
                    <select name="method" class="w-full bg-black/30 border border-white/20 rounded px-3 py-2">
                        <option value="e_wallet">E-Wallet</option>
                        <option value="qris">QRIS</option>
                        <option value="va">VA</option>
                    </select>
                    @error('method')<div class="text-red-400 text-xs mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm mb-1">Jumlah</label>
                    {{-- Visible, read-only field so user can't change value in UI --}}
                    <input type="text" value="Rp {{ number_format($grandTotal,0,',','.') }}" readonly class="w-full bg-black/30 border border-white/20 rounded px-3 py-2">
                    {{-- Hidden amount field is included for form completeness but server ignores client value and uses server-side calculation --}}
                    <input type="hidden" name="amount" value="{{ $grandTotal }}">
                </div>
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold rounded px-4 py-2">Bayar</button>
            </form>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="flex justify-between">
                <span class="font-semibold">Total</span>
                <span class="font-bold">Rp {{ number_format($grandTotal,0,',','.') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection