<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/google-login', 'Auth\LoginController@loginWithGoogle');
Route::get('/google-callback', 'Auth\LoginController@handleGoogleCallback');

Route::any('profile-setup','ProfileController@completeProfile')->name('profile-setup')->middleware('auth');

Route::middleware(['check-profile'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

});