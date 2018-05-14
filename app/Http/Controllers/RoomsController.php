<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rooms;
use App\Bookings;

use Carbon\Carbon;

class RoomsController extends Controller
{
	/**
	 * Fetches all categories and items which are open from the database.
	 * @return callable Returns the home.index view along with the categories
	 * and items.
	 */
	public function index()
	{
		$allRooms = Rooms::all();
		return view('rooms.index', compact('allRooms'));
	}

	public function indexAdmin(){
		$allRooms = Rooms::all();
		return view('rooms.admin', compact('allRooms'));
	}

	//function for showing spesific room
	public function showRoom($room_number)
	{
		$paginationNumber = 10;
		$room = Rooms::where('room_number',$room_number)->first();

		$dateNow = new Carbon();

		$bookingsOnThisRoom = Bookings::
		join('bookings_rooms','bookings_rooms.bookings_id','=','bookings.id')
		->join('rooms','rooms.room_number','=','bookings_rooms.room_number')
		->where('rooms.room_number',$room_number)
		->where('bookings.from_date','>=', $dateNow)
		->paginate($paginationNumber);

		return view('rooms.show', compact('room','bookingsOnThisRoom'));
	}

	public function newRoom(){
		return view('rooms.create');
	}

	public function createRoom(){
		$this->validate(request(), [
			'room_number' => 'required|min:4|max:30',
			'building' => 'required|min:1|max:1',
			'type' => 'required',
		]);

		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			$room = new Rooms();
			$room->createRoom(request());

			//Flashes the session with a value for notify user
			//Flash only lasts for 1 redriect
			session()->flash('notifyUser', 'Room created!');
			return redirect()->route('roomsAdmin');
		} else {
			echo 'You are not administrator!';
		}
	}

	public function showEdit($room){
		$roomNumber = $room;
		$thisRoom = Rooms::where('room_number', $roomNumber)->get();
		return view('rooms.edit', compact('thisRoom'));
	}

	public function editRoom(){
		$this->validate(request(), [
			'room_number' => 'required|min:4|max:30',
			'building' => 'required|min:1|max:1',
			'type' => 'required',
		]);

		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			$room = new Rooms();
			$room->updateRoom(request());

			//Flashes the session with a value for notify user
			//Flash only lasts for 1 redriect
			session()->flash('notifyUser', 'Room updated!');
			return redirect()->route('roomsAdmin');
		} else {
			session()->flash('notifyUser', 'You are not administrator!');
		}
	}

	public function delete($room){
		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			Rooms::where('room_number', $room)->delete();

			//flashes the session with a value for notify user
			//flash only lasts for 1 redriect
			session()->flash('notifyUser', 'Room deleted!');
			return redirect()->route('roomsAdmin');
		}else{
			session()->flash('notifyUser', 'You are not administrator!');
		}

	}
	
}