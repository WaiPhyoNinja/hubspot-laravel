<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HubSpotLoginController;

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

Route::get('/hubspot/login', [HubSpotLoginController::class, 'redirectToHubSpot'])->name('hubspot.login');
Route::get('/hubspot/callback', [HubSpotLoginController::class, 'handleHubSpotCallback']);


//DISPLAY HUBSPOT USERS
Route::get('/users', [UserController::class, 'displayUser'])->name('display.user');
//HUBSPOT USERS
Route::get('/hubspot-user', [UserController::class, 'userList'])->name('hubspot.user');
//SIGNUP NEWS LETTER To CREATE USER
Route::get('/signup-news', [UserController::class, 'signupUser'])->name('signup.user');
//Store User
Route::post('store-contact', [UserController::class, 'storeContact'])->name('store.user');

