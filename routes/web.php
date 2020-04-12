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

//Repasar la documentación del routing!!
//'p' for posts

Route::get('/p/create', 'PostController@create');

Route::get('/p/{post}', 'PostController@show');

//
Route::post('/p', 'PostController@store');

//
// Select all profiles
Route::get('/profiles', 'ProfilesController@profiles');

// Single profile
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

// Single profile from all profiles

