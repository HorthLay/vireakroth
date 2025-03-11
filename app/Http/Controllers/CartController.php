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


    public function CartAddDetail(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Fetch the product
        $product = Product::findOrFail($request->product_id);

        // Ensure the requested quantity is in stock
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Requested quantity exceeds available stock.');
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
                $existingCartItem->quantity += $request->quantity;
                $existingCartItem->total_price += $priceAfterDiscount * $request->quantity;
                $existingCartItem->save();
            } else {
                // Add new cart item
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'total_price' => $priceAfterDiscount * $request->quantity,
                ]);
            }
        } else {
            // Guest user logic
            $guestCart = session()->get('guest_cart', []);

            if (isset($guestCart[$product->id])) {
                // Update quantity and total price
                $guestCart[$product->id]['quantity'] += $request->quantity;
                $guestCart[$product->id]['total_price'] += $priceAfterDiscount * $request->quantity;
                $guestCart[$product->id]['original_total_price'] += $product->price * $request->quantity;
            } else {
                // Add new product to the guest cart
                $guestCart[$product->id] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $request->quantity,
                    'total_price' => $priceAfterDiscount * $request->quantity,
                    'original_total_price' => $product->price * $request->quantity,
                    'discount' => $discount,
                ];
            }

            // Save the updated guest cart in the session
            session()->put('guest_cart', $guestCart);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }



    public function getCart()
    {
        $cart = session()->get('cart', []);
        return response()->json(['cart' => $cart], 200);
    }


    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json(['message' => 'Product removed from cart', 'cart' => $cart], 200);
    }


    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            // Update for authenticated user
            $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->firstOrFail();

            // Update quantity
            $cartItem->quantity = $request->input('quantity');

            // Calculate the total price with discounts
            $product = $cartItem->product;
            $discount = $product->discount ?? 0;
            $priceAfterDiscount = $product->price;
            if ($discount > 0) {
                $priceAfterDiscount = $product->price - ($product->price * ($discount / 100));
            }

            $cartItem->total_price = $cartItem->quantity * $priceAfterDiscount;
            $cartItem->save();
        } else {
            // Update for guest user in session
            $cart = session()->get('guest_cart', []);
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $request->input('quantity');

                // Recalculate total price with discounts
                $product = Product::find($id);
                $discount = $product->discount ?? 0;
                $priceAfterDiscount = $product->price;
                if ($discount > 0) {
                    $priceAfterDiscount = $product->price - ($product->price * ($discount / 100));
                }

                $cart[$id]['total_price'] = $cart[$id]['quantity'] * $priceAfterDiscount;
                session()->put('guest_cart', $cart);
            } else {
                return redirect()->back()->with('error', 'Product not found in cart.');
            }
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }


    public function viewcart()
    {
        $cartItems = [];
        $total = 0;

        if (Auth::check()) {
            // Authenticated user's cart
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->with('product')->get();

            // Normalize cart items
            foreach ($cart as $item) {
                $cartItems[] = [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'product' => $item->product,
                ];
            }
        } else {
            // Guest cart from session
            $cart = session()->get('guest_cart', []);

            foreach ($cart as $key => $item) {
                $product = Product::find($item['product_id']); // Fetch product details
                $cartItems[] = [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'product' => $product,
                ];
            }
        }

        // Calculate the total price
        foreach ($cartItems as $item) {
            $product = $item['product'];
            if ($product) {
                $priceAfterDiscount = $product->price;
                if ($product->discount > 0) {
                    $priceAfterDiscount -= $product->price * ($product->discount / 100);
                }
                $total += $priceAfterDiscount * $item['quantity'];
            }
        }

        // Pass $cartItems and $total to the view
        return view('checkout.cart', compact('cartItems', 'total'));
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
