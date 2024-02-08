<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HubSpotLoginController;
use App\Http\Controllers\HubSpotAuthController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/hubspot/auth', [HubSpotAuthController::class, 'redirectToHubSpot'])->name('auth.login');
Route::get('/hubspot/callback', [HubSpotAuthController::class, 'handleCallback']);

Route::get('/signup-news', [UserController::class, 'signupUser'])->name('signup.user')->middleware('customRedirect');
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('customRedirect');
Route::post('/store', [LoginController::class, 'store'])->name('login.store')->middleware('customRedirect');

Route::middleware('checkLogin')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    //DISPLAY HUBSPOT USERS
    Route::get('/users', [UserController::class, 'displayUser'])->name('display.user');
    Route::get('/products', [UserController::class, 'productLists'])->name('display.products');
    //HUBSPOT USERS
    Route::get('/hubspot-user', [UserController::class, 'userList'])->name('hubspot.user');
    //Store User
    Route::post('store-contact', [UserController::class, 'storeContact'])->name('store.user');
});
