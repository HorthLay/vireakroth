<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use GuzzleHttp\Client;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find the user by email first
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // If the user exists but doesn't have a google_id, update it
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->id,
                        'profile_photo' => $googleUser->avatar, // Save Google profile image
                        'email_verified_at' => $user->email_verified_at ?? now(), // Ensure email is marked verified
                    ]);
                }

                // Log in the user
                Auth::login($user);
            } else {
                // If the user does not exist, create a new one
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'profile_photo' => $googleUser->avatar,
                    'password' => bcrypt('password'), // Dummy password
                    'email_verified_at' => now(), // Mark email as verified
                ]);

                Auth::login($user);
            }

            return redirect()->route('home'); // Redirect after login
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Failed to log in with Google.']);
        }
    }
}
