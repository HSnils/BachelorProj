<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Rooms;
use App\Equipments;
use App\Categories;
use App\Bookings;
use App\bookings_room;
use App\bookings_equipments;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
   
	
	 public function index()
	{
		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			$newUsers = User::orderBy('created_at', 'desc')->where('role', 'guest')->where('status', '=', 'Active')->take(5)->get();

			$allRoles = Roles::where('role', '!=', 'guest')->orderBy('role', 'desc')->get();

			//join('bookings_equipments', 'bookings.id', '=', 'bookings_equipments.bookings_id')->
			$newBookings = Bookings::join('bookings_rooms', 'bookings.id', '=', 'bookings_rooms.bookings_id')->join('users', 'bookings.user_id', '=', 'users.id')->select('users.id as userID, bookings.id as bookingID')->where('users.role','student')->where('bookings.status', '!=','Active')->orderBy('bookings.created_at', 'desc')->take(5)->get();

			session(['adminDashboard' => 'true']);
			return view('admin.index', compact('newUsers', 'allRoles', 'newBookings'));
		} else {
			return redirect()->route('home');
		}

	}

	public function approveUser(User $user){
		$this->validate(request(), [
			'role' => 'required'
		]);
		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			$user->approveUser(request(['role']));

			//Flashes the session with a value for notify user
			//Flash only lasts for 1 redriect
			session()->flash('notifyUser', 'User approved and role updated!');
			return redirect()->route('admin');
			//User::where('id', $user->id)
		}
	}


	public function editUser(Request $request, User $user){
		$this->validate(request(), [
			'role' => 'required',
			'status' => 'required'
		]);
		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			if($request->has('verified')){
				$user->editUserAndVerify(request());

				//Flashes the session with a value for notify user
				//Flash only lasts for 1 redriect
				session()->flash('notifyUser', 'User updated and verified!');
			}else{
				$user->editUser(request());

				//Flashes the session with a value for notify user
				//Flash only lasts for 1 redriect
				session()->flash('notifyUser', 'User updated!');
			}
			
			return redirect()->route('users');
			//User::where('id', $user->id)
		}
	}

	/**
	 * Deletes a specified user.
	 * @param array $user An array containing information about the specified user.
	 * @return callable Calls a function that redirects the user to the admin page.
	 */
	public function deleteUser(User $user) {
		//checks if the user that is logged in has the role Admin
		$isAdmin = auth()->user()->role == 'Admin';
		//if statement to check if $isAdmin is true
		if ($isAdmin){
			$user->deleteUser($user->id);
			//User::where('id', $user->id)->delete();

			//flashes the session with a value for notify user
			//flash only lasts for 1 redriect
			session()->flash('notifyUser', 'User deleted!');
			return redirect()->route('users');
		} else {
			echo 'You are not an admin!';
		}
	}

	public function showEditUser($user){
		$userID = $user;
		$thisUser = User::where('id', $userID)->get();
		$allRoles = Roles::orderBy('role', 'desc')->get();
		return view('admin.editUser', compact('thisUser', 'allRoles'));
	}

}