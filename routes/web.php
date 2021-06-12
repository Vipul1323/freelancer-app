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

    Route::middleware(['role:Client'])->group(function () {
        Route::any('project/new','ProjectsController@newProject')->name('project.new')->middleware('auth');
    });
    Route::get('projects','ProjectsController@index')->name('ProjectsController')->middleware('auth');
    Route::get('project/mark-completed/{project_id}','ProjectsController@markCompleted')->name('mark-completed');
    Route::any('project/{project_id}','ProjectsController@viewProject')->name('project.view')->middleware('auth');

    Route::post('add-note','ProjectsController@addNote')->name('add-note')->middleware('auth');
});