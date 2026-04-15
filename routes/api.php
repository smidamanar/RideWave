<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Passenger\TrajetController;
use App\Http\Controllers\Passenger\TrajetSearchController;
use App\Http\Controllers\Passenger\ReservationController;
use App\Http\Controllers\Passenger\AvisController;
use App\Http\Controllers\Driver\VehiculeController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // Trajets search
    Route::get('/trajets/search', [TrajetSearchController::class, 'search']);

    // Example Trajet CRUD (Driver)
    Route::get('/trajets', [TrajetController::class, 'index']);
    Route::post('/trajets', [TrajetController::class, 'store']);
    Route::apiResource('trajets', TrajetController::class);


    // 🔥 Reservations
    Route::apiResource('reservations', ReservationController::class);

    // ⭐ Avis
    Route::apiResource('avis', AvisController::class);

    // 🚗 Vehicules
    Route::apiResource('vehicules', VehiculeController::class);
    });
    
