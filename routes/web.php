<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;

// Page d'accueil publique
Route::get('/', function () {
    return view('welcome');
});

// Routes protégées par authentification
Route::middleware('auth')->group(function () {

    // ===== ADMIN =====
    Route::middleware(['Admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/users', [UserController::class, 'index'])->name('users');
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

            Route::get('/events', [\App\Http\Controllers\Admin\EventController::class, 'index'])->name('events');
            Route::post('/events', [\App\Http\Controllers\Admin\EventController::class, 'store'])->name('events.store');
            Route::put('/events/{event}', [\App\Http\Controllers\Admin\EventController::class, 'update'])->name('events.update');
            Route::delete('/events/{event}', [\App\Http\Controllers\Admin\EventController::class, 'destroy'])->name('events.destroy');
        });

    // ===== CITIZEN =====
    Route::middleware(['citizen'])
        ->prefix('citizen')
        ->name('citizen.')
        ->group(function () {
            Route::get('/dashboard', [\App\Http\Controllers\Citizen\DashboardController::class, 'index'])->name('dashboard');
           // Route::get('/workouts', [\App\Http\Controllers\Citizen\WorkoutController::class, 'index'])->name('workouts');
            //Route::get('/rewards', [\App\Http\Controllers\Citizen\RewardController::class, 'index'])->name('rewards');
           // Route::get('/events', [\App\Http\Controllers\Citizen\EventController::class, 'index'])->name('events');
        });

});

// Route de déconnexion personnalisée (optionnelle)
Route::get('/logout-now', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
});
require __DIR__.'/auth.php';