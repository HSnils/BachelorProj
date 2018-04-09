<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
	//
	public function index()
	{
		//$allCategories = Categories::all();
		return view('categories.index'/*, compact('allCategories')*/);
	}
}
