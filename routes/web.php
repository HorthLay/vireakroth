<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
Route::get('/', [HomeController::class, 'home'])->middleware('redirectToHome');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');


Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

// order
Route::get('/ordersView', [OrderController::class, 'index'])->name('orders.index');
Route::get('/order', [OrderController::class, 'showOrderPage'])->name('order.page')->middleware('auth');
Route::post('/order/submit', [OrderController::class, 'store'])->name('order.submit');
Route::get('/order/detail/{order_number}', [CartController::class, 'show'])->name('order.show');
Route::delete('/cart/{id}', [OrderController::class, 'destroy'])->name('cart.delete');



Route::get('/category/{name}', [ProductController::class, 'showByCategory'])->name('category.show');
Route::get('/shop', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/add/details', [CartController::class, 'CartAddDetail'])->name('cart.details');
Route::get('/cart', [CartController::class, 'viewcart'])->name('cart.view');

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/user', [AdminController::class, 'userview'])->name('users.index');
    Route::get('/user_delete/{id}', [AdminController::class, 'deleteUser'])->name('user.delete');
    Route::post('/reminders', [AdminController::class, 'store'])->name('reminders.store');
    Route::get('/category', [AdminController::class, 'category'])->name('category');
    Route::post('/addcategory', [AdminController::class, 'categoryadd'])->name('categories.store');
    Route::get('/category_delete/{id}', [AdminController::class, 'categorydelete'])->name('category.delete');
    Route::put('/category_update/{id}', [AdminController::class, 'update'])->name('categories.update');
    Route::get('/product', [ProductController::class, 'product'])->name('product');
    Route::post('/product_store', [AdminController::class, 'prosuctstore'])->name('products.store');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/product_delete/{id}', [ProductController::class, 'productdelete'])->name('category.delete');
    Route::post('/addads', [AdminController::class, 'adsadd'])->name('ads.store');
});



Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('auth');
Route::post('/register', [RegisterController::class, 'register'])->middleware('auth');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('auth');
Route::post('/login', [LoginController::class, 'login'])->middleware('auth');


Route::get('/adsy', [AdminController::class, 'ads'])->name('ads');


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
// Forgot Password
Route::get('/forgot-password', [ForgetPasswordManager::class, 'forgotPassword'])->name('forget.password');
Route::post('/forgot-password', [ForgetPasswordManager::class, 'forgotPasswordPost'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgetPasswordManager::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [ForgetPasswordManager::class, 'resetPasswordPost'])->name('reset.password.post');
Auth::routes(['verify' => true]);


////google auuth


Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleController::class, 'callback']);


// order
Route::get('/ordersView', [OrderController::class, 'OrderView'])->name('orders.index')->middleware('auth');
Route::get('/order/{order_number}', [OrderController::class, 'showOrderByNumber'])->name('order.number');
Route::get('/order_cancel/{order_number}', [OrderController::class, 'callordernumber'])->name('order.cancel');
Route::post('/order/checkout/{order_number}', [OrderController::class, 'checkout'])->name('order.checkout');

Route::get('order/checkout/{order_number}', [OrderController::class, 'checkoutpage'])->name('order.checkoutpage');
// checkout
Route::post('/update-order-status', [OrderController::class, 'updateStatus'])->name('updateOrderStatus');
Route::get('/success/{order_number}', [OrderController::class, 'success'])->name('order.success');
