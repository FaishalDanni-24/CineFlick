<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $selectedGenre = $request -> input('genre');

        $featuredFilms = Film::latest()
            -> take(2)
            -> get();

        $genres = Film::select('genre')
            -> distinct()
            -> pluck('genre')
            -> filter()
            -> sort()
            -> values();

        $filmsQuery = Film::query();

        if ($selectedGenre) {
            $filmsQuery -> where('genre', $selectedGenre);
        }

        $films = $filmsQuery -> latest() -> get();

        if ($request -> ajax()) {
            return view('components.movies-grid', compact('films')) -> render();
        }

        return view('home', compact('featuredFilms', 'genres', 'films', 'selectedGenre'));
    }
}
