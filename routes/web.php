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

Auth::routes();

//Sends you to home
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index')->name('home');

// Rooms
Route::get('rooms', 'RoomsController@index')->name('rooms');

// Equipments
Route::get('equipments', 'EquipmentsController@index')->name('equipments');

// Routes to profile
Route::get('/profile', 'ProfileController@index')->name('profile');

// Profile - Update user info
Route::post('/profile/settings/update/username/{user}', 'ProfileController@updateUsername');
Route::post('/profile/settings/update/password/{user}', 'ProfileController@updatePassword');

//Routes to admin
Route::get('/admin', 'AdminController@index')->name('admin');

/*Route::get('/', function () {
    return view('welcome');
});*/
