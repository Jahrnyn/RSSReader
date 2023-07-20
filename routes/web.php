<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\RssController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class, 'showCorrectHomePage']);

// UserController
Route::get('/register', [Home::class, 'registrationpage']);
Route::post('/registration', [UserController::class, 'registration']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// RssController
Route::middleware('auth')->post('/rsssubscription', [RssController::class, 'createSubscription']);
Route::get('/fetch-rss-data', [RssController::class, 'fetchRssData']);
