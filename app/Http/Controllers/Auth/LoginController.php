<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // If the user is not authenticated, allow them to view the login form
        if (!Auth::check()) {
            return view('auth.login');
        }

        // If the user is authenticated, redirect them to the home page
        return redirect()->route('home'); // Or any route you want for authenticated users
    }


    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('home'); // Adjust the route as needed
        }

        return back()->withErrors([
            'email' => 'The email or password is incorrect.',
            'password' => 'The email or password is incorrect.',
        ])->onlyInput('email', 'password'); // Retain the email field value
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }


    protected function authenticated(Request $request, $user)
    {
        // Check if a guest cart exists in the session
        $guestCart = session()->get('guest_cart', []);

        if (!empty($guestCart)) {
            foreach ($guestCart as $item) {
                // Check if the item already exists in the database cart for the logged-in user
                $existingCartItem = Cart::where('user_id', $user->id)
                    ->where('product_id', $item['product_id'])
                    ->first();

                if ($existingCartItem) {
                    // Update the quantity and total price if the product exists in the user's cart
                    $existingCartItem->quantity += $item['quantity'];
                    $existingCartItem->total_price += $item['total_price'];
                    $existingCartItem->save();
                } else {
                    // Create a new cart item for the user
                    Cart::create([
                        'user_id' => $user->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'total_price' => $item['total_price'],
                    ]);
                }
            }

            // Clear the guest cart from the session
            session()->forget('guest_cart');
        }
    }
}
