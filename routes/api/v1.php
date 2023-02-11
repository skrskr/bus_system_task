<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\BookingController;
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

Route::group(['prefix' => "v1"], function () {
    Route::post("login", [AuthController::class, 'login']);
    
    Route::group(['middleware' => 'auth:sanctum'], function () {
        // booking routes
        Route::get("booking", [BookingController::class, 'index']);
        Route::post("booking", [BookingController::class, 'store']);
    });
});