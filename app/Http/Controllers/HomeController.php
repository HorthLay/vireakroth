<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reminder;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->user_type === 'admin') {
            $users = User::latest()->take(5)->get();
            $reminders = Reminder::where('status', true)->get();
            $currentVisits = Visitor::count();
            // Get the previous number of visits (you can set this to a static value for testing)
            $previousVisits = 25000;  // Example static value (or you can store the previous value in the DB)
            // Calculate the percentage change
            $percentageChange = $previousVisits ? round((($currentVisits - $previousVisits) / $previousVisits) * 100) : 0;
            \App\Models\Order::where('viewed', false)->update(['viewed' => true]);
            $totalOrderSales = Order::sum('total_price');
            // Fetch orders
            $totalOrders = Order::count();
            $orders = \App\Models\Order::latest()->get();
            $recentorders = Order::latest()->take(3)->get();

            return view('admin.index', compact('users', 'totalOrders', 'totalOrderSales', 'currentVisits', 'percentageChange', 'previousVisits', 'reminders', 'orders', 'recentorders'));
        } else {
            $user = User::all();
            $newProducts = Product::where('status', 'new')->take(4)->get();
            $secondHandProducts = Product::where('status', 'second_hand')->take(4)->get();
            $categories = Category::all()->take(5);
            $products = Product::all();
            $ads = Ad::all();
            $cart = Cart::all();
            return view('home.index', compact('user', 'newProducts', 'products', 'cart', 'ads', 'secondHandProducts', 'categories'));
        }
    }

    public function home()
    {
        $categories = Category::all()->take(5);

        $newProducts = Product::where('status', 'new')->take(8)->get();
        $secondHandProducts = Product::where('status', 'second_hand')->take(8)->get();
        $products = Product::all();
        $ads = Ad::all();
        $cart = Cart::all();
        return view('home.index', compact('newProducts', 'products', 'ads', 'cart', 'secondHandProducts', 'categories'));
    }




    public function checkTransaction(Request $request)
    {
        try {
            $payload = json_encode($request->all());

            $ch = curl_init();

            curl_setopt_array($ch, [
                CURLOPT_URL => "https://api-bakong.nbc.gov.kh/v1/check_transaction_by_md5",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                    "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7ImlkIjoiMzYyZTU0Y2RmNDk2NDUzNSJ9LCJpYXQiOjE3NTQ5OTAxMTUsImV4cCI6MTc2Mjc2NjExNX0.GJlWmtw-TY3JJR2Ve25RdC1Msiy1wBWBvJvGfCk9F38",
                    "Content-Length: " . strlen($payload)
                ],
                CURLOPT_SSL_VERIFYPEER => false, // disable SSL verification if needed
                CURLOPT_TIMEOUT => 30
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if (curl_errno($ch)) {
                throw new \Exception(curl_error($ch));
            }

            curl_close($ch);

            // Decode response so we can check status
            $decodedResponse = json_decode($response, true);

            if (isset($decodedResponse['responseMessage']) && $decodedResponse['responseMessage'] === 'Success') {
                // Update order status in database
                if ($request->has('order_number')) {
                    \App\Models\Order::where('order_number', $request->order_number)
                        ->update(['status' => 'success']);
                }
            }

            return response()->json($decodedResponse, $httpCode);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to check transaction',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
