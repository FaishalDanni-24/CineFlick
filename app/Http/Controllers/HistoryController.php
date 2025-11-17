<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display all user bookings (order history)
     * Shows both past and current bookings
     */
    public function index(): View
    {
        // Get authenticated user
        $user = Auth::user();

        // Fetch all bookings for the user with related data
        $bookings = Booking::where('user_id', $user->id)
            ->with(['showtime.film', 'showtime.studio', 'ticket', 'bookingFoodDrink', 'payment'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Categorize bookings into past and upcoming
        $now = now();
        $pastBookings = $bookings->filter(function ($booking) use ($now) {
            $showDateTime = $booking->showtime->show_date . ' ' . $booking->showtime->start_time;
            return strtotime($showDateTime) < $now->timestamp;
        });

        $upcomingBookings = $bookings->filter(function ($booking) use ($now) {
            $showDateTime = $booking->showtime->show_date . ' ' . $booking->showtime->start_time;
            return strtotime($showDateTime) >= $now->timestamp;
        });

        return view('history.index', [
            'bookings' => $bookings,
            'pastBookings' => $pastBookings,
            'upcomingBookings' => $upcomingBookings,
        ]);
    }

    /**
     * Display a single booking details
     */
    public function show(Booking $booking): View
    {
        // Ensure user can only view their own bookings
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking');
        }

        $booking->load(['showtime.film', 'showtime.studio', 'ticket', 'bookingFoodDrink.foodDrink', 'payment']);

        return view('history.show', [
            'booking' => $booking,
        ]);
    }
}
