<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $tab = $request->get('tab', 'all');

        $query = Booking::with([
            'showtime.film',          // ← PENTING! Load film
            'showtime.studio',        // ← Load studio
            'ticket.seat',            // ← Load seats
            'bookingFoodDrink.foodDrink' // ← Load F&B
        ])
        ->where('user_id', $user->id)
        ->latest('created_at');

        // Tab filtering
        if ($tab === 'movies') {
            $query->whereHas('showtime.film');
        } elseif ($tab === 'food') {
            $query->whereHas('bookingFoodDrink');
        }

        $bookings = $query->paginate(10);

        return view('history.index', compact('bookings', 'tab'));
    }

    public function show($id)
    {
        $booking = Booking::with([
            'showtime.film',
            'showtime.studio',
            'ticket.seat',
            'bookingFoodDrink.foodDrink',
            'payment'
        ])
        ->where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

        return view('history.show', compact('booking'));
    }
}
