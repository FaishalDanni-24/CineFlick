<?php

namespace App\Http\Controllers;

use App\Models\FoodDrink;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FoodDrinkController extends Controller
{
    /**
     * Display a listing of food/drink items with filtering
     */
    public function index(Request $request): View
    {
        $filter = $request->query('filter', 'all');
        $query = FoodDrink::query();

        // Apply filters
        switch ($filter) {
            case 'promo':
                $query->where('name', 'LIKE', '%promo%')
                      ->orWhere('name', 'LIKE', '%discount%');
                break;
            
            case 'combo':
                $query->where('name', 'LIKE', '%combo%');
                break;
            
            case 'food':
                $query->where('type', 'food');
                break;
            
            case 'drink':
                $query->where('type', 'drink');
                break;
        }

        $foodDrinks = $query->orderBy('name')->paginate(24)->withQueryString();

        // Get counts for badges
        $counts = [
            'all' => FoodDrink::count(),
            'promo' => FoodDrink::where('name', 'LIKE', '%promo%')
                                ->orWhere('name', 'LIKE', '%discount%')
                                ->count(),
            'combo' => FoodDrink::where('name', 'LIKE', '%combo%')->count(),
            'food' => FoodDrink::where('type', 'food')->count(),
            'drink' => FoodDrink::where('type', 'drink')->count(),
        ];

        return view('fooddrink.index', compact('foodDrinks', 'filter', 'counts'));
    }

    /**
     * Display a single food/drink item details
     */
    public function show(FoodDrink $foodDrink): View
    {
        return view('fooddrink.show', compact('foodDrink'));
    }
}
