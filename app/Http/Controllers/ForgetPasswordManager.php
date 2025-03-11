<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordManager extends Controller
{
    public function forgotPassword()
    {
        return view('auth.passwords.forgot-password');
    }

    public function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email exists in the users table
        $user = User::where('email', $request->email)->first();

        // If email doesn't exist, prompt the user to register
        if (!$user) {
            return redirect()->back()->with('error', 'Email not found in our records. Please register first!');
        }

        // Check if a reset request was made in the last 5 minutes
        $recentRequest = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('created_at', '>=', Carbon::now()->subMinutes(5))
            ->first();

        if ($recentRequest) {
            return redirect()->back()->with('error', 'Please wait a few minutes before requesting another reset link.');
        }

        // Generate a random token for password reset
        $token = Str::random(64);

        // Insert or update the password reset token in the database
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        // Send the password reset email with the token
        Mail::send('email.forget-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Your Password');
        });

        return redirect()->back()->with('success', 'We have e-mailed your password reset link!');
    }




    public function resetPassword($token = null)
    {
        // Check if the token is missing
        if (!$token) {
            return redirect()->route('home')->with('error', 'Token is missing!');
        }

        // Fetch the password reset record by token
        $passwordReset = DB::table('password_resets')->where('token', $token)->first();

        // Check if the token exists and is not expired
        if (!$passwordReset || Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
            // Redirect back with error if token is invalid or expired
            return redirect()->route('home')->with('error', 'Invalid or expired token!');
        }

        $email = $passwordReset->email;

        // Return the password reset view with the token and email
        return view('auth.passwords.news-password', compact('token', 'email'));
    }



    public function resetPasswordPost(Request $request)
    {
        // Add custom message if passwords don't match
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ], [
            'password.confirmed' => 'Passwords do not match. Please try again.',
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return redirect()->to(route('reset.password'))->with("error", "Invalid token!");
        }

        // Update the password
        User::where('email', $request->email)->update(["password" => Hash::make($request->password)]);

        // Delete the reset token
        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->to(route('login'))->with("success", "Your password has been changed!");
    }
}
