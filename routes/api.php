<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\EmployeeController;

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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->get('/user', [RegisterController::class, 'getUser']);
Route::middleware('auth:api')->get('/get_user_profile', [RegisterController::class, 'get_user_profile']);

Route::middleware('auth:api')->group( function () {
    Route::resource('products', ProductController::class);
    Route::resource('employees', EmployeeController::class);
});
