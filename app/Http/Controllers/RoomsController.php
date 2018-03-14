<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rooms;

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
	
}