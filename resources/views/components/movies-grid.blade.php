{{--
    MOVIES GRID COMPONENT
    
    Digunakan untuk AJAX response saat filter genre
    Data props:
    - $films: Collection
--}}

@if($films->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
        @foreach($films as $film)
            @include('components.movie-card', ['film' => $film])
        @endforeach
    </div>
@else
    <div class="text-center py-16">
        <p class="text-gray-400 text-lg">There are no movies for this genre.</p>
    </div>
@endif
