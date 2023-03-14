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
//Route::post('register', 'RegisterController@register');
Route::post("user/register", [App\Http\Controllers\RegisterController::class, "register"])->name("user.register");
Route::post("user/login", [App\Http\Controllers\LoginController::class, "login"])->name("user.login");
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
