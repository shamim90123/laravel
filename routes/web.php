<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
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
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// routes/web.php
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\FacebookLoginController;

Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);
Route::get('/auth/facebook', [FacebookLoginController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('/auth/facebook/callback', [FacebookLoginController::class, 'handleFacebookCallback']);

// routes/web.php (temporary debug route)
Route::get('/debug-google', function () {
    try {
        return Socialite::driver('google')->redirect();
    } catch (\Exception $e) {
        dd('Google Error:', $e->getMessage());
    }
});

// php artisan cache:clear
// php artisan config:clear
// php artisan route:clear
// php artisan clear-compiled
