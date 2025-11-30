<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    /**
     * Display movies page with filters and pagination
     */
    public function index(Request $request)
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
        $heroFilms = Film::inRandomOrder()->take(3)->get();
        
        // Build query for filtered films
        $filmsQuery = Film::query();
        
        // Apply genre filter
        if ($selectedGenre && $selectedGenre !== 'all') {
            $filmsQuery->where('genre', $selectedGenre);
        }
        
        // Apply rating filter
        if ($selectedRating && $selectedRating !== 'all') {
            $ratingValue = (float) str_replace('+', '', $selectedRating);
            $filmsQuery->where('rating', '>=', $ratingValue);
        }
        
        // Paginate results (12 per page)
        $films = $filmsQuery->latest()->paginate(12);
        
        // If AJAX request (for infinite scroll), return only grid HTML
        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.movies-grid-infinite', compact('films'))->render(),
                'hasMore' => $films->hasMorePages(),
                'nextPage' => $films->currentPage() + 1
            ]);
        }
        
        // Regular request: return full page
        return view('movies.index', compact('heroFilms', 'genres', 'films', 'selectedGenre', 'selectedRating'));
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
