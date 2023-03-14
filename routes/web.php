<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\SiteController::class, 'index'])->name('site.user.login');
Route::post('/user/login', [App\Http\Controllers\SiteController::class, 'processLogin'])->name('process.user.login');
Route::get('/user/register', [App\Http\Controllers\SiteController::class, 'userRegister'])->name('site.user.register');
Route::post('/user/register/process', [App\Http\Controllers\SiteController::class, 'processRegister'])->name('process.user.register');
Route::get('/user/dashboard', [App\Http\Controllers\SiteController::class, 'userDashboard'])->name('site.user.dashboard');

