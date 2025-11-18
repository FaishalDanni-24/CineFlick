<?php

namespace App\Http\Controllers;

use App\Models\FoodDrink;
use Illuminate\View\View;
use Illuminate\Http\Request;

class FoodDrinkOrderController extends Controller
{
    /**
     * Display the food and drinks selection page
     */
    public function select(): View
    {
        $foodDrinks = FoodDrink::all();
        
        // Group food and drinks by type for better organization
        $groupedFoodDrinks = $foodDrinks->groupBy('type');
        
        return view('fooddrink.select', [
            'foodDrinks' => $foodDrinks,
            'groupedFoodDrinks' => $groupedFoodDrinks,
        ]);
    }

    /**
     * Store the selected food and drinks to session/cart
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|integer|exists:food_drinks,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Store items in session
        session(['fooddrink_cart' => $validated['items']]);

        // Calculate total price
        $total = 0;
        foreach ($validated['items'] as $item) {
            $foodDrink = FoodDrink::find($item['id']);
            $total += $foodDrink->price * $item['quantity'];
        }

        session(['fooddrink_total' => $total]);

        return redirect()->route('fooddrink.review')->with('success', 'Food and drinks added to cart.');
    }

    /**
     * Display the review/cart page for food and drinks
     */
    public function review(): View
    {
        $cartItems = session('fooddrink_cart', []);
        $total = session('fooddrink_total', 0);

        // Load food drink details for display
        $items = [];
        foreach ($cartItems as $item) {
            $foodDrink = FoodDrink::find($item['id']);
            if ($foodDrink) {
                $items[] = [
                    'foodDrink' => $foodDrink,
                    'quantity' => $item['quantity'],
                    'subtotal' => $foodDrink->price * $item['quantity'],
                ];
            }
        }

        return view('fooddrink.review', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    /**
     * Clear the food and drinks cart
     */
    public function clear()
    {
        session()->forget(['fooddrink_cart', 'fooddrink_total']);

        return redirect()->route('fooddrink.index')->with('success', 'Cart cleared.');
    }
}
