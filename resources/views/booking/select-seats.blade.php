@extends('layouts.booking-process')

@section('title','Pilih Kursi')
@section('step','select')
@section('content')
@php($film = $showtime->film)
@php($rows = $allSeats->groupBy('seat_row'))
@php($booked = collect($bookedSeats))

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-2 space-y-4">
        <div class="flex items-center gap-3 text-white">
            <a href="{{ route('movies.show',$film) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-white/10 hover:bg-white/20">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <div class="text-xl font-semibold">Choose Your Seat</div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <div class="mb-4 flex items-center justify-between">
                <div class="flex items-center gap-4 text-sm">
                    <div class="flex items-center gap-2"><span class="inline-block w-3 h-3 rounded bg-red-600"></span><span>Booked</span></div>
                    <div class="flex items-center gap-2"><span class="inline-block w-3 h-3 rounded bg-green-600"></span><span>Ready</span></div>
                </div>
                <div class="text-center w-full"><span class="px-3 py-1 rounded bg-white/10 text-xs tracking-widest">SCREEN</span></div>
            </div>

            <form id="seatForm" method="POST" action="{{ route('booking.store',$showtime) }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-9 gap-3">
                    <div class="col-span-9 grid grid-cols-9 gap-3">
                        <div class="col-span-1 flex flex-col gap-3 items-center justify-start text-sm text-white/80">
                            @foreach($rows->keys()->sort() as $rowLabel)
                                <span>{{ $rowLabel }}</span>
                            @endforeach
                        </div>
                        <div class="col-span-8">
                            @foreach($rows->keys()->sort() as $rowLabel)
                                @php($rowSeats = ($rows[$rowLabel] ?? collect())->sortBy('seat_number'))
                                <div class="grid grid-cols-8 gap-3 mb-3">
                                    @foreach($rowSeats as $seat)
                                        @php($isBooked = $booked->contains($seat->id))
                                        <button type="button" data-id="{{ $seat->id }}" data-row="{{ $seat->seat_row }}" data-num="{{ $seat->seat_number }}"
                                            class="seat w-8 h-8 md:w-10 md:h-10 rounded focus:outline-none transition
                                            {{ $isBooked ? 'bg-red-600 cursor-not-allowed opacity-70' : 'bg-green-600 hover:bg-green-500 cursor-pointer' }}"
                                            {{ $isBooked ? 'disabled' : '' }}
                                        ></button>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="selectedInputs"></div>

                <div class="flex items-center justify-between">
                    <button type="button" id="clearBtn" class="px-6 py-2 rounded-full bg-red-600 text-white font-semibold">Delete</button>
                    <button type="submit" id="nextBtn" class="px-6 py-2 rounded-full bg-green-600 text-white font-semibold">Next</button>
                </div>
            </form>
        </div>
    </div>

    <div class="space-y-4">
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <div class="flex items-start gap-4">
                @if($film?->poster_url)
                    <img src="{{ $film->poster_url }}" alt="{{ $film->title }}" class="w-24 h-36 object-cover rounded">
                @endif
                <div class="flex-1">
                    <div class="text-lg font-bold">{{ $film->title }}</div>
                    <div class="mt-2 text-sm">
                        <div>Date : <span class="font-semibold">{{ \Illuminate\Support\Carbon::parse($showtime->show_date)->translatedFormat('l, d-m-Y') }}</span></div>
                        <div class="mt-1">Time : <span class="font-semibold">{{ $showtime->start_time }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            <div class="text-sm">Number Seat :</div>
            <div id="seatBadges" class="mt-2 flex flex-wrap gap-2"></div>
            <div class="mt-4 text-xs text-white/70">Jumlah kursi</div>
            <div id="seatCount" class="text-lg font-semibold">0</div>
            <div class="mt-2 text-xs text-white/70">Harga</div>
            <div id="seatPrice" class="text-lg font-semibold">Rp 0</div>
        </div>
    </div>
</div>

<script>
    const booked = new Set(@json($bookedSeats));
    const selected = new Map();
    const pricePerSeat = Number(@json($showtime->normal_price ?? 0));
    const seatBadges = document.getElementById('seatBadges');
    const seatCount = document.getElementById('seatCount');
    const seatPrice = document.getElementById('seatPrice');
    const inputs = document.getElementById('selectedInputs');
    function rp(n){
        return 'Rp ' + Number(n).toLocaleString('id-ID');
    }
    function render(){
        seatBadges.innerHTML = '';
        inputs.innerHTML = '';
        selected.forEach((label,id)=>{
            const b = document.createElement('div');
            b.className = 'px-3 py-1 rounded bg-red-600 text-white font-bold';
            b.textContent = label;
            seatBadges.appendChild(b);
            const i = document.createElement('input');
            i.type = 'hidden';
            i.name = 'selected_seats[]';
            i.value = id;
            inputs.appendChild(i);
        });
        seatCount.textContent = selected.size;
        seatPrice.textContent = rp(selected.size * pricePerSeat);
    }
    document.querySelectorAll('.seat').forEach(el=>{
        if(el.disabled) return;
        el.addEventListener('click',()=>{
            const id = Number(el.dataset.id);
            const label = `${el.dataset.num}${el.dataset.row}`;
            if(selected.has(id)){
                selected.delete(id);
                el.classList.remove('ring-2','ring-white');
                el.classList.remove('bg-green-400');
                el.classList.add('bg-green-600');
            }else{
                selected.set(id,label);
                el.classList.add('ring-2','ring-white');
                el.classList.remove('bg-green-600');
                el.classList.add('bg-green-400');
            }
            render();
        });
    });
    document.getElementById('clearBtn').addEventListener('click',()=>{
        selected.clear();
        document.querySelectorAll('.seat').forEach(el=>{
            if(!booked.has(Number(el.dataset.id))){
                el.classList.remove('ring-2','ring-white');
                el.classList.remove('bg-green-400');
                el.classList.add('bg-green-600');
            }
        });
        render();
    });
    render();
</script>
@endsection