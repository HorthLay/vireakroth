<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google Callback
     */
    public function handleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find the user or create one
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->id,
                        'profile_photo' => $googleUser->avatar,
                        'email_verified_at' => now(),
                    ]);
                }
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'profile_photo' => $googleUser->avatar,
                    'password' => Hash::make('randomPassword'),
                    'email_verified_at' => now(),
                ]);
            }

            // Generate a plain text token for API
            $token = $user->createToken('GoogleLogin')->plainTextToken;

            return response()->json([
                'message' => 'Successfully authenticated',
                'token' => $token,
                'user' => $user,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to log in with Google',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
