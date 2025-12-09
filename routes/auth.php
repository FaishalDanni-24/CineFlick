<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Menampilkan halaman form registrasi user baru
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    // Memproses data registrasi yang dikirim dari form
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Menampilkan halaman form login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // Memproses data login
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
