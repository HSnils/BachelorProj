<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Fetches all categories and items which are open from the database.
     * @return callable Returns the home.index view along with the categories
     * and items.
     */
    public function index()
    {
        //$allCategories = Category::all();
       // $allItems = Item::where('status', 'Open')->latest()->take(20)->get();
		return view('home.index'/*, compact('allCategories', 'allItems')*/);
    }
}