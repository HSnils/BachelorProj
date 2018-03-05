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
}