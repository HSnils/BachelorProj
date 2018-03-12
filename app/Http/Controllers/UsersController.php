<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;

class UsersController extends Controller
{
	/**
	 * Fetches all categories and items which are open from the database.
	 * @return callable Returns the home.index view along with the categories
	 * and items.
	 */
	public function index()
	{
		$allUsers = User::orderBy('created_at', 'desc')->get();
		$allRoles = Roles::all();
		return view('admin.users', compact('allUsers', 'allRoles'));
	}
}