<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookings;
use App\Rooms;
use App\Equipments;
use App\User;
use App\bookings_room;
use App\bookings_equipment;
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
		$equipment1 = $request->input('equipment_1');

		//need to fix query add between stuff
		$checkAvalibility = Bookings::join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')->where('from_date', '<=', $dateTo)->where('to_date','>=', $dateFrom)->where('rooms.room_number', '=', $roomNumber)->count();

		//need to fix query add between stuff
		$checkAvalibilityEquipment = Bookings::join('bookings_equipments', 'bookings.id', '=', 'bookings_equipments.bookings_id')->join('equipments', 'bookings_equipments.equipment_id', '=', 'equipments.id')->where('from_date', '<=', $dateTo)->where('to_date','>=', $dateFrom)->where('equipments.id', $equipment1)->count();

		$user = Auth::user()->id;
		$userRole = Auth::user()->role;
		$status;
		
		if($userRole == 'Student'){
			$status = 'Pending';
		} else {
			$status = 'Active';
		}

		//if checkAvalibility == 0 there is no other bookings
		if(!$request->has('equipment_1')){
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
		} else if ($checkAvalibility == 0 &&  $checkAvalibilityEquipment == 0){
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

			Bookings::create([
				'type' => 'Equipment',
				'category' => 'Noe',
				'from_date' => $dateFrom,
				'to_date' => $dateTo,
				'status' => $status,
				'user_id' => $user
			]);

			$thisBookingEquipment = Bookings::orderBy('created_at','DESC')->first();
			$bookingIdEquipment = $thisBookingEquipment->id;

			//create
			bookings_equipment::create([
				'bookings_id' => $bookingIdEquipment,
				'equipment_id' => $equipment1,
			]);

		}else{

		}

		return view('home.test', compact('checkAvalibility', 'checkAvalibilityEquipment'));


	}

	public function roomSelected($room){
		$getEquipmentsInRoom = Equipments::where('location', $room)->get();

		return json_encode($getEquipmentsInRoom);
	}

	public function delete( $booking){
		$isAdmin = auth()->user()->role == 'Admin';
		//if statement to check if $isAdmin is true
		if ($isAdmin){
			$id = $booking;

			Bookings::where('id', $id)->delete();

			//flashes the session with a value for notify user
			//flash only lasts for 1 redriect
			session()->flash('notifyUser', 'Booking deleted!');
			return redirect()->route('admin');
		} else {
			echo 'You are not an admin!';
		}
		
	}

	public function approve( $booking){
		$isAdmin = auth()->user()->role == 'Admin';
		//if statement to check if $isAdmin is true
		if ($isAdmin){
			$id = $booking;

			Bookings::where('id', $id)->
			update([
				'status' => 'Active'
			]);

			//SHOULD ADD UPDATED BY HERE!!!!!! >:D

			//flashes the session with a value for notify user
			//flash only lasts for 1 redriect
			session()->flash('notifyUser', 'Booking approved!');
			return redirect()->route('admin');
		} else {
			echo 'You are not an admin!';
		}
		
	}
}
