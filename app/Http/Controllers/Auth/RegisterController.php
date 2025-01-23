<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (!Auth::check()) {
            return view('auth.register');
        }
        return redirect()->route('home');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'digits:10'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        // Validate phone number length and custom error messages
        $validator->after(function ($validator) use ($request) {
            if (strlen($request->input('phone')) !== 10) {
                $validator->errors()->add('phone', 'Please enter your real 10-digit phone number.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors([
                'name' => 'The name field is already taken.',
                'email' => 'The email has already been taken.',
                'phone' => 'Please enter your real 10-digit phone number.',
                'password' => 'The password confirmation does not match.',
                'password_confirmation' => 'The password confirmation does not match.'
            ])->withInput();
        }

        // Create the user
        $user = $this->create($request->all());

        // Log the user in
        auth()->login($user);

        // Redirect to the home page
        return redirect()->route('home'); // Adjust the route as needed
    }
}
