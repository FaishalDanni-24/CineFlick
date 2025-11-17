<?php

namespace App\Http\Controllers;

use App\Models\FoodDrink;
use Illuminate\View\View;

class FoodDrinkController extends Controller
{
    /**
     * Display all available food and drinks
     */
    public function index(): View
    {
        $foodDrinks = FoodDrink::all();
        
        // Group food and drinks by type for better organization
        $groupedFoodDrinks = $foodDrinks->groupBy('type');
        
        return view('fooddrink.index', [
            'foodDrinks' => $foodDrinks,
            'groupedFoodDrinks' => $groupedFoodDrinks,
        ]);
    }

    /**
     * Display a single food/drink item details
     */
    public function show(FoodDrink $foodDrink): View
    {
        return view('fooddrink.show', [
            'foodDrink' => $foodDrink,
        ]);
    }
}
