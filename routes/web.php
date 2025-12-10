<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\FoodDrinkController;
use App\Http\Controllers\FoodDrinkOrderController;
use App\Http\Controllers\FoodDrinkPaymentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Search API (public - accessible for all users)
Route::get('/api/search', [SearchController::class, 'search'])->name('search');

// Dashboard (requires authentication and email verification)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Movies page (public)
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{film}', [MovieController::class, 'show'])->name('movies.show');

// Food & Drink page (public - viewing only)
Route::get('/fooddrink', [FoodDrinkController::class, 'index'])->name('fooddrink.index');
Route::get('/fooddrink/{foodDrink}', [FoodDrinkController::class, 'show'])->name('fooddrink.show');

// Protected routes (requires authentication)
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // History/Order routes (requires authentication)
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/{booking}', [HistoryController::class, 'show'])->name('history.show');

    // Booking routes (seat selection and food/drinks)
    Route::get('/showtime/{showtime}/select-seats', [BookingController::class, 'selectSeats'])->name('booking.select-seats');
    Route::post('/showtime/{showtime}/booking', [BookingController::class, 'storeBooking'])->name('booking.store');
    Route::get('/booking/{booking}/add-food', [BookingController::class, 'addFood'])->name('booking.add-food');
    Route::post('/booking/{booking}/food-drink', [BookingController::class, 'storeFoodDrink'])->name('booking.store-food-drink');
    Route::get('/booking/{booking}/review', [BookingController::class, 'review'])->name('booking.review');
    Route::post('/booking/{booking}/cancel', [BookingController::class, 'cancelBooking'])->name('booking.cancel');

    // Payment routes
    Route::get('/booking/{booking}/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/booking/{booking}/payment', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/booking/{booking}/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/booking/{booking}/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');

    // Food & Drink Ordering (requires authentication)
    Route::get('/fooddrink-order/select', [FoodDrinkOrderController::class, 'select'])->name('fooddrink.select');
    Route::post('/fooddrink-order/store', [FoodDrinkOrderController::class, 'store'])->name('fooddrink.order.store');
    Route::get('/fooddrink-order/review', [FoodDrinkOrderController::class, 'review'])->name('fooddrink.review');
    Route::post('/fooddrink-order/clear', [FoodDrinkOrderController::class, 'clear'])->name('fooddrink.clear');

    // Food & Drink Payment (requires authentication)
    Route::get('/fooddrink-payment', [FoodDrinkPaymentController::class, 'show'])->name('fooddrink.payment.show');
    Route::post('/fooddrink-payment', [FoodDrinkPaymentController::class, 'process'])->name('fooddrink.payment.process');
    Route::get('/fooddrink-payment/success', [FoodDrinkPaymentController::class, 'success'])->name('fooddrink.payment.success');
    Route::get('/fooddrink-payment/failure', [FoodDrinkPaymentController::class, 'failure'])->name('fooddrink.payment.failure');
});

require __DIR__.'/auth.php';
