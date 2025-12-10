<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search movies by title and genre
     * Returns JSON response for AJAX requests
     */
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        
        // Validasi input
        if (strlen($query) < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Search query cannot be empty',
                'results' => []
            ]);
        }

        // Limit query length untuk prevent expensive queries
        if (strlen($query) > 100) {
            $query = substr($query, 0, 100);
        }

        // Search by title (case-insensitive, partial match)
        $filmsByTitle = Film::where('title', 'LIKE', "%{$query}%")
            ->select('id', 'title', 'genre', 'poster_path', 'rating')
            ->limit(8)
            ->get();

        // Search by genre (exact match)
        $filmsByGenre = Film::where('genre', 'LIKE', "%{$query}%")
            ->select('id', 'title', 'genre', 'poster_path', 'rating')
            ->limit(8)
            ->get();

        // Merge dan remove duplicates
        $allResults = $filmsByTitle->merge($filmsByGenre)->unique('id')->take(10);

        // Format results untuk frontend
        $results = $allResults->map(function ($film) {
            return [
                'id' => $film->id,
                'title' => $film->title,
                'genre' => $film->genre,
                'poster_url' => $film->poster_url,
                'rating' => $film->rating,
                'url' => route('movies.show', $film->id)
            ];
        })->values();

        return response()->json([
            'success' => true,
            'query' => $query,
            'count' => $results->count(),
            'results' => $results
        ]);
    }
}
