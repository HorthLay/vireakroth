<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Fetch the product
        $product = Product::findOrFail($request->product_id);

        // Ensure the product is in stock
        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }

        // Check if the product has a discount
        $discount = 0;
        if ($product->discount > 0) {
            // If the discount exists, apply it. Assuming `discount` is a percentage.
            $discount = $product->discount;
        }

        // Calculate the price after applying the discount (if any)
        $priceAfterDiscount = $product->price;
        if ($discount > 0) {
            $priceAfterDiscount = $product->price - ($product->price * ($discount / 100));
        }

        if (Auth::check()) {
            // For authenticated users
            $userId = Auth::id();

            // Check if the product is already in the cart
            $existingCartItem = Cart::where('user_id', $userId)
                ->where('product_id', $product->id)
                ->first();

            if ($existingCartItem) {
                // Increment the quantity and update the total price
                $existingCartItem->quantity += 1;
                $existingCartItem->total_price += $priceAfterDiscount;
                $existingCartItem->save();
            } else {
                // Create a new cart item
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'total_price' => $priceAfterDiscount,
                ]);
            }
        } else {
            // For guest users, manage the cart using the session
            $guestCart = session()->get('guest_cart', []);

            // Check if the product is already in the cart
            if (isset($guestCart[$product->id])) {
                // Increment the quantity and update the total price
                $guestCart[$product->id]['quantity'] += 1;
                $guestCart[$product->id]['total_price'] += $priceAfterDiscount;
                $guestCart[$product->id]['original_total_price'] += $product->price; // Store original price
            } else {
                // Add a new product to the guest cart
                $guestCart[$product->id] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'quantity' => 1,
                    'total_price' => $priceAfterDiscount,
                    'original_total_price' => $product->price, // Store original price
                    'discount' => $discount, // Ensure discount is always set
                ];
            }

            // Save the updated guest cart in the session
            session()->put('guest_cart', $guestCart);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->quantity = $request->quantity;

        // Calculate the total price with potential discounts
        $discount = $cartItem->product->discount ?? 0;
        $priceAfterDiscount = $cartItem->product->price;
        if ($discount > 0) {
            $priceAfterDiscount = $cartItem->product->price - ($cartItem->product->price * ($discount / 100));
        }

        $cartItem->total_price = $cartItem->quantity * $priceAfterDiscount;
        $cartItem->save();

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function viewcart()
    {
        // If the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->get();
        } else {
            // For guest users, use session-based cart storage
            $cart = session()->get('guest_cart', []);
        }

        $total = 0;

        // Calculate total price
        foreach ($cart as $item) {
            $total += is_array($item) ? $item['total_price'] : $item->total_price;

            // Optional: Safely access discount if needed
            $discount = is_array($item) ? ($item['discount'] ?? 0) : $item->discount ?? 0;
        }

        return view('checkout.cart', compact('cart', 'total'));
    }






    // order view


    public function show($order_number)
    {
        // Retrieve the order by order_number
        $orders = Order::where('order_number', $order_number)->get();

        // Check if the orders exist
        if ($orders->isEmpty()) {
            return redirect()->route('orders.index')->withErrors(['error' => 'Order not found.']);
        }

        // Pass the orders to the view


        // Pass the order details to the view
        return view('checkout.order-detail', compact('orders'));
    }
}
