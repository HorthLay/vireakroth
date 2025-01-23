<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Cart;
use App\Models\Category;
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
            return view('admin.index', compact('users', 'currentVisits', 'percentageChange', 'previousVisits', 'reminders'));
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

        $newProducts = Product::where('status', 'new')->take(4)->get();
        $secondHandProducts = Product::where('status', 'second_hand')->take(4)->get();
        $products = Product::all();
        $ads = Ad::all();
        $cart = Cart::all();
        return view('home.index', compact('newProducts', 'products', 'ads', 'cart', 'secondHandProducts', 'categories'));
    }
}
