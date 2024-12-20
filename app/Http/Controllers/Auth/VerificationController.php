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
        return view('auth.verify'); // Ensure you have a `verify` view in the `auth` folder.
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
