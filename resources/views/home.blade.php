<x-app-layout>
    <div class="w-full px-4 sm:px-6 lg:px-8 py-6 space-y-8">
        
        <!-- Hero Slider -->
        <x-hero-slider :films="$featuredFilms" />
        
        <!-- Genre Filter -->
        <x-genre-filter :genres="$genres" :selected="$selectedGenre" />
        
        <!-- Movies Grid -->
        <div id="movies-grid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 w-full">
            @foreach($films as $film)
                <x-movie-card :film="$film" />
            @endforeach
        </div>
        
        @if($films->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-400 text-lg">No movies found.</p>
            </div>
        @endif
        
    </div>
</x-app-layout>
