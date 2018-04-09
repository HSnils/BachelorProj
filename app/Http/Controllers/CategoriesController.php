<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class CategoriesController extends Controller
{
	//
	public function index()
	{
		$allCategories = Categories::all();
		return view('admin.categories', compact('allCategories'));
	}
}
