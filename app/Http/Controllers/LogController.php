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

use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
	public function index() {
		$isAdmin = auth()->user()->role == 'Admin';

		if($isAdmin){
			$dateNow = new Carbon();
			$pastMonth = new Carbon();
			$pastMonth->subMonth();


			$allUsers = User::All();
			$allRooms = Rooms::All();
			$allBookings = Bookings::All();
			$allEquipments = Equipments::All();
			$allCategories = Categories::All();

			//top 4 rooms this month
			$topRoomsThisMonth = Bookings::
			join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')
			->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')
				->whereBetween('bookings.from_date', [$pastMonth, $dateNow])
				->orWhereBetween('bookings.to_date', [$pastMonth, $dateNow])
			->select('bookings_rooms.room_number')->selectRaw('COUNT(*) AS count')->groupBy('bookings_rooms.room_number')->orderByDesc('count')->limit(6)->get();

			//category usage in the past month
			$categoryThisMonth = Bookings::
			join('categories', 'bookings.category', '=', 'categories.category')
				->whereBetween('bookings.from_date', [$pastMonth, $dateNow])
				->orWhereBetween('bookings.to_date', [$pastMonth, $dateNow])
			->select('categories.type')->selectRaw('COUNT(*) AS count')->groupBy('categories.type')->orderByDesc('count')->get();

			//gets all the count and role of all bookings in the past month
			$bookingsFromRolesThisMonth = Bookings::
			join('users', 'bookings.user_id', '=', 'users.id')
				->whereBetween('bookings.from_date', [$pastMonth, $dateNow])
				->orWhereBetween('bookings.to_date', [$pastMonth, $dateNow])
			->select('users.role')->selectRaw('COUNT(*) AS count')->groupBy('users.role')->orderByDesc('count')->get();
			
			/*
			feil bruk av where :)
			$bookedRooms = Rooms::join('bookings_rooms', 'rooms.room_number', '=', 'bookings_rooms.room_number')->where('rooms.room_number', '=', 'bookings_rooms.room_number')->get();*/
			
			return view('log.index', compact('topRoomsThisMonth', 'categoryThisMonth','bookingsFromRolesThisMonth'));
			
		}
		
	}

	public function logRooms()
	{
		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			
			//top 4 rooms all time
			$topFourRooms = Rooms::join('bookings_rooms', 'rooms.room_number', '=', 'bookings_rooms.room_number')->select('bookings_rooms.room_number')->selectRaw('COUNT(*) AS count')->groupBy('room_number')->orderByDesc('count')->limit(4)->get();


			//top 4 rooms this month

			$dateNow = new Carbon();
			$pastMonth = new Carbon();
			$pastMonth->subMonth();

			//gets top rooms this month
			$topRoomsThisMonth = Bookings::
			join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')
			->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')
				->whereBetween('bookings.from_date', [$pastMonth, $dateNow])
				->orWhereBetween('bookings.to_date', [$pastMonth, $dateNow])
			->select('bookings_rooms.room_number')->selectRaw('COUNT(*) AS count')->groupBy('room_number')->orderByDesc('count')->limit(3)->get();

			//gets top room this month
			$topRoomThisMonth = Bookings::
			join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')
			->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')
				->whereBetween('bookings.from_date', [$pastMonth, $dateNow])
				->orWhereBetween('bookings.to_date', [$pastMonth, $dateNow])
			->select('bookings_rooms.room_number')->selectRaw('COUNT(*) AS count')->groupBy('room_number')->orderByDesc('count')->limit(1)->get();

			//gets all the dates of the top room this month to be used to calculate how many hours its been used
			$topRoomThisMonthDates = Bookings::
			join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')
			->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')
			->where('bookings_rooms.room_number','=', $topRoomThisMonth[0]->room_number)
			->select('bookings.from_date', 'bookings.to_date')->get();

			//calculates the hours the room has been used
			$hoursTopRoom = 0;
			foreach ($topRoomThisMonthDates as $date) {
				//creates dates
				$startDate = new Carbon($date->from_date);
				$endDate = new Carbon ($date->to_date);

				//uses carbon function to find the differnece in hours
				$hoursTopRoom += $endDate->diffInHours($startDate);
			}

			return view('log.rooms', compact('topRoomThisMonth','topRoomsThisMonth', 'hoursTopRoom'));
		} else {
			return redirect()->route('home');
		}
	}

}