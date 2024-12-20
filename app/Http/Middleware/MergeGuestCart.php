<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MergeGuestCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $guestCart = session()->get('guest_cart', []);

            if (!empty($guestCart)) {
                foreach ($guestCart as $item) {
                    $existingCartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $item['product_id'])
                        ->first();

                    if ($existingCartItem) {
                        $existingCartItem->quantity += $item['quantity'];
                        $existingCartItem->total_price += $item['total_price'];
                        $existingCartItem->save();
                    } else {
                        Cart::create([
                            'user_id' => $user->id,
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'total_price' => $item['total_price'],
                        ]);
                    }
                }

                session()->forget('guest_cart');
            }
        }

        return $next($request);
    }
}
