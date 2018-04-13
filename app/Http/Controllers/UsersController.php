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
		$allRoles = Roles::all();
		$usersPerPagination = 10;
		$whereQuery = [];

		if(\Request::has('status')){
			$status = \Request::input('status');
			array_push($whereQuery, ["status", $status]);
		}

		if(\Request::has('role')){
			$role = \Request::input('role');
			array_push($whereQuery, ["role", $role]);
		}

		if(\Request::has('name')){
			$name = \Request::input('name') . '%';
			array_push($whereQuery, ["name", 'LIKE', $name]);
		}

		if(\Request::has('email')){
			$email = \Request::input('email') . '%';
			array_push($whereQuery, ["email", 'LIKE', $email]);
		}

		$allUsers = User::where($whereQuery)->orderBy('created_at', 'desc')->paginate($usersPerPagination);
		return view('admin.users', compact('allUsers', 'allRoles'));
	}
}