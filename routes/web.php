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
Route::get('/', 'HomeController@index')->middleware('auth');
Route::get('home', 'HomeController@index')->name('home')->middleware('auth');

// Rooms
Route::get('rooms', 'RoomsController@index')->name('rooms')->middleware('auth');

// Equipments
Route::get('equipments', 'EquipmentsController@index')->name('equipments')->middleware('auth');

// Routes to profile
Route::get('/profile', 'ProfileController@index')->name('profile')->middleware('auth');

// Profile - Update user info
Route::post('/profile/settings/update/username/{user}', 'ProfileController@updateUsername')->middleware('auth');
Route::post('/profile/settings/update/password/{user}', 'ProfileController@updatePassword')->middleware('auth');

//Routes to admin
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');

//Admin views
Route::get('admin/rooms', 'RoomsController@indexAdmin')->name('roomsAdmin')->middleware('auth');
Route::get('admin/equipments', 'EquipmentsController@indexAdmin')->name('equipmentsAdmin')->middleware('auth');
Route::get('admin/users', 'UsersController@index')->name('users')->middleware('auth');
Route::get('admin/logg', 'AdminController@indexLoggAdmin')->name('logg')->middleware('auth');

//Admin - approve user
Route::post('/admin/approve/user/{user}', 'AdminController@approveUser')->middleware('auth');

Route::post('/admin/edit/user/{user}', 'AdminController@editUser')->middleware('auth');

//Admin - delete user
Route::delete('admin/delete/user/{user}', 'AdminController@deleteUser')->middleware('auth');