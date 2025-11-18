<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Showtime;
use Illuminate\View\View;

class MovieController extends Controller
{
    /**
     * Display the movies page with all available films and their showtimes
     */
    public function index(): View
    {
        $films = Film::with('showtime')->get();
        $showtimes = Showtime::all();
        
        return view('movies.index', [
            'films' => $films,
            'showtimes' => $showtimes,
        ]);
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
