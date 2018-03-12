<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Bookings;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
   
    
     public function index()
    {
        $isAdmin = auth()->user()->role == 'Admin';

        if ($isAdmin){
            $newUsers = User::orderBy('created_at', 'desc')->where('role', 'guest')->take(5)->get();

            $allRoles = Roles::where('role', '!=', 'guest')->orderBy('role', 'desc')->get();

            $newBookings = Bookings::join('users', 'bookings.user_id', '=', 'users.id')->where('users.role', 'student')->orderBy('bookings.created_at', 'desc')->take(5)->get();

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
            User::where('id', $user->id)->delete();

            //flashes the session with a value for notify user
            //flash only lasts for 1 redriect
            session()->flash('notifyUser', 'User deleted!');
            return redirect()->route('admin');
        } else {
            echo 'You are not an admin!';
        }
    }

}