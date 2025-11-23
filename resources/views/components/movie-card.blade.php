@props(['film'])

<div class="group relative bg-gray-800/80 backdrop-blur-sm rounded-lg overflow-hidden hover:ring-2 hover:ring-red-600 transition shadow-lg hover:shadow-2xl">
    <div class="aspect-[2/3] relative overflow-hidden bg-gray-700">
        <img 
            src="{{ $film->poster_url ?? asset('images/pattern-3.jpg') }}" 
            alt="{{ $film->title }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
            onerror="this.src='{{ asset('images/pattern-3.jpg') }}'"
        >
        
        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
            <button 
                @click="$dispatch('open-trailer', { url: '{{ $film->trailer_url ?? '#' }}' })"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium flex items-center space-x-2 shadow-lg transform group-hover:scale-105 transition"
            >
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                </svg>
                <span>Watch Trailer</span>
            </button>
        </div>
    </div>
    
    <div class="p-3">
        <h3 class="text-white font-semibold text-sm truncate mb-1">{{ $film->title }}</h3>
        <p class="text-xs text-red-500 font-medium">{{ $film->genre }}</p>
    </div>
</div>
