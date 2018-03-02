<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
   
    
     public function index()
    {
        return view('home.index');
    }
    /*
    public function index()
    {
        $allCategories = Category::all();
        $allItems = Item::where('status', 'Open')->latest()->take(20)->get();
		return view('home.index', compact('allCategories', 'allItems'));
    }*/
}