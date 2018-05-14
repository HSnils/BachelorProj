<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rooms;
use App\Bookings;
use App\bookings_equipments;
use App\Categories;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	
	 public function index(){

	 	$paginateNumber=10;
		$allRooms = Rooms::all();

		$loggedInUser = Auth::id();
		$timeNow = now();

        $allCategories = Categories::all();
		
        //gets all of the users bookings, that is upcomming in the future
        $yourBookings = Bookings::where('bookings.user_id', $loggedInUser)->where('bookings.from_date', '>', $timeNow)->orderBy('bookings.from_date', 'ASC')->paginate($paginateNumber);

        //removes the variable adminDashboard from session so that naviagtion changes
		session()->forget('adminDashboard');
		return view('home.index', compact('allRooms', 'yourBookings','allCategories'));
	}
}