<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class FoodDrinkPaymentController extends Controller
{
    /**
     * Display the payment page for food and drinks
     */
    public function show(): View
    {
        $cartItems = session('fooddrink_cart', []);
        $total = session('fooddrink_total', 0);

        // If cart is empty, redirect back
        if (empty($cartItems)) {
            return redirect()->route('fooddrink.index')->with('warning', 'Your cart is empty.');
        }

        return view('fooddrink-payment.show', [
            'total' => $total,
            'itemCount' => count($cartItems),
        ]);
    }

    /**
     * Process the payment for food and drinks
     */
    public function process(Request $request)
    {
        $cartItems = session('fooddrink_cart', []);
        $total = session('fooddrink_total', 0);

        // Validate cart
        if (empty($cartItems)) {
            return redirect()->route('fooddrink.index')->with('warning', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:credit_card,debit_card,e_wallet,bank_transfer',
            'amount' => 'required|numeric|min:0.01',
        ]);

        try {
            // Validate amount matches total
            if ((float)$validated['amount'] !== (float)$total) {
                return back()->with('error', 'Payment amount does not match cart total.');
            }

            // Process payment (integrate with actual payment gateway in production)
            // For now, we'll just clear the cart and show success

            session()->forget(['fooddrink_cart', 'fooddrink_total']);

            return redirect()->route('fooddrink.payment.success')->with('success', 'Payment processed successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Payment processing failed. Please try again.');
        }
    }

    /**
     * Display payment success page
     */
    public function success(): View
    {
        return view('fooddrink-payment.success');
    }

    /**
     * Display payment failure page
     */
    public function failure(): View
    {
        return view('fooddrink-payment.failure');
    }
}
