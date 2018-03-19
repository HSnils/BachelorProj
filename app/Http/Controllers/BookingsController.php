<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookings;
use App\Rooms;
use App\Equipments;
use App\User;
use App\bookings_room;
use Auth;

class BookingsController extends Controller
{
	public function create(Request $request){
		$this->validate(request(), [
			'room_number' => 'required',
			'dateFrom' => 'required',
			'timeFrom' => 'required',
			'dateTo' => 'required',
			'timeTo' => 'required',
		]);

		$roomNumber = $request->input('room_number') ;
		$dateFrom = $request->input('dateFrom') . ' ' . $request->input('timeFrom').":00";
		$dateTo = $request->input('dateTo') . ' ' . $request->input('timeTo').":00";

		$checkAvalibility = Bookings::join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')->where('from_date', '<=', $dateTo)->where('to_date','>=', $dateFrom)->where('rooms.room_number', '=', $roomNumber)->count();

		$user = Auth::user()->id;
		$userRole = Auth::user()->role;
		$status;
		
		if($userRole == 'Student'){
			$status = 'Pending';
		} else {
			$status = 'Active';
		}

		//if checkAvalibility == 0 there is no other bookings
		if($checkAvalibility == 0){

			Bookings::create([
				'type' => 'Room',
				'category' => 'Noe',
				'from_date' => $dateFrom,
				'to_date' => $dateTo,
				'status' => $status,
				'user_id' => $user
			]);

			$thisBooking = Bookings::orderBy('created_at','DESC')->first();
			$bookingId = $thisBooking->id;
			//create
			bookings_room::create([
				'bookings_id' => $bookingId,
				'room_number' => $roomNumber,
			]);

		} else {
			//error
		}

		return view('home.test', compact('checkAvalibility'));


	}
}
