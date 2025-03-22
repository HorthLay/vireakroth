<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class VerificationController extends Controller
{
    /**
     * Handle the email verification link.
     *
     * @param  \Illuminate\Http\Request $request
     * @param string $id
     * @param string $hash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request, $id, $hash)
    {
        $user = \App\Models\User::findOrFail($id);

        if (sha1($user->email) === $hash) {
            if ($user->hasVerifiedEmail()) {
                return Redirect::route('home')->with('message', 'Your email has already been verified.');
            }

            $user->markEmailAsVerified();
            event(new Verified($user));

            return Redirect::route('home')->with('message', 'Your email has been verified successfully!');
        }

        return Redirect::route('home')->with('error', 'Invalid verification link.');
    }


    public function show()
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            return view('auth.verify'); // Ensure you have a `verify` view in the `auth` folder.
        }

        // Redirect to home if the user is not authenticated
        return redirect()->route('home');
    }


    public function resend(Request $request)
    {
        try {
            $user = $request->user();

            // Check if the user's email is already verified
            if ($user->hasVerifiedEmail()) {
                return redirect()->route('home')->with('success', 'Your email is already verified!');
            }

            // Check if 5 minutes have passed since the last verification email was sent
            if ($user->email_verification_sent_at && now()->diffInMinutes($user->email_verification_sent_at) < 5) {
                return view('auth.failed')->with('error', 'Please wait 5 minutes before requesting a new verification email.');
            }

            // Attempt to send the verification email
            $user->sendEmailVerificationNotification();

            // Update the timestamp when the verification email was sent
            $user->email_verification_sent_at = now();
            $user->save();

            // Return with a success message if email is sent
            return view('auth.success');
        } catch (\Exception $e) {
            // Handle any exception and return back with an error message
            return back()->with('error', 'Failed to send verification link. Please try again later.');
        }
    }
}
