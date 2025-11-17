<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display the payment page for a booking
     */
    public function show(Booking $booking): View
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking');
        }

        $booking->load(['showtime.film', 'ticket', 'bookingFoodDrink.foodDrink', 'payment']);

        return view('payment.show', [
            'booking' => $booking,
        ]);
    }

    /**
     * Process the payment
     */
    public function process(Request $request, Booking $booking)
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:credit_card,debit_card,e_wallet,bank_transfer',
            'amount' => 'required|numeric|min:0.01',
        ]);

        try {
            // Create payment record
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'status' => 'completed',
                'transaction_date' => now(),
            ]);

            // Update booking status
            $booking->update(['status' => 'completed']);

            return redirect()->route('payment.success', $booking)->with('success', 'Payment processed successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Payment processing failed. Please try again.');
        }
    }

    /**
     * Display payment success page
     */
    public function success(Booking $booking): View
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking');
        }

        $booking->load(['showtime.film', 'ticket.seat', 'bookingFoodDrink.foodDrink', 'payment']);

        return view('payment.success', [
            'booking' => $booking,
        ]);
    }

    /**
     * Display payment failure page
     */
    public function failure(Booking $booking): View
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking');
        }

        return view('payment.failure', [
            'booking' => $booking,
        ]);
    }
}
