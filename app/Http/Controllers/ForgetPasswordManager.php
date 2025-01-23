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

        // If email doesn't exist, return an error message
        if (!$user) {
            return redirect()->back()->with('error', 'Email not found in our database!');
        }

        // Generate a random token for password reset
        $token = Str::random(64);

        // Insert the email and token into the password_resets table
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Send the password reset email with the token
        Mail::send('email.forget-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Your Password');
        });

        return redirect()->back()->with('success', 'We have e-mailed your password reset link!');
    }


    public function resetPassword($token)
    {
        $passwordReset = DB::table('password_resets')->where('token', $token)->first();

        if (!$passwordReset) {
            return redirect()->route('reset.password')->with('error', 'Invalid or expired token!');
        }

        $email = $passwordReset->email;

        return view('auth.passwords.news-password', compact('token', 'email'));
    }


    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
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
        User::where('email', $request->email)->update(["password" => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->to(route('login'))->with("success", "Your password has been changed!");
    }
}
