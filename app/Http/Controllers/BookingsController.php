<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookings;
use App\Rooms;
use App\Equipments;
use App\User;
use App\bookings_room;
use App\bookings_equipment;
use App\Categories;
use Auth;
use Carbon\Carbon;
use Validator;
use Redirect;

class BookingsController extends Controller
{
	/**
	 * [create description]
	 * @param  Request $request [all inputs from the form]
	 * @return [Response]           [return either successfull or declined booking]
	 */
	public function create(Request $request){
		//validates input (checks if they are filled in)
		$validator = Validator::make($request->all(), [
			'room_number' => 'required',
			'dateFrom' => 'required',
			'timeFrom' => 'required',
			'dateTo' => 'required',
			'timeTo' => 'required',
			'roomPrivacy' => 'required',
			'spesificUseageSelect' => 'required',

		]);

		//all fields have a hidden token field so need to add 1, if you add more fields that is not equipments you need to add that to this number
		//$requiredFields = 5 + 1;

		//gets all inputs into an array
		$allInputs = $request->all();

		$requiredFields = count($request->except('selectedEquipments'));
		//subtracts the required fields from the number if inputs
		$numberOfEquipments = count($allInputs) - $requiredFields;

		//gets the equipments selected array
		$equipmentsArray = $request->input('selectedEquipments');

		//fills variables with inputs
		$roomNumber = $request->input('room_number') ;
		//dates
		$dateFrom = new Carbon($request->input('dateFrom') . ' ' . $request->input('timeFrom').':00');
		$dateFrom->format('Y-m-d H:i:s');
		$dateTo = new Carbon($request->input('dateTo') . ' ' . $request->input('timeTo').':00');
		$dateTo->format('Y-m-d H:i:s');
		
		//offsets the dates with a few seconds to use for a query
		$offsetDateFrom = new Carbon($dateFrom);
		$offsetDateFrom->addSecond();
		$offsetDateTo = new Carbon ($dateTo);
		$offsetDateTo->subSecond();
		//room priv
		$roomPrivacy = $request->input('roomPrivacy');

		$useageCategory = $request->input('spesificUseageSelect');

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

		//checks if the booking is inside of an exsisting booking
		$findsBookingInsideABooking = Bookings::
			join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')
			->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')
			->where('rooms.room_number', '=', $roomNumber)
			->where('from_date', '<=', $dateFrom)
			->where('to_date', '>=', $dateTo)
		->count();

		if($findsBookingInsideABooking == 0){
			//checks if the booking is overlapping with an exsisting booking
			$findsBookingOverlappingBookings = Bookings::
				join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')
				->join('rooms', 'bookings_rooms.room_number', '=', 'rooms.room_number')
				->where('rooms.room_number', '=', $roomNumber)
				->whereBetween('from_date', [$offsetDateFrom, $offsetDateTo])
				->orWhereBetween('to_date', [$offsetDateFrom, $offsetDateTo])
			->count();

			//if its overlapping
			if($findsBookingOverlappingBookings >= 1){
				$bookingStatus = "Your booking is overlapping with another booking.";
				$validator->getMessageBag()->add('roomNotAvalible', $bookingStatus);
				return Redirect::back()->withErrors($validator)->withInput();
				$roomAvalible = false;

			} else {
				//returns true if no errors and the booking is avalible
				$roomAvalible = true;
			}
		} else {
			$roomAvalible = false;
			$bookingStatus = "Your booking of a room was not avalible!";
			$validator->getMessageBag()->add('roomNotAvalible', $bookingStatus);
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//check to find out if the equiment/s are avablible, only do this if there was any booked equipments
		function checkEquipmentAvalibility($equipmentsArray, $dateTo, $dateFrom, $offsetDateTo, $offsetDateFrom){
			

			for($i = 0; $i < count($equipmentsArray); $i++){
				$equipment_id = $equipmentsArray[$i];

				$findsBookingInsideABooking = Bookings::
					join('bookings_equipments', 'bookings.id', '=', 'bookings_equipments.bookings_id')
					->join('equipments', 'bookings_equipments.equipment_id', '=', 'equipments.id')
					->where('equipments.id', $equipment_id)
					->where('from_date', '<=', $dateFrom)
					->where('to_date', '>=', $dateTo)
				->count();

				if($findsBookingInsideABooking == 0){
					$findsBookingOverlappingBookings = Bookings::
						join('bookings_equipments', 'bookings.id', '=', 'bookings_equipments.bookings_id')
						->join('equipments', 'bookings_equipments.equipment_id', '=', 'equipments.id')
						->where('equipments.id', $equipment_id)
						->whereBetween('from_date', [$offsetDateFrom, $offsetDateTo])
						->orWhereBetween('to_date', [$offsetDateFrom, $offsetDateTo])
					->count();

					//returns false if the booking overlaps another booking
					if($findsBookingOverlappingBookings >= 1){
						return false;
					} 
				}else{
					//returns false if there was a booking inside the booking
					return false;
				}

			}
			//if it did the whole for loop without finding another booking at same time return true
			return true;
		}

		//if checkRoomAvalibility == 0 there is no other room bookings
		//if number of bookings
		if($numberOfEquipments == 0){
			if($roomAvalible == true){
				//creates a booking on room if there was no equipments selected and the room is avalible
				
				Bookings::create([
					'type' => 'Room',
					'category' => $useageCategory,
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
					'private' => $roomPrivacy,
				]);

				session()->flash('notifyUser', 'Room booked!');
			} else {
				session()->flash('notifyUser', 'Room is not avalible!');
				$validator->getMessageBag()->add('roomBooked', 'Your booking of a room is not avalible.');    
				return Redirect::back()->withErrors($validator)->withInput();
			}
		} else if($roomAvalible == true && checkEquipmentAvalibility($equipmentsArray, $dateTo, $dateFrom, $offsetDateTo, $offsetDateFrom)){
			//if room is avalible and there is an equipment selected
			
			Bookings::create([
				'type' => 'Room',
				'category' => $useageCategory,
				'from_date' => $dateFrom,
				'to_date' => $dateTo,
				'status' => $status,
				'user_id' => $user
			]);

			//finds the ID of the booking we just created to fill the "bookings_rooms" table bookings_id coloumn
			$thisBooking = Bookings::orderBy('id','DESC')->where('type', 'Room')->first();
			$bookingId = $thisBooking->id;

			//create
			bookings_room::create([
				'bookings_id' => $bookingId,
				'room_number' => $roomNumber,
				'private' => $roomPrivacy,
			]);


			for($i = 0; $i < count($equipmentsArray); $i++){

				Bookings::create([
					'type' => 'Equipment',
					'category' => $useageCategory,
					'from_date' => $dateFrom,
					'to_date' => $dateTo,
					'status' => $status,
					'user_id' => $user
				]);

				//finds the ID of the booking we just created to fill the "bookings_equipments" table bookings_id coloumn
				$thisBookingEquipment = Bookings::orderBy('id','DESC')->where('type', 'Equipment')->first();
				$bookingIdEquipment = $thisBookingEquipment->id;

				//create
				bookings_equipment::create([
					'bookings_id' => $bookingIdEquipment,
					'equipment_id' => $equipmentsArray[$i],
				]);
			}

			session()->flash('notifyUser', 'Room and Equipment booked!');

		}else{
			session()->flash('notifyUser', 'Room and Equipment not avalible!');
			$bookingStatus = "Your booking of a room and equipment is not avalible!";
			$validator->getMessageBag()->add('roomNotAvalible', $bookingStatus);
			return Redirect::back()->withErrors($validator)->withInput();
		}

		return redirect()->route('home');


	}

	//when room is selected in the dropdown sends a ajax request with the room to get the list of equipments 
	public function roomSelected($room){
		$getEquipmentsInRoom = Equipments::where('location', $room)->get();

		return json_encode($getEquipmentsInRoom);
	}

	public function	useageSelected($useage){
		$getSelectedUseage = Categories::where('type', $useage)->get();
		return json_encode($getSelectedUseage);
	}

	/**
	 * [delete description]
	 * @param  [type] $booking [filled with booking id variable]
	 * @return [type]          [deletes booking if user is admin]
	 */
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

	/**
	 * [approve description]
	 * @param  [type] $booking [filled with booking id ]
	 * @return [type]          [approves new booking]
	 */
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
