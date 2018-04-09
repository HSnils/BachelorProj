<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rooms;
use App\Bookings;
use App\bookings_equipments;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	
	 public function index(){

		$allRooms = Rooms::all();

		$loggedInUser = Auth::id();
		$timeNow = now();
		
        //gets all of the users bookings, that is upcomming in the future
        $yourBookings = Bookings::where('bookings.user_id', $loggedInUser)->where('bookings.from_date', '>', $timeNow)->orderBy('bookings.from_date', 'ASC')->get();

        //gets the information on the users booked equipments name and location through joins
        $yourEquipments = Bookings::join('bookings_equipments', 'bookings.id', '=', 'bookings_equipments.bookings_id')->join('equipments', 'bookings_equipments.equipment_id', '=', 'equipments.id')->select('equipments.name as equipmentName', 'equipments.location as location', 'equipments.id as equipmentID')->where('bookings.user_id', $loggedInUser)->where('bookings.from_date', '>', $timeNow)->get();

        //removes the variable adminDashboard from session so that naviagtion changes
		session()->forget('adminDashboard');
		return view('home.index', compact('allRooms', 'yourBookings', 'yourEquipments'));
	}
}