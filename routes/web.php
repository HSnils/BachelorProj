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

// Routes to different views home/rooms/equipments and profile
Route::get('/', 'HomeController@index')->middleware('auth');
Route::get('home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('rooms', 'RoomsController@index')->name('rooms')->middleware('auth');
Route::get('rooms/{room_number}', 'RoomsController@showRoom')->middleware('auth');
Route::get('equipments', 'EquipmentsController@index')->name('equipments')->middleware('auth');
Route::get('equipments/{id}', 'EquipmentsController@showEquipment')->middleware('auth');
Route::get('/profile', 'ProfileController@index')->name('profile')->middleware('auth');

// Email Verification
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

// Profile - Update user info
Route::post('/profile/settings/update/username/{user}', 'ProfileController@updateUsername')->middleware('auth');
Route::post('/profile/settings/update/password/{user}', 'ProfileController@updatePassword')->middleware('auth');

//Create a booking
Route::post('booking/create', 'BookingsController@create')->middleware('auth');
//Booking room selected
Route::get('home/{room}', 'BookingsController@roomSelected')->middleware('auth');
//Booking usage selected
Route::get('home/useage/{useage}', 'BookingsController@useageSelected')->middleware('auth');
//Bookings dates selected
Route::get('home/findAvalible/{roomSelected}/{dateFrom}/{timeFrom}/{dateTo}/{timeTo}', 'BookingsController@findBookedRooms')->middleware('auth');
//user delete own booking
Route::get('bookings/delete/{booking}', 'BookingsController@userDelete')->middleware('auth');


//---- ADMIN STUFF ----//
// Routes to Admin views
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');
Route::get('admin/rooms', 'RoomsController@indexAdmin')->name('roomsAdmin')->middleware('auth');
Route::get('admin/equipments', 'EquipmentsController@indexAdmin')->name('equipmentsAdmin')->middleware('auth');
Route::get('admin/users', 'UsersController@index')->name('users')->middleware('auth');
Route::get('admin/bookings', 'BookingsController@indexAdmin')->name('bookingsAdmin')->middleware('auth');
Route::get('admin/categories', 'CategoriesController@index')->name('categories')->middleware('auth');
Route::get('admin/log', 'LogController@index')->name('log')->middleware('auth');

// Routes to log views
Route::get('admin/log/rooms', 'LogController@logRooms')->name('logRooms')->middleware('auth');
Route::get('admin/log/equipments', 'LogController@logEquipments')->name('logEquipments')->middleware('auth');
Route::get('admin/log/users', 'LogController@logUsers')->name('logUsers')->middleware('auth');
Route::get('admin/log/categories', 'LogController@logCategories')->name('logCategories')->middleware('auth');

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

// Admin - See/Create/Edit Categories
Route::get('categories/newCategory', 'CategoriesController@newCategory')->name('newCategory')->middleware('auth');
Route::post('categories/create', 'CategoriesController@createCategory')->middleware('auth');
Route::get('categories/edit/{category}', 'CategoriesController@showEdit')->middleware('auth');
Route::post('categories/edit/{category}', 'CategoriesController@editCategory')->middleware('auth');

//Admin accept/delete booking
Route::get('admin/bookings/accept/{booking}', 'BookingsController@accept')->middleware('auth');
Route::get('admin/bookings/delete/{booking}', 'BookingsController@delete')->middleware('auth');

//Log Download to cvs
Route::get('admin/log/rooms/download', 'LogController@exportRoom')->middleware('auth');
Route::get('admin/log/equipments/download', 'LogController@exportEquipment')->middleware('auth');
Route::get('admin/log/users/download', 'LogController@exportUsers')->middleware('auth');
Route::get('admin/log/categories/download', 'LogController@exportCategories')->middleware('auth');

