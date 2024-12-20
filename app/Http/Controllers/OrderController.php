<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;


use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    //checkout 

    public function index()
    {
        $order = Order::all();
        return view('checkout.orders', compact('order'));
    }

    public function showOrderPage()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get(); // Get cart from the database for logged-in user

        // Calculate the total price
        $total = 0;

        foreach ($cart as $item) {
            $product = Product::find($item->product_id);
            $priceAfterDiscount = $product->price;
            if ($product->discount > 0) {
                $priceAfterDiscount = $product->price - ($product->price * ($product->discount / 100));
            }
            $total += $priceAfterDiscount * $item->quantity;
        }

        return view('checkout.order', compact('cart', 'user', 'total'));
    }







    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
            'name' => 'required|string|max:255',
            'telegram_number' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'province' => 'required|string|max:255',
        ]);

        // Get the current authenticated user
        $user = Auth::user();
        $totalPrice = 0;
        $orderNumber = uniqid();
        $cart = [];

        foreach ($request->product_ids as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $request->quantities[$index];

            if (!$product) {
                return redirect()->back()->withErrors(['product_id' => 'The selected product does not exist.']);
            }

            $productPrice = $product->price;
            if ($product->discount) {
                $discount = ($product->discount / 100) * $productPrice;
                $productPrice -= $discount;
            }

            $productTotalPrice = $productPrice * $quantity;
            $totalPrice += $productTotalPrice;

            // Save the cart item for Telegram message
            $cart[] = (object)[
                'product' => $product,
                'quantity' => $quantity,
                'price' => $productPrice,
            ];

            $order = new Order();
            $order->user_id = $user->id;
            $order->product_id = $productId;
            $order->order_number = $orderNumber;
            $order->name = $request->name;
            $order->telegram_number = $request->telegram_number;
            $order->address = $request->address;
            $order->delivery = $request->delivery;
            $order->total_price = $productTotalPrice;
            $order->province = $request->province;
            $order->save();
        }

        // Clear the user's cart after placing the order
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
        $message .= "📱 *Contact Number:* {$request->telegram_number}\n";
        $message .= "🚚 *Delivery Method:* {$request->delivery}\n\n";
        $message .= "✅ *Thank you for your purchase!*";

        try {
            Http::withOptions(['verify' => false])->post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                'chat_id' => $telegramChatId,
                'text' => $message,
                'parse_mode' => 'Markdown',
            ]);
        } catch (\Exception $e) {
            // Handle the exception (e.g., log or display an error message)
        }

        // Redirect to the order details page with the order_number
        return redirect()->route('order.show', ['order_number' => $orderNumber])
            ->with('success', 'Order placed successfully! Your order number is ' . $orderNumber);
    }









    public function showCheckout(Request $request)
    {
        $cart = session('cart', []);
        $total = array_sum(array_column($cart, 'total_price'));

        // Get data from the previous form submission
        $address = $request->address;
        $telegram = $request->telegram_number;
        $delivery = $request->delivery;
        $name = $request->name;
        $province = $request->province;
        return view('checkout.show', compact('cart', 'total', 'address', 'telegram', 'delivery', 'name', 'province'));
    }
}
