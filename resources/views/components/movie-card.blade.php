{{-- Movie Card Component --}}
<div class="group cursor-pointer">
    <div class="relative overflow-hidden rounded-lg aspect-[2/3]">
        <img 
            src="{{ asset('storage/' . $film->poster_path) }}" 
            alt="{{ $film->title }}"
            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-300"
            onerror="this.src='{{ asset('images/bg.jpeg') }}'"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
            <div class="absolute bottom-0 p-4">
                <h3 class="text-white font-bold text-lg mb-2">{{ $film->title }}</h3>
                <div class="flex items-center gap-2 text-sm text-gray-300">
                    <span>{{ $film->rating }}/10</span>
                    <span>•</span>
                    <span>{{ $film->duration_mins }} min</span>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-2">
        <h4 class="text-white font-semibold truncate">{{ $film->title }}</h4>
        <span class="inline-block mt-1 px-2 py-1 bg-red-600/20 text-red-500 text-xs rounded">
            {{ $film->genre }}
        </span>
    </div>
</div>
