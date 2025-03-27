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
}
