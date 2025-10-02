<?php
// app/Http/Controllers/Auth/GoogleLoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

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
            
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if (!$user) {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(24)), // Random password
                    'email_verified_at' => now(), // Google emails are verified
                ]);
            }
            
            // Log the user in
            Auth::login($user);
            
            return redirect('/dashboard');
            
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google login failed: ' . $e->getMessage());
        }
    }
}