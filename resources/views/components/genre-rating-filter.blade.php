{{--
GENRE + RATING FILTER COMPONENT

Layout: Horizontal scrollable dengan genre di kiri, rating di kanan (sejajar)

Props:
- $genres: Collection (list of unique genres)
- $selectedGenre: string|null
- $selectedRating: string|null
--}}

<div class="bg-gray-900/30 backdrop-blur-sm rounded-xl p-4 mt-6">
    <div class="flex items-center gap-4 overflow-x-auto scrollbar-hide">
        {{-- Genre Filters --}}
        <div class="flex items-center gap-3 flex-shrink-0">
            <span class="text-gray-400 text-sm font-medium">Genre:</span>
            
            {{-- All Genres Button --}}
            <button 
                onclick="applyFilters('all', '{{ $selectedRating ?? 'all' }}')"
                class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 whitespace-nowrap {{ (!$selectedGenre || $selectedGenre === 'all') ? 'bg-red-600 text-white shadow-lg shadow-red-600/50' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}"
            >
                All
            </button>

            {{-- Individual Genre Buttons --}}
            @foreach($genres as $genre)
                <button 
                    onclick="applyFilters('{{ $genre }}', '{{ $selectedRating ?? 'all' }}')"
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 whitespace-nowrap {{ $selectedGenre === $genre ? 'bg-red-600 text-white shadow-lg shadow-red-600/50' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}"
                >
                    {{ $genre }}
                </button>
            @endforeach
        </div>

        {{-- Divider --}}
        <div class="w-px h-8 bg-gray-700 flex-shrink-0"></div>

        {{-- Rating Filters --}}
        <div class="flex items-center gap-3 flex-shrink-0">
            <span class="text-gray-400 text-sm font-medium">Rating:</span>
            
            {{-- All Ratings Button --}}
            <button 
                onclick="applyFilters('{{ $selectedGenre ?? 'all' }}', 'all')"
                class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 whitespace-nowrap {{ (!$selectedRating || $selectedRating === 'all') ? 'bg-red-600 text-white shadow-lg shadow-red-600/50' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}"
            >
                All
            </button>

            {{-- Rating Range Buttons --}}
            @foreach(['4.0+', '3.0+', '2.0+'] as $rating)
                <button 
                    onclick="applyFilters('{{ $selectedGenre ?? 'all' }}', '{{ $rating }}')"
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 whitespace-nowrap flex items-center gap-1 {{ $selectedRating === $rating ? 'bg-red-600 text-white shadow-lg shadow-red-600/50' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}"
                >
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    {{ $rating }}
                </button>
            @endforeach
        </div>
    </div>
</div>

<style>
/* Hide scrollbar but keep functionality */
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
