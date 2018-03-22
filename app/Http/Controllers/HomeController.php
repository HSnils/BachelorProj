<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rooms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    
     public function index(){

        $allUsers = User::all();
        $allRooms = Rooms::all();
        session()->forget('adminDashboard');
        return view('home.index', compact('allUsers', 'allRooms'));
    }
}