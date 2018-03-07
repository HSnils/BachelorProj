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
            session()->flash('notifyUser', 'User approves, role updated!');
            return redirect()->route('admin');
            //User::where('id', $user->id)
        }
    }

}