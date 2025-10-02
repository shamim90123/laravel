<?php
// app/Http/Controllers/Auth/FacebookLoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class FacebookLoginController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            
            // Check if user already exists
            $user = User::where('email', $facebookUser->getEmail())->first();
            
            if (!$user) {
                // Create new user
                $user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'password' => Hash::make(Str::random(24)),
                    'email_verified_at' => now(),
                    'facebook_id' => $facebookUser->getId(),
                ]);
                
                Log::info('New user registered via Facebook: ' . $facebookUser->getEmail());
            } else {
                // Update existing user with Facebook ID if not set
                if (empty($user->facebook_id)) {
                    $user->update(['facebook_id' => $facebookUser->getId()]);
                }
                
                Log::info('Existing user logged in via Facebook: ' . $facebookUser->getEmail());
            }
            
            // Log the user in
            Auth::login($user, true);
            
            return redirect()->intended('/dashboard');
            
        } catch (\Exception $e) {
            Log::error('Facebook authentication failed: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Facebook authentication failed. Please try again.');
        }
    }
}