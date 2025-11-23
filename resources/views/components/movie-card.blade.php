@props(['film'])

<div class="relative group cursor-pointer h-80 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
    <!-- Poster Image -->
    @if($film->poster_url)
        <img 
            src="{{ $film->poster_url }}" 
            alt="{{ $film->title }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
        >
    @else
        <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
            <div class="text-center px-4">
                <svg class="h-12 w-12 text-gray-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm text-gray-400">No Image</p>
            </div>
        </div>
    @endif
    
    <!-- Overlay Info -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-between p-4">
        <!-- Top: Genre & Rating -->
        <div class="flex justify-between items-start">
            <span class="inline-block px-2 py-1 bg-red-600 text-white text-xs font-semibold rounded">
                {{ $film->genre }}
            </span>
            <span class="text-yellow-400 font-bold">⭐ {{ $film->rating }}/10</span>
        </div>

        <!-- Bottom: Title -->
        <div>
            <h3 class="text-white font-bold text-sm line-clamp-2">{{ $film->title }}</h3>
            <p class="text-gray-300 text-xs mt-2">{{ $film->released_year }}</p>
        </div>
    </div>
</div>
