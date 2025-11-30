{{--
EMPTY STATE COMPONENT
Displayed when no movies found
--}}

<div class="col-span-full flex flex-col items-center justify-center py-20 px-4">
    {{-- Icon --}}
    <svg class="w-24 h-24 text-gray-600 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
    </svg>

    {{-- Message --}}
    <h3 class="text-2xl font-semibold text-gray-300 mb-2">No Movies Found</h3>
    <p class="text-gray-500 text-center max-w-md mb-6">
        @if(request('genre') || request('rating'))
            No movies found for selected filters. Try adjusting your filter criteria.
        @else
            No movies available at the moment. Please check back later.
        @endif
    </p>

    {{-- Reset Filter Button (if filters applied) --}}
    @if(request('genre') || request('rating'))
    <button 
        onclick="applyFilters('all', 'all')"
        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200"
    >
        Reset Filters
    </button>
    @endif
</div>
