<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    return Inertia::render('Dashboard', [
        'user' => $user,
        'role' => $user->role ?? null, // pastikan field 'role' ada di tabel users
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/barbershop', function () {
    return Inertia::render('Dashboard', [
        'user' => Auth::user(),
        'role' => Auth::user()->role,
    ]);
})->middleware(['auth', 'verified', 'checkrole:barbershop'])->name('dashboard.barbershop');

Route::get('/dashboard/pelanggan', function () {
    return Inertia::render('Dashboard', [
        'user' => Auth::user(),
        'role' => Auth::user()->role,
    ]);
})->middleware(['auth', 'verified', 'checkrole:pelanggan'])->name('dashboard.pelanggan');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
