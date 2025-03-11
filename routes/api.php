<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\GoogleLogin;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KHQRController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);
Route::get('/get-password-reset-token', [ForgotPasswordController::class, 'getPasswordResetToken']);
Route::put('/update-password', [ForgotPasswordController::class, 'updatePassword']);

Route::put('/update-cart/{id}', [CartController::class, 'update']);

Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/check-token', function (Request $request) {
    return response()->json(['valid' => true]); // Return a success response if token is valid
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'getCart']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart']);
});
