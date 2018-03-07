<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
   
    
     public function index()
    {
        $isAdmin = auth()->user()->role == 'Admin';

        if ($isAdmin){
            return view('admin.index');
        } else {
            return redirect()->route('home');
        }

    }
    
}