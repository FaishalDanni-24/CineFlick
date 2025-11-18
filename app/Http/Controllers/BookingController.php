<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Showtime;
use App\Models\Ticket;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display the seat selection page for a specific showtime
     */
    public function selectSeats(Showtime $showtime): View
    {
        // Load related film and studio information
        $showtime->load(['film', 'studio.seat']);
        
        // Get all seats for the studio
        $allSeats = $showtime->studio->seat()->get();
        
        // Get already booked seats for this showtime
        $bookedSeats = Ticket::whereHas('booking', function ($query) use ($showtime) {
            $query->where('showtime_id', $showtime->id);
        })->pluck('seat_id')->toArray();
        
        return view('booking.select-seats', [
            'showtime' => $showtime,
            'allSeats' => $allSeats,
            'bookedSeats' => $bookedSeats,
        ]);
    }

    /**
     * Store the booking with selected seats
     */
    public function storeBooking(Request $request, Showtime $showtime)
    {
        $validated = $request->validate([
            'selected_seats' => 'required|array|min:1',
            'selected_seats.*' => 'required|integer|exists:seats,id',
        ]);

        // Create booking record
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'showtime_id' => $showtime->id,
            'booking_date' => now(),
            'status' => 'pending',
            'total_price' => 0, // Will be calculated after adding food/drinks
        ]);

        // Create ticket records for each selected seat
        foreach ($validated['selected_seats'] as $seatId) {
            Ticket::create([
                'booking_id' => $booking->id,
                'seat_id' => $seatId,
                'status' => 'pending',
            ]);
        }

        // Calculate and update total price
        $ticketPrice = $showtime->normal_price * count($validated['selected_seats']);
        $booking->update(['total_price' => $ticketPrice]);

        return redirect()->route('booking.add-food', $booking)->with('success', 'Seats selected successfully. Add food and drinks (optional).');
    }

    /**
     * Display page to add food and drinks to booking
     */
    public function addFood(Booking $booking): View
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking');
        }

        $booking->load(['showtime.film', 'ticket']);
        
        return view('booking.add-food', [
            'booking' => $booking,
        ]);
    }

    /**
     * Display the booking summary/review page before payment
     */
    public function review(Booking $booking): View
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking');
        }

        $booking->load(['showtime.film', 'showtime.studio', 'ticket.seat', 'bookingFoodDrink.foodDrink']);

        return view('booking.review', [
            'booking' => $booking,
        ]);
    }
}
