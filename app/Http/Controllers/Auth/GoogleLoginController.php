<?php
// app/Http/Controllers/Auth/GoogleLoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if (!$user) {
                // Create new user (registration)
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(24)), // Random password for social users
                    'email_verified_at' => now(), // Google emails are automatically verified
                    'google_id' => $googleUser->getId(), // Store Google ID if you added the field
                ]);
                
                Log::info('New user registered via Google: ' . $googleUser->getEmail());
            } else {
                // Update existing user with Google ID if not set
                if (empty($user->google_id)) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
                
                Log::info('Existing user logged in via Google: ' . $googleUser->getEmail());
            }
            
            // Log the user in
            Auth::login($user, true);
            
            return redirect()->intended('/dashboard');
            
        } catch (\Exception $e) {
            Log::error('Google authentication failed: ' . $e->getMessage());
            return redirect('/register')->with('error', 'Google authentication failed. Please try again.');
        }
    }
}