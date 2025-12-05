<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Showtime;
use App\Models\Ticket;
use App\Models\Payment;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FoodDrink;

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
                'ticket_price' => $showtime->normal_price,
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
     * 
     * Validates that booking exists and has tickets before allowing access
     */
    public function addFood(Booking $booking): View
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking');
        }

        // Validate step: Must have tickets (meaning seats were selected)
        if ($booking->ticket->count() === 0) {
            return redirect()->route('booking.select-seats', $booking->showtime)
                ->with('error', 'Silakan pilih kursi terlebih dahulu.');
        }

        $booking->load(['showtime.film', 'ticket']);
        
        $foods = FoodDrink::all();
        return view('booking.add-food', [
            'booking' => $booking,
            'foods' => $foods,
        ]);
    }
    /**
     * Store food and drinks to the booking
     * 
     * Validates that booking exists and has tickets
     */
    public function storeFoodDrink(Request $request, Booking $booking)
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking');
        }

        // Validate step: Must have tickets
        if ($booking->ticket->count() === 0) {
            return redirect()->route('booking.select-seats', $booking->showtime)
                ->with('error', 'Silakan pilih kursi terlebih dahulu.');
        }

        $validated = $request->validate([
            'foods' => 'required|array',
            'foods.*' => 'nullable|integer|min:0',
        ]);

        // Get all food drinks to calculate prices
        $foodDrinks = FoodDrink::all()->keyBy('id');

        // Clear existing food drinks for this booking
        $booking->bookingFoodDrink()->delete();

        $totalFoodPrice = 0;

        // Add selected foods to booking
        foreach ($validated['foods'] as $foodId => $quantity) {
            $quantity = (int) $quantity;
            
            if ($quantity > 0 && isset($foodDrinks[$foodId])) {
                $food = $foodDrinks[$foodId];
                $subtotal = $food->price * $quantity;

                $booking->bookingFoodDrink()->create([
                    'food_drink_id' => $foodId,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ]);

                $totalFoodPrice += $subtotal;
            }
        }

        // Update booking total price (tickets + food)
        $ticketPrice = $booking->ticket->sum('ticket_price');
        $booking->update(['total_price' => $ticketPrice + $totalFoodPrice]);

        return redirect()->route('booking.review', $booking)->with('success', 'Food and drinks added successfully.');
    }

    /**
     * Display the booking summary/review page before payment
     * 
     * Validates that booking has tickets before allowing access
     */
    public function review(Booking $booking): View
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking');
        }

        // Validate step: Must have tickets (seats selected)
        if ($booking->ticket->count() === 0) {
            return redirect()->route('booking.select-seats', $booking->showtime)
                ->with('error', 'Silakan pilih kursi terlebih dahulu.');
        }

        $booking->load(['showtime.film', 'showtime.studio', 'ticket.seat', 'bookingFoodDrink.foodDrink']);

        return view('booking.review', [
            'booking' => $booking,
        ]);
    }

    /**
     * Cancel a booking
     * 
     * Only allows cancellation if payment status is 'pending'
     * If payment is already made, user must contact admin
     */
    public function cancelBooking(Booking $booking)
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking');
        }

        // Check if booking is already cancelled
        if ($booking->status === 'cancelled') {
            return redirect()->back()->with('info', 'Booking sudah dibatalkan sebelumnya.');
        }

        // Get the payment record for this booking
        $payment = $booking->payment()->first();

        // If no payment record exists yet, simply cancel the booking
        if (!$payment) {
            $booking->update(['status' => 'cancelled']);
            return redirect()->route('history.index')->with('success', 'Booking berhasil dibatalkan.');
        }

        // If payment status is not 'pending', user must contact admin
        if ($payment->status !== 'pending') {
            return view('booking.contact-admin', [
                'booking' => $booking,
                'message' => 'Pembatalan hanya tersedia sebelum melakukan pembayaran. Silakan hubungi admin untuk bantuan pembatalan atau pengembalian dana.',
            ]);
        }

        // Cancel the booking and mark payment as failed
        $booking->update(['status' => 'cancelled']);
        $payment->update(['status' => 'failed']);

        return redirect()->route('history.index')->with('success', 'Booking berhasil dibatalkan dan pembayaran telah dibatalkan.');
    }
}
