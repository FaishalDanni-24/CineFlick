<x-app-layout>
    <div class="w-full px-4 sm:px-6 lg:px-8 py-6 space-y-8">
        
        <!-- Hero Slider -->
        @if($featuredFilms->count() > 0)
            <x-hero-slider :films="$featuredFilms" />
        @else
            <div class="bg-gray-800 rounded-lg h-96 flex items-center justify-center">
                <p class="text-gray-400">Belum ada film featured</p>
            </div>
        @endif
        
        <!-- Section Title -->
        <div>
            <h2 class="text-2xl font-bold text-white mb-4">Semua Film</h2>
            
            <!-- Genre Filter -->
            @if($genres->count() > 0)
                <x-genre-filter :genres="$genres" :selected="$selectedGenre" />
            @endif
        </div>
        
        <!-- Movies Grid -->
        <div id="movies-grid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 w-full">
            @forelse($films as $film)
                <x-movie-card :film="$film" />
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="h-16 w-16 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16m10-16v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4"/>
                    </svg>
                    <p class="text-gray-400 text-lg">Tidak ada film di genre ini</p>
                </div>
            @endforelse
        </div>
        
    </div>
</x-app-layout>
