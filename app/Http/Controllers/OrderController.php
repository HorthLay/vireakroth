<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;


use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Reminder;
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


    // order Number view

    public function showOrderByNumber($order_number)
    {
        $orders = Order::where('order_number', $order_number)->get();

        if ($orders->isEmpty()) {
            // Handle empty orders gracefully
            return view('order.details')->with('error', 'Order not found');
        }
        return view('checkout.view_order', compact('orders'));
    }



    public function OrderView()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('checkout.orderview', compact('orders'));
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
        $message .= "🏢 *Delivery Province:* {$request->province}\n";
        $message .= "📱 *Contact Number:* {$request->telegram_number}\n";
        $message .= "🚚 *Delivery Method:* {$request->delivery}\n\n";
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

        // Redirect to the order details page with the order_number
        return redirect()->route('order.show', ['order_number' => $orderNumber])
            ->with('success', 'Order placed successfully! Your order number is ' . $orderNumber);
    }


    public function callordernumber(Request $request, $order_number)
    {
        // Retrieve all orders with the given order_number
        $orders = Order::where('order_number', $order_number)->get();

        if ($orders->isEmpty()) {
            return redirect('/ordersView')->with('error', 'Order not found!');
        }

        // Update the status of all matching orders
        foreach ($orders as $order) {
            $order->status = 'canceled';
            $order->save();
        }

        $telegramChatId = 1081724526; // Your Telegram chat ID
        $telegramToken = '8124975670:AAGjJGP4ULkfEuRhNdTIk2REF_YIffcBSic'; // Your Telegram bot token

        $customerName = $order->name ?? 'N/A'; // Use the name field directly
        $telegramNumber = $order->telegram_number ?? 'N/A';


        $message = "🚨 *Order Canceled Alert* 🚨\n\n";
        $message .= "🆔 *Order ID:* {$order_number}\n";
        $message .= "👤 *Customer Name:* {$customerName}\n";
        $message .= "📧 *Telegram:* {$telegramNumber}\n";
        $message .= "⛔️ *Order Canceled!*";
        $message .= "\n\n*Cancelled Order At:*  " . now()->format('Y-m-d H:i:s');
        $message .= "\n\n*Thank you for your purchase!*";

        try {
            Http::withOptions(['verify' => false])->post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                'chat_id' => $telegramChatId,
                'text' => $message,

                'parse_mode' => 'Markdown',
            ]);
        } catch (\Exception $e) {
            // Handle the exception (e.g., log or display an error message)
        }

        return redirect('/ordersView')->with('success', 'Order canceled successfully!');
    }






    // delete Cart
    public function destroy($id)
    {
        if (Auth::check()) {
            // For authenticated users, delete from the database
            $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

            if ($cartItem) {
                $cartItem->delete(); // Delete the cart item
                return redirect('/cart')->with('success', 'Item removed from cart.');
            } else {
                return redirect('/cart')->with('error', 'Item not found.');
            }
        } else {
            // For guest users, delete from session
            $cart = session()->get('guest_cart', []);

            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('guest_cart', $cart); // Update the session
                return redirect('/cart')->with('success', 'Item removed from cart.');
            } else {
                return redirect('/cart')->with('error', 'Item not found.');
            }
        }
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


    public function checkout($order_number)
    {
        // Find the orders related to the given order number
        $orders = Order::where('order_number', $order_number)->get();

        if ($orders->isEmpty()) {
            return back()->withErrors('Order not found.');
        }

        foreach ($orders as $order) {
            // Find the product related to this order
            $product = Product::find($order->product_id);

            if (!$product) {
                return back()->withErrors('Product not found for Order ID: ' . $order->order_number);
            }

            // Check stock availability
            if ($product->stock >= $order->quantity) {
                // Reduce stock and increase quantity sold
                $product->stock -= $order->quantity;
                $product->quantity_sold += $order->quantity;

                // Save the updated product details
                $product->save();

                // Update the order status to 'completed'
                $order->status = 'paid';
                $order->save();
            } else {
                return back()->withErrors('Not enough stock for product: ' . $product->name);
            }
        }

        return back()->with('success', 'Order has been successfully completed!');
    }



    public function checkoutpage($order_number)
    {
        // Retrieve the order based on the order_number
        $order = Order::where('order_number', $order_number)->get(); // Use first() to get a single order

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Get the total price from the order record
        $totalPrice = $order->sum('total_price'); // Access total_price directly from the order object

        return view('home.checkout', compact('order', 'totalPrice', 'order_number'));
    }


    public function updateStatus(Request $request)
    {
        $orderNumber = $request->input('order_number');

        // Find the order by order_number
        $order = Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            return response()->json(['responseMessage' => 'Order not found'], 404);
        }

        // Update the status if it's pending
        if ($order->status === 'pending') {
            $order->status = 'paid';
            $order->save();

            return response()->json(['responseMessage' => 'Success'], 200);
        }

        return response()->json(['responseMessage' => 'Invalid status or already paid'], 400);
    }



    public function success($order_number)
    {
        $orders = Order::where('order_number', $order_number)->get();


        return view('home.success', compact('orders'));
    }


    public function Status(Request $request, $order_number)
    {
        // Validate the status input if needed
        $request->validate([
            'status' => 'required|string|in:success,pending,canceled', // Adjust to your status options
        ]);

        $status = $request->input('status');

        // Find all orders with the same order_number
        $orders = Order::where('order_number', $order_number)->get();

        // If there are any orders, update their status
        foreach ($orders as $order) {
            $order->status = $status;
            $order->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    public function search(Request $request)
    {
        $searchKeyword = $request->input('searchKeyword');

        // Paginate the orders based on the search keyword
        $orders = Order::where('name', 'LIKE', '%' . $searchKeyword . '%')
            ->orWhere('order_number', 'LIKE', '%' . $searchKeyword . '%')
            ->paginate(10); // You can adjust the number (10) to control how many results per page

        $reminders = Reminder::where('status', true)->get();

        return view('admin.ordersearch', compact('orders', 'searchKeyword', 'reminders'));
    }

    public function Statushome(Request $request, $order_number)
    {
        // Find all orders with the same order number
        $orders = Order::where('order_number', $order_number)->get();

        foreach ($orders as $order) {
            // Check if the order status is already "success"
            if ($order->status !== 'success') {
                // Update the order status to "success"
                $order->status = 'success';
                $order->save();

                // Assuming the order has a relationship with the Product model
                $product = $order->product; // Adjust based on your actual relationship

                if ($product) {
                    // Reduce stock by the quantity ordered
                    if ($product->stock >= $order->quantity) {
                        $product->stock -= $order->quantity;
                    } else {
                        $product->stock = 0; // Prevent negative stock
                    }

                    // Increase the quantity sold
                    $product->quantity_sold += $order->quantity;
                    $product->save();
                }
            }
        }

        return redirect('/')->with('success', 'Order status updated to success, stock adjusted, and quantity sold updated.');
    }
}
