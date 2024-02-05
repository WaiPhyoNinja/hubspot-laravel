<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HubSpotLoginController;
use App\Http\Controllers\HubSpotAuthController;

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



//DISPLAY HUBSPOT USERS
Route::get('/users', [UserController::class, 'displayUser'])->name('display.user');
Route::get('/products', [UserController::class, 'productLists'])->name('display.products');
//HUBSPOT USERS
Route::get('/hubspot-user', [UserController::class, 'userList'])->name('hubspot.user');
//SIGNUP NEWS LETTER To CREATE USER
Route::get('/signup-news', [UserController::class, 'signupUser'])->name('signup.user');
//Store User
Route::post('store-contact', [UserController::class, 'storeContact'])->name('store.user');

