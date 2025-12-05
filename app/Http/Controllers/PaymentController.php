<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Display the payment page for a booking
     * 
     * Validates that booking has tickets before allowing payment
     */
    public function show(Booking $booking): View
    {
        // Ensure user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking');
        }

        // Validate step: Must have tickets (seats selected)
        if ($booking->ticket->count() === 0) {
            return redirect()->route('booking.select-seats', $booking->showtime)
                ->with('error', 'Silakan pilih kursi terlebih dahulu sebelum melakukan pembayaran.');
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
            'method' => 'required|in:e_wallet,qris,va',
            'amount' => 'required|numeric|min:0.01',
        ]);

        // Map incoming method value to DB enum values defined in migration
        $methodMap = [
            'e_wallet' => 'E-Wallet',
            'qris' => 'QRIS',
            'va' => 'VA',
        ];

        $method = $methodMap[$validated['method']] ?? $validated['method'];

        // Use updateOrCreate to avoid unique constraint issues (one payment per booking)
        $payment = Payment::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'amount' => $validated['amount'],
                'method' => $method,
                'status' => 'pending',
                'payment_date' => now(),
            ]
        );

        try {
            // TODO: Integrate with real payment gateway here.
            // For now we'll simulate a synchronous successful payment.

            // Simulate success: update payment to 'success'
            $payment->update([
                'status' => 'success',
                'payment_date' => now(),
            ]);

            // Update booking status to 'paid'
            $booking->update(['status' => 'paid']);

            return redirect()->route('payment.success', $booking)->with('success', 'Payment processed successfully!');
        } catch (\Exception $e) {
            // On failure, mark payment as failed and keep booking as 'pending'
            try {
                $payment->update([
                    'status' => 'failed',
                    'payment_date' => now(),
                ]);
            } catch (\Exception $ex) {
                Log::error('Failed to update payment status to failed', ['error' => $ex->getMessage(), 'booking_id' => $booking->id]);
            }

            Log::error('Payment processing failed', ['error' => $e->getMessage(), 'booking_id' => $booking->id]);

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
