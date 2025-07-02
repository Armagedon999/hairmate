<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\HaircutHistoryController;

Route::middleware('auth:sanctum')->group(function () {
    // Barbershop
    Route::middleware('role:barbershop')->group(function () {
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('customers.histories', HaircutHistoryController::class);
        Route::get('customers-search', [CustomerController::class, 'search']);
        Route::get('customers/{customer}/histories-filter', [HaircutHistoryController::class, 'filter']);
    });
    // Pelanggan
    Route::middleware('role:pelanggan')->group(function () {
        Route::get('my-histories', [HaircutHistoryController::class, 'myHistories']);
        Route::post('my-histories/{history}/favorite', [HaircutHistoryController::class, 'setFavorite']);
        Route::get('my-histories-filter', [HaircutHistoryController::class, 'myHistoriesFilter']);
    });
    // Logout
    Route::post('logout', [AuthController::class, 'logout']);
});

// Public Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']); 