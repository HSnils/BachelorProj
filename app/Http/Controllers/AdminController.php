<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;

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
            return view('admin.index', compact('newUsers', 'allRoles'));
        } else {
            return redirect()->route('home');
        }

    }

}