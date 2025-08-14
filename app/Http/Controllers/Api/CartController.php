<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
        if (Auth::check()) {
            $userId = Auth::id();

            $cartItems = Cart::where('user_id', $userId)
                ->with('product')
                ->get();

            // Transform product image to full URL
            $cartItems->each(function ($item) {
                if ($item->product && $item->product->image) {
                    $item->product->image = str_replace(
                        'localhost',
                        '10.0.2.2',
                        url('products/' . $item->product->image)
                    );
                }
            });

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'message' => 'Your cart is empty.',
                    'cart' => [],
                    'success' => false,
                ], 200);
            }

            return response()->json([
                'message' => 'Cart fetched successfully.',
                'cart' => $cartItems,
                'success' => true,
            ], 200);
        }

        return response()->json([
            'message' => 'User not authenticated.',
            'success' => false,
        ], 401);
    }



    public function removeFromCart(Cart $cart)
    {
        $user = Auth::guard('sanctum')->user();

        if (! $user) {
            return response()->json([
                'message' => 'User not authenticated.',
                'success' => false,
            ], 401);
        }

        if ($cart->user_id != $user->id) {
            return response()->json([
                'message' => 'Cart item not found.',
                'success' => false,
            ], 404);
        }

        $cart->delete();

        return response()->json([
            'message' => 'Product removed from cart successfully.',
            'success' => true,
        ], 200);
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'cart_id'  => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::with('product')->find($request->cart_id);

        if (! $cartItem) {
            return response()->json([
                'message' => 'Cart item not found.',
                'success' => false,
            ], 404);
        }

        // Update quantity and total_price
        $cartItem->quantity    = $request->quantity;
        $cartItem->total_price = $cartItem->product->price * $request->quantity;
        $cartItem->save();

        // Compute a full URL for the product image, replacing 'localhost' with '10.0.2.2'
        $imagePath = 'products/' . $cartItem->product->image;
        $fullUrl   = url($imagePath);
        $fullUrl   = str_replace('localhost', '10.0.2.2', $fullUrl);

        // Attach it to the product payload (you can name it whatever you like)
        $cartItem->product->image_url = $fullUrl;

        return response()->json([
            'message' => 'Cart quantity updated successfully.',
            'cart'    => $cartItem,
            'success' => true,
        ]);
    }


    public function checkoutCart(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telegram_number' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'province' => 'required|string|max:255',
            'delivery' => 'required|string|max:255',
            'payment_method' => 'nullable|string',
        ]);

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty.'], 400);
        }

        $orderNumber = uniqid();
        $totalPrice = 0;
        $created_at = now();
        $paymentMethod = $request->input('payment_method', 'Booking');
        $cart = [];

        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            if (!$product) continue;

            $productPrice = $product->price;
            if ($product->discount) {
                $discount = ($product->discount / 100) * $productPrice;
                $productPrice -= $discount;
            }

            $productTotalPrice = $productPrice * $item->quantity;
            $totalPrice += $productTotalPrice;

            $cart[] = (object)[
                'product' => $product,
                'quantity' => $item->quantity,
                'price' => $productPrice,
            ];

            $order = new Order();
            $order->user_id = $user->id;
            $order->product_id = $item->product_id;
            $order->order_number = $orderNumber;
            $order->name = $request->name;
            $order->telegram_number = $request->telegram_number;
            $order->address = $request->address;
            $order->province = $request->province;
            $order->delivery = $request->delivery;
            $order->payment_method = $paymentMethod;
            $order->total_price = $productTotalPrice;
            $order->created_at = $created_at;
            $order->save();
        }

        // Clear the cart
        Cart::where('user_id', $user->id)->delete();

        // Prepare the Telegram notification message
        $telegramChatId = 1081724526; // Your Telegram chat ID
        $telegramToken = '7550841713:AAEkrQBN6PKy3XsVLhJF1qUaJFpszQA33IU'; // Your Telegram bot token

        $message = "🚨 *New Order Alert* 🚨\n\n";
        $message .= "🆔 *Order ID:* {$orderNumber}\n";
        $message .= "👤 *Customer Name:* {$request->name}\n";
        $message .= "📧 *Telegram:* {$request->telegram_number}\n";
        $message .= "📦 *Order Details:*\n";

        foreach ($cart as $item) {
            $message .= "- {$item->product->name} x{$item->quantity} @ \${$item->price} each\n";
        }
        $message .= "\n💵 *Total Price:* \${$totalPrice}\n";
        $message .= "🏠 *Delivery Address:* {$request->address}\n";
        $message .= "🏢 *Delivery Province:* {$request->province}\n";
        $message .= "📱 *Contact Number:* {$request->telegram_number}\n";
        $message .= "🚚 *Delivery Method:* {$request->delivery}\n\n";
        $message .= "⏰ *Created At:* {$created_at}\n\n";
        $message .= "✅ *Thank you for your purchase!*";

        // Specify the image to be sent (can be a URL or file path)
        $imageUrl = 'https://cdn.vectorstock.com/i/500p/25/50/order-now-modern-web-banner-with-package-icon-vector-31212550.jpg'; // Replace with your image URL or local file path

        try {
            // Send the message and photo
            Http::withOptions(['verify' => false])->post("https://api.telegram.org/bot{$telegramToken}/sendPhoto", [
                'chat_id' => $telegramChatId,
                'photo' => $imageUrl,  // The image to send
                'caption' => $message, // The message caption (text)
                'parse_mode' => 'Markdown',
            ]);
        } catch (\Exception $e) {
            // Handle the exception (e.g., log or display an error message)
        }

        return response()->json([
            'message' => 'Order placed successfully',
            'order_number' => $orderNumber,
            'total_price' => $totalPrice,
            'created_at' => $created_at
        ], 200);
    }



    public function checkTransaction(Request $request)
    {
        try {
            $payload = $request->only(['md5']); // only send what Bakong API needs

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('BAKONG_API_TOKEN'),
                'Content-Type'  => 'application/json',
            ])->withoutVerifying() // skip SSL verify if needed
                ->post('https://api-bakong.nbc.gov.kh/v1/check_transaction_by_md5', $payload);

            $decodedResponse = $response->json();

            // If transaction successful, update order
            if (isset($decodedResponse['responseMessage']) && $decodedResponse['responseMessage'] === 'Success') {
                if ($request->has('order_number')) {
                    Order::where('order_number', $request->order_number)
                        ->update(['status' => 'success']);
                }
            }

            return response()->json($decodedResponse, $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to check transaction',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
