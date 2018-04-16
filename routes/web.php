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

// Sends you to home
Route::get('/', 'HomeController@index')->middleware('auth');
Route::get('home', 'HomeController@index')->name('home')->middleware('auth');


//Create a booking
Route::post('booking/create', 'BookingsController@create')->middleware('auth');

// Rooms
Route::get('rooms', 'RoomsController@index')->name('rooms')->middleware('auth');

// Equipments
Route::get('equipments', 'EquipmentsController@index')->name('equipments')->middleware('auth');

// Routes to profile
Route::get('/profile', 'ProfileController@index')->name('profile')->middleware('auth');

// Profile - Update user info
Route::post('/profile/settings/update/username/{user}', 'ProfileController@updateUsername')->middleware('auth');
Route::post('/profile/settings/update/password/{user}', 'ProfileController@updatePassword')->middleware('auth');

// Routes to admin
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');

// Admin views
Route::get('admin/rooms', 'RoomsController@indexAdmin')->name('roomsAdmin')->middleware('auth');
Route::get('admin/equipments', 'EquipmentsController@indexAdmin')->name('equipmentsAdmin')->middleware('auth');
Route::get('admin/users', 'UsersController@index')->name('users')->middleware('auth');
Route::get('admin/bookings', 'BookingsController@index')->name('bookings')->middleware('auth');
Route::get('admin/logg', 'AdminController@indexLoggAdmin')->name('logg')->middleware('auth');
Route::get('admin/categories', 'CategoriesController@index')->name('categories')->middleware('auth');

// Admin - approve/edit/delete user
Route::post('/admin/approve/user/{user}', 'AdminController@approveUser')->middleware('auth');
Route::post('/admin/edit/user/{user}', 'AdminController@editUser')->middleware('auth');
Route::delete('admin/delete/user/{user}', 'AdminController@deleteUser')->middleware('auth');
Route::get('admin/users/edit/{user}', 'AdminController@showEditUser');

//Admin - Create/edit rooms
Route::get('admin/rooms/newRoom', 'RoomsController@newRoom')->name('newRoom')->middleware('auth');
Route::post('admin/rooms/create', 'RoomsController@createRoom')->middleware('auth');
Route::get('admin/rooms/edit/{room_number}', 'RoomsController@showEdit')->middleware('auth');
Route::post('admin/rooms/edit', 'RoomsController@editRoom')->middleware('auth');

//Admin - Create/edit equipments
Route::get('admin/equipments/newEquipment', 'EquipmentsController@newEquipment')->name('newEquipment')->middleware('auth');
Route::post('admin/equipments/create', 'EquipmentsController@createEquipment')->middleware('auth');
Route::get('admin/equipments/edit/{id}', 'EquipmentsController@showEdit')->middleware('auth');
Route::post('admin/equipments/edit/{id}', 'EquipmentsController@editEquipment')->middleware('auth');

// Email Verification
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

//Booking room selected
Route::get('home/{room}', 'BookingsController@roomSelected')->middleware('auth');
//Booking usage selected
Route::get('home/useage/{useage}', 'BookingsController@useageSelected')->middleware('auth');
//bookings dates selected
Route::get('home/{room}/{dateFrom}/{timeFrom}/{dateTo}/{timeTo}', 'BookingsController@findBookedRooms')->middleware('auth');

//admin accept/delete booking
Route::get('admin/bookings/accept/{booking}', 'BookingsController@accept')->middleware('auth');
Route::get('admin/bookings/delete/{booking}', 'BookingsController@delete')->middleware('auth');

//route to bookings overview for admin
Route::get('admin/bookings', 'BookingsController@indexAdmin')->name('bookingsAdmin')->middleware('auth');