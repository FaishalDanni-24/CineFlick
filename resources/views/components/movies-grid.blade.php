@foreach($films as $film)
    <x-movie-card :film="$film" />
@endforeach
