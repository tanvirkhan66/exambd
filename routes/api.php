<?php

use Illuminate\Http\Request;
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
//user_login
Route::post('/user-login', [App\Http\Controllers\HomeController::class, 'user_login']);
Route::post('/user-register', [App\Http\Controllers\HomeController::class, 'user_register']);


Route::middleware('auth:sanctum')->group(function() {
    Route::get('/get-users', [App\Http\Controllers\HomeController::class, 'get_users']);
    Route::get('/delete-user/{id?}', [App\Http\Controllers\HomeController::class, 'delete']);
    Route::get('/send-mail', [App\Http\Controllers\HomeController::class, 'send_mail']);
});
