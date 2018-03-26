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
		//validates input (checks if they are filled in)
		$this->validate(request(), [
			'room_number' => 'required',
			'dateFrom' => 'required',
			'timeFrom' => 'required',
			'dateTo' => 'required',
			'timeTo' => 'required',
		]);
		//all fields have a hidden token field so need to add 1 
		$requiredFields = 5 + 1;
		//gets all inputs into an array
		$allInputs = $request->all();
		//subtracts the required fields from the number if inputs
		$numberOfEquipments = count($allInputs) - $requiredFields;

		//fills variables with inputs
		$roomNumber = $request->input('room_number') ;
		$dateFrom = $request->input('dateFrom') . ' ' . $request->input('timeFrom').":00";
		$dateTo = $request->input('dateTo') . ' ' . $request->input('timeTo').":00";

		//gets current user id and role
		$user = Auth::user()->id;
		$userRole = Auth::user()->role;

		//if the users role is Student the status will be "Pending", if employer or admin it will be "Active" (Guests can't book)
		$status;
		
		if($userRole == 'Student'){
			$status = 'Pending';
		} else {
			$status = 'Active';
		}

		//need to fix query add between stuff - checks if room is avalible
		$checkRoomAvalibility = Bookings::join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')->where('from_date', '<=', $dateTo)->where('to_date','>=', $dateFrom)->where('rooms.room_number', '=', $roomNumber)->count();

		$roomAvalible = false;
		//if checkRoomAvalibility == 0 there was no other bookings and the room is avalible
		if($checkRoomAvalibility == 0){
			$roomAvalible == true;
		} else {
			$roomAvalible == false;
		}

		$equimentsAvalible = true;
		//check to find out if the equiment/s are avablible, only do this if there was any booked equipments
		if($numberOfEquipments >= 1){

			for($i = $requiredFields; $i < count($allInputs); $i++){
				$equipment_id = $allInputs['equipment_1'];
				$equipmentCheck = Bookings::join('bookings_equipments', 'bookings.id', '=', 'bookings_equipments.bookings_id')->join('equipments', 'bookings_equipments.equipment_id', '=', 'equipments.id')->where('from_date', '<=', $dateTo)->where('to_date','>=', $dateFrom)->where('equipments.id', $equipment_id)->count();

				//if there was another equipment booking at the same time, change equipments avalible to false
				if($equipmentCheck == 1){

					$equimentsAvalible = false;
				}
			}
		}
		

		//if checkRoomAvalibility == 0 there is no other room bookings
		//if number of bookings
		if($numberOfEquipments == 0){
			if($roomAvalible){
				//creates a booking on room if there was no equipments selected and the room is avalible
				
				Bookings::create([
					'type' => 'Room',
					'category' => 'Noe',
					'from_date' => $dateFrom,
					'to_date' => $dateTo,
					'status' => $status,
					'user_id' => $user
				]);

				//finds the ID of the booking we just created to fill the "bookings_rooms" table bookings_id coloumn
				$thisBooking = Bookings::orderBy('created_at','DESC')->first();
				$bookingId = $thisBooking->id;

				//create the bookings_rooms relation
				bookings_room::create([
					'bookings_id' => $bookingId,
					'room_number' => $roomNumber,
				]);

			} else {
				//error
			}
		} else if ($roomAvalible == true &&  $equimentsAvalible == true){
			//if room is avalible and there is an equipment selected
			
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


			for($i = $requiredFields; $i < count($allInputs); $i++){
				//need to fix query add between stuff
			

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
					'equipment_id' => $allInputs[$i],
				]);
			}

		}else{

		}

		return view('home.test', compact('checkRoomAvalibility', 'numberOfEquipments' ,'allInputs', 'equimentsAvalible'));


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
