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

	//export to cvs for room
	public function exportRoom(){

			$whereQuery = []; //creates array to fill with where queries/ if this array is empty it gets all bookings

			//for filtering
			if(\Request::has('room_number')){
				$room = \Request::input('room_number');
				array_push($whereQuery, ["bookings_rooms.room_number", $room]);
			}

			$dateFrom = \Request::input('dateFrom');
			$dateTo = \Request::input('dateTo');

			if(!($dateFrom || $dateTo) == ''){
				
				if(\Request::has('dateFrom') && \Request::has('dateTo')){
								
					$newFrom = new Carbon($dateFrom);
					$newTo = new Carbon($dateTo);

					//gets the room with the filter
					$filteredBookings = Bookings::join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')
					->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')
					->join('users', 'users.id', '=', 'bookings.user_id')
					->join('categories', 'categories.category', '=', 'bookings.category')
					->where($whereQuery)
					->whereBetween("bookings.from_date", [$newFrom, $newTo])
					->orWhereBetween("bookings.to_date", [$newFrom, $newTo])
					->select('rooms.room_number','bookings.from_date','bookings.to_date','users.name','categories.type','bookings.category')
					->get();
				
				}
			} else {
				//gets the room with the filter
				$filteredBookings = Bookings::join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')
				->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')
				->join('users', 'users.id', '=', 'bookings.user_id')
				->join('categories', 'categories.category', '=', 'bookings.category')
				->where($whereQuery)
				->select('rooms.room_number','bookings.from_date','bookings.to_date','users.name','categories.type','bookings.category')
				->get();
			}

		//creates csv file in memory
		$csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());

		//sets up headers
		$headers = ['Room','Start date','End date','User','Usage type','Usage'];
		$csv->insertOne($headers);

		//inserts rows/information
		foreach ($filteredBookings as $booking){
			$csv->insertOne($booking->toArray());
		}

		//downloads file for user with the filename u want
		$dateNow = new Carbon();
		$fileName = 'logRooms-'.$dateNow.'.csv';
		$csv->output($fileName);
	}

	public function logRooms()
	{
		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			
			$allRooms = Rooms::all(); //gets rooms for the filtering

			//how may to show per page
			$roomsPerPagination = 10;
			$whereQuery = []; //creates array to fill with where queries

			//for filtering
			if(\Request::has('room_number')){
				$room = \Request::input('room_number');
				array_push($whereQuery, ["bookings_rooms.room_number", $room]);
			}

			$dateFrom = \Request::input('dateFrom');
			$dateTo = \Request::input('dateTo');

			if(!($dateFrom || $dateTo) == ''){
				
				if(\Request::has('dateFrom') && \Request::has('dateTo')){
								
					$newFrom = new Carbon($dateFrom);
					$newTo = new Carbon($dateTo);

					//gets the room with the filter
					$filteredBookings = Bookings::join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')
					->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')
					->where($whereQuery)
					->whereBetween("bookings.from_date", [$newFrom, $newTo])
					->orWhereBetween("bookings.to_date", [$newFrom, $newTo])
					->paginate($roomsPerPagination);
				
				}
			} else {
				//gets the room with the filter
				$filteredBookings = Bookings::join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')
				->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')
				->where($whereQuery)
				->paginate($roomsPerPagination);
			}


			

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



			return view('log.rooms', compact('allRooms','topRoomThisMonth','topRoomsThisMonth', 'hoursTopRoom','filteredBookings'));
		} else {
			return redirect()->route('home');
		}
	}

	public function logEquipments()
	{
		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			
			$allRooms = Rooms::all(); //gets rooms for the filtering

			//how may to show per page
			$equipmentsPerPagination = 10;
			$whereQuery = []; //creates array to fill with where queries

			//for filtering

			if(\Request::has('room_number')){
				$room = \Request::input('room_number');
				array_push($whereQuery, ["equipments.location", $room]);
			}

			if(\Request::has('name')){
				$equipment = \Request::input('name'). '%';
				array_push($whereQuery, ["equipments.name", 'LIKE', $equipment]);
			}

			$dateFrom = \Request::input('dateFrom');
			$dateTo = \Request::input('dateTo');

			if(!($dateFrom || $dateTo) == ''){
				
				if(\Request::has('dateFrom') && \Request::has('dateTo')){
								
					$newFrom = new Carbon($dateFrom);
					$newTo = new Carbon($dateTo);

					//gets the room with the filter
					$filteredBookings = Bookings::
					join('bookings_equipments', 'bookings.id', '=', 'bookings_equipments.bookings_id')
					->join('equipments', 'bookings_equipments.equipment_id', '=', 'equipments.id')
					->where($whereQuery)
					->whereBetween("bookings.from_date", [$newFrom, $newTo])
					->orWhereBetween("bookings.to_date", [$newFrom, $newTo])
					->paginate($equipmentsPerPagination);
				
				}
			} else {
				//gets the room with the filter
				$filteredBookings = Bookings::
				join('bookings_equipments', 'bookings.id', '=', 'bookings_equipments.bookings_id')
				->join('equipments', 'bookings_equipments.equipment_id', '=', 'equipments.id')
				->where($whereQuery)
				->paginate($equipmentsPerPagination);
			}

			return view('log.equipments', compact('allRooms','filteredBookings'));
		} else {
			return redirect()->route('home');
		}
	}

	//export to cvs for room
	public function exportEquipment(){

			$whereQuery = []; //creates array to fill with where queries/ if this array is empty it gets all bookings

			//for filtering
			if(\Request::has('room_number')){
				$room = \Request::input('room_number');
				array_push($whereQuery, ["equipments.location", $room]);
			}

			if(\Request::has('name')){
				$equipment = \Request::input('name'). '%';
				array_push($whereQuery, ["equipments.name", 'LIKE', $equipment]);
			}

			$dateFrom = \Request::input('dateFrom');
			$dateTo = \Request::input('dateTo');

			if(!($dateFrom || $dateTo) == ''){
				
				if(\Request::has('dateFrom') && \Request::has('dateTo')){
								
					$newFrom = new Carbon($dateFrom);
					$newTo = new Carbon($dateTo);

					//gets the room with the filter
					$filteredBookings = Bookings::
					join('bookings_equipments', 'bookings.id', '=', 'bookings_equipments.bookings_id')
					->join('equipments', 'bookings_equipments.equipment_id', '=', 'equipments.id')
					->join('users', 'users.id', '=', 'bookings.user_id')
					->join('categories', 'categories.category', '=', 'bookings.category')
					->where($whereQuery)
					->whereBetween("bookings.from_date", [$newFrom, $newTo])
					->orWhereBetween("bookings.to_date", [$newFrom, $newTo])
					->select('equipments.name','equipments.type','bookings.from_date','bookings.to_date','users.name','categories.type','bookings.category')
					->get();
				
				}
			} else {
				//gets the room with the filter
				$filteredBookings = Bookings::
				join('bookings_equipments', 'bookings.id', '=', 'bookings_equipments.bookings_id')
				->join('equipments', 'bookings_equipments.equipment_id', '=', 'equipments.id')
				->join('users', 'users.id', '=', 'bookings.user_id')
				->join('categories', 'categories.category', '=', 'bookings.category')
				->select('equipments.name','equipments.type','equipments.location','bookings.from_date','bookings.to_date','users.name','categories.type','bookings.category')
				->where($whereQuery)
				->get();
			}

		//creates csv file in memory
		$csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());

		//sets up headers
		$headers = ['Name','Type','Location','Start date','End date','User','Usage type','Usage'];
		$csv->insertOne($headers);

		//inserts rows/information
		foreach ($filteredBookings as $booking){
			$csv->insertOne($booking->toArray());
		}

		//downloads file for user with the filename u want
		$dateNow = new Carbon();
		$fileName = 'logEquipments-'.$dateNow.'.csv';
		$csv->output($fileName);
	}

		public function logUsers(){
		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			
			$allRoles = Roles::all(); //gets roles for the filtering

			//how may to show per page
			$equipmentsPerPagination = 10;
			$whereQuery = []; //creates array to fill with where queries

			//for filtering

			if(\Request::has('email')){
				$email = \Request::input('email') . '%';
				array_push($whereQuery, ["users.email", 'LIKE', $email]);
			}

			if(\Request::has('name')){
				$name = \Request::input('name'). '%';
				array_push($whereQuery, ["users.name", 'LIKE', $name]);
			}

			if(\Request::has('role')){
				$role = \Request::input('role');
				array_push($whereQuery, ["users.role", $role]);
			}

			$dateFrom = \Request::input('dateFrom');
			$dateTo = \Request::input('dateTo');

			if(!($dateFrom || $dateTo) == ''){
				
				if(\Request::has('dateFrom') && \Request::has('dateTo')){
								
					$newFrom = new Carbon($dateFrom);
					$newTo = new Carbon($dateTo);

					//gets the room with the filter
					$filteredBookings = Bookings::
					join('users', 'users.id', '=', 'bookings.user_id')
					->select('users.email','users.role', 'bookings.type as bType','bookings.from_date','bookings.to_date')
					->where($whereQuery)
					->whereBetween("bookings.from_date", [$newFrom, $newTo])
					->orWhereBetween("bookings.to_date", [$newFrom, $newTo])
					->paginate($equipmentsPerPagination);
				
				}
			} else {
				//gets the room with the filter
				$filteredBookings = Bookings::
				join('users', 'users.id', '=', 'bookings.user_id')
				->select('users.email','users.role', 'bookings.type as bType','bookings.from_date','bookings.to_date')
				->where($whereQuery)
				->paginate($equipmentsPerPagination);
			}

			return view('log.users', compact('allRoles','filteredBookings'));
		} else {
			return redirect()->route('home');
		}
	}


}