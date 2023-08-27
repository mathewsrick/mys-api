<?php

use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\OrdersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {    
    Route::post('logout', [AuthController::class, 'logout']);
    Route::resource('user', UserController::class)->only([
        'show', 'update' 
    ]);

    Route::resource('products', ProductController::class)->only(['index', 'show']);
    Route::resource('orders', OrdersController::class)->only(['index', 'store']);

    Route::get('user/{id}/addresses', [AddressController::class, 'index']);
    Route::post('user/{id}/addresses', [AddressController::class, 'store']);
    Route::put('user/{user_id}/addresses/{address_id}', [AddressController::class, 'update']);
    Route::delete('user/{user_id}/addresses/{address_id}', [AddressController::class, 'destroy']);
});
