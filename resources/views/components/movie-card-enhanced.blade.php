{{--
ENHANCED MOVIE CARD COMPONENT

Props:
- $film: Film model

Features:
- Hover effect (scale + shadow)
- Rating badge
- Genre tag
- Responsive aspect ratio
--}}

<a 
    href="{{ route('movies.show', $film) }}" 
    class="group relative block overflow-hidden rounded-lg bg-gray-800 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-red-600/20"
>
    {{-- Poster Image --}}
    <div class="aspect-[2/3] overflow-hidden bg-gray-700">
        <img 
            src="{{ $film->poster_url ?? 'https://via.placeholder.com/300x450?text=No+Poster' }}" 
            alt="{{ $film->title }}"
            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
            loading="lazy"
        >
        
        {{-- Overlay on hover --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div class="absolute bottom-0 left-0 right-0 p-4">
                <p class="text-white text-sm line-clamp-3">
                    {{ Str::limit($film->sinopsis, 100) }}
                </p>
            </div>
        </div>
    </div>

    {{-- Rating Badge (Top Right) --}}
    <div class="absolute top-2 right-2 bg-black/70 backdrop-blur-sm px-2 py-1 rounded-full flex items-center gap-1">
        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>
        <span class="text-white text-xs font-semibold">{{ $film->rating }}</span>
    </div>

    {{-- Movie Info --}}
    <div class="p-3">
        <h3 class="text-white font-semibold text-sm line-clamp-2 mb-2 group-hover:text-red-500 transition-colors">
            {{ $film->title }}
        </h3>
        
        <div class="flex items-center justify-between text-xs text-gray-400">
            <span class="bg-gray-700 px-2 py-1 rounded">{{ $film->genre }}</span>
            <span>{{ $film->released_year }}</span>
        </div>
    </div>
</a>
