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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => [
    'auth:sanctum',
    'verified'
]], function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/missions', function () {
        return view('missions');
    })->name('missions');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');
});

Route::prefix('socialite')->group(function () {
    Route::prefix('steam')->group(function () {
        Route::get('/login', 'App\Http\Controllers\SocialiteAuthenticationController@redirectToSteamLogin')->name('socialite-steam-login');
        Route::get('/login-attempt', 'App\Http\Controllers\SocialiteAuthenticationController@steamLoginAttempt')->name('socialite-steam-login-attempt');
    });

    Route::prefix('discord')->group(function () {
        Route::get('/login', 'App\Http\Controllers\SocialiteAuthenticationController@redirectToDiscordLogin')->name('socialite-discord-login');
        Route::get('/login-attempt', 'App\Http\Controllers\SocialiteAuthenticationController@discordLoginAttempt')->name('socialite-discord-login-attempt');
    });
});
