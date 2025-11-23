@props(['genres', 'selected' => null])

<div 
    x-data="{ 
        selectedGenre: '{{ $selected ?? '' }}',
        async filterByGenre(genre) {
            this.selectedGenre = genre;
            
            const params = new URLSearchParams();
            if (genre) params.append('genre', genre);
            
            const response = await fetch('{{ route('home') }}?' + params.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const html = await response.text();
            document.getElementById('movies-grid').innerHTML = html;
        }
    }"
    class="flex items-center space-x-2 overflow-x-auto pb-2 scrollbar-hide w-full"
>
    <button 
        @click="filterByGenre('')"
        :class="selectedGenre === '' ? 'bg-red-600 text-white' : 'bg-gray-800 text-gray-300 hover:bg-gray-700'"
        class="px-6 py-2 rounded-full font-medium whitespace-nowrap transition"
    >
        All
    </button>
    
    @forelse($genres as $genre)
        <button 
            @click="filterByGenre('{{ $genre }}')"
            :class="selectedGenre === '{{ $genre }}' ? 'bg-red-600 text-white' : 'bg-gray-800 text-gray-300 hover:bg-gray-700'"
            class="px-6 py-2 rounded-full font-medium whitespace-nowrap transition"
        >
            {{ $genre }}
        </button>
    @empty
        <p class="text-gray-400">No genres available</p>
    @endforelse
</div>
