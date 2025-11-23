@extends('layouts.booking-process')

@section('title','Tiket')
@section('step','payment')

@section('content')
@php($film = $booking->showtime->film)
@php($tickets = $booking->ticket)
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
                        <div class="mt-1">Status Pembayaran : <span class="font-semibold">{{ $booking->payment->first()?->status ?? 'success' }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <div class="font-semibold mb-3">Tiket Anda</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($tickets as $t)
                    @php($label = ($t->seat?->seat_number).($t->seat?->seat_row))
                    <div class="rounded-xl border border-white/10 bg-black/30 p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-white/60">Seat</div>
                                <div class="text-xl font-bold">{{ $label }}</div>
                            </div>
                            <div class="px-3 py-1 rounded bg-white/10 text-xs">Studio {{ $booking->showtime->studio?->studio_name ?? '-' }}</div>
                        </div>
                        <div class="mt-3 text-sm text-white/60">Tiket Price: Rp {{ number_format($t->ticket_price ?? $booking->showtime->normal_price,0,',','.') }}</div>
                        <div class="mt-2 text-xs text-white/50">Booking ID: #{{ $booking->id }}</div>
                    </div>
                @empty
                    <div class="text-sm text-white/60">Tiket belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <button onclick="window.print()" class="w-full px-4 py-2 rounded bg-red-600 text-white font-semibold">Cetak / Simpan</button>
            <a href="{{ route('history.show',$booking) }}" class="mt-3 block text-center w-full px-4 py-2 rounded bg-white/10">Lihat di Riwayat</a>
        </div>
    </div>
</div>
@endsection