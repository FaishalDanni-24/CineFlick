<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MovieController extends Controller
{
    /**
     * Display a listing of films with filters and pagination
     */
    public function index(Request $request): View
    {
        // Get filter parameters
        $selectedGenre = $request->input('genre');
        $selectedRating = $request->input('rating');

        // Get all unique genres for filter
        $genres = Film::select('genre')
            ->distinct()
            ->pluck('genre')
            ->filter()
            ->sort()
            ->values();

        // Get 3 random films for hero slider
        $heroFilms = Film::inRandomOrder()
            ->take(3)
            ->get();

        // Build query for films
        $filmsQuery = Film::query();

        // Filter by genre if selected
        if ($selectedGenre && $selectedGenre !== 'all') {
            $filmsQuery->where('genre', $selectedGenre);
        }

        // Filter by rating if selected
        if ($selectedRating && $selectedRating !== 'all') {
            $minRating = (float) str_replace('+', '', $selectedRating);
            $filmsQuery->where('rating', '>=', $minRating);
        }

        // Paginate results (12 per page)
        $films = $filmsQuery->latest()
            ->paginate(12)
            ->withQueryString(); // Preserve query parameters in pagination links

        // Handle AJAX requests for infinite scroll
        if ($request->ajax()) {
            return view('components.movies-grid-infinite', compact('films'))->render();
        }

        return view('movies.index', compact(
            'heroFilms',
            'genres',
            'films',
            'selectedGenre',
            'selectedRating'
        ));
    }

    /**
     * Display a single film with detailed information
     */
    public function show(Film $film): View
    {
        $film->load('showtime');
        return view('movies.show', [
            'film' => $film,
            'showtimes' => $film->showtime,
        ]);
    }
}