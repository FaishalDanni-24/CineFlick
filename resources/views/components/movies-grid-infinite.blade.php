{{--
MOVIES GRID COMPONENT - INFINITE SCROLL VERSION

Data props:
- $films: LengthAwarePaginator
--}}

@if($films->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach($films as $film)
            @include('components.movie-card-enhanced', ['film' => $film])
        @endforeach
    </div>
@else
    @include('components.empty-state-movies')
@endif
