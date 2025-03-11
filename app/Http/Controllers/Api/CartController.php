<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Fetch the product
        $product = Product::findOrFail($validated['product_id']);

        // Ensure the requested quantity is in stock
        if ($product->stock < $validated['quantity']) {
            return response()->json([
                'message' => 'Requested quantity exceeds available stock.',
                'success' => false,
            ], 400); // Bad Request
        }

        // Calculate the discount and final price
        $discount = $product->discount > 0 ? $product->discount : 0;
        $priceAfterDiscount = $product->price - ($product->price * ($discount / 100));

        if (Auth::check()) {
            // Authenticated user logic
            $userId = Auth::id();
            $existingCartItem = Cart::where('user_id', $userId)
                ->where('product_id', $product->id)
                ->first();

            if ($existingCartItem) {
                // Update quantity and total price
                $existingCartItem->quantity += $validated['quantity'];
                $existingCartItem->total_price += $priceAfterDiscount * $validated['quantity'];
                $existingCartItem->save();
            } else {
                // Add new cart item
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $product->id,
                    'quantity' => $validated['quantity'],
                    'total_price' => $priceAfterDiscount * $validated['quantity'],
                ]);
            }

            return response()->json([
                'message' => 'Product added to cart successfully!',
                'success' => true,
            ], 200); // OK
        }

        return response()->json([
            'message' => 'User not authenticated.',
            'success' => false,
        ], 401); // Unauthorized
    }


    public function getCart(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $userId = Auth::id();

            // Get all cart items for the authenticated user
            $cartItems = Cart::where('user_id', $userId)
                ->with('product') // Eager load product details
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'message' => 'Your cart is empty.',
                    'cart' => [],
                    'success' => false,
                ], 200); // OK
            }

            // Return the cart items
            return response()->json([
                'message' => 'Cart fetched successfully.',
                'cart' => $cartItems,
                'success' => true,
            ], 200); // OK
        }

        return response()->json([
            'message' => 'User not authenticated.',
            'success' => false,
        ], 401); // Unauthorized
    }


    public function removeFromCart(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Check if the user is authenticated
        if (Auth::check()) {
            $userId = Auth::id();

            // Find the cart item for the authenticated user
            $cartItem = Cart::where('user_id', $userId)
                ->where('product_id', $validated['product_id'])
                ->first();

            // Check if the cart item exists
            if (!$cartItem) {
                return response()->json([
                    'message' => 'Cart item not found.',
                    'success' => false,
                ], 404); // Not Found
            }

            // Delete the cart item
            $cartItem->delete();

            return response()->json([
                'message' => 'Product removed from cart successfully.',
                'success' => true,
            ], 200); // OK
        }

        return response()->json([
            'message' => 'User not authenticated.',
            'success' => false,
        ], 401); // Unauthorized
    }
}
