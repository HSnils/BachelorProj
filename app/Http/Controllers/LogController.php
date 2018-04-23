<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Rooms;
use App\Equipments;
use App\Categories;
use App\Bookings;
use App\bookings_room;
use App\bookings_equipments;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
	public function index() {
		$isAdmin = auth()->user()->role == 'Admin';

		if($isAdmin){
			
			$allUsers = User::All();
			$allRooms = Rooms::All();
			$allBookings = Bookings::All();
			$allEquipments = Equipments::All();
			$allCategories = Categories::All();
			
			$bookedRooms = Rooms::join('bookings_rooms', 'rooms.room_number', '=', 'bookings_rooms.room_number')->where('rooms.room_number', '=', 'bookings_rooms.room_number')->get();
			
			return view('logg.index', compact('allUsers', 'allRooms', 'allBookings', 'allEquipments', 'allCategories', 'bookedRooms'));
			
		}
		
	}

}