<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rooms;
use App\Bookings;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	
	 public function index(){

		$allRooms = Rooms::all();

		$loggedInUser = Auth::id();
		$timeNow = now();
		$yourBookings = Bookings::where('user_id', $loggedInUser)->where('from_date', '>', $timeNow)->get();

		session()->forget('adminDashboard');
		return view('home.index', compact('allRooms', 'yourBookings'));
	}
}