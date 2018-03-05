<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
   
    
     public function index()
    {
        $allUsers = User::all();
        return view('home.index', compact('allUsers'));
    }
    /*
    public function index()
    {
        $allCategories = Category::all();
        $allItems = Item::where('status', 'Open')->latest()->take(20)->get();
		return view('home.index', compact('allCategories', 'allItems'));
    }*/
}