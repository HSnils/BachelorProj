<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
     public function index()
    {
        return view('profile.index');
    }

    /**
	 * Updates the logged in users' username, based on user input.
	 * @param array $user An array containing information about the logged in user.
	 * @return callable Calls a function that redirects the user to the settings page.
	 */
	public function updateUsername(User $user) {
        $this->validate(request(), [
            'username' => 'required|min:2|max:30'
        ]);

		$loggedInUserId = auth()->user()->id;
		if ($loggedInUserId == $user->id){
			$user->updateUsername(request(['username']));

			//Flashes the session with a value for notify user
			//Flash only lasts for 1 redriect
			session()->flash('notifyUser', 'Username updated!');
			return redirect()->route('profile');
		} else {
			echo 'This is not your account!';
		}
	}

	/**
	 * Updates the logged in users' password, based on user input.
	 * @param array $user An array containing information about the logged in user.
	 * @return callable Calls a function that redirects the user to the settings page.
	 */
	public function updatePassword(User $user) {
        $this->validate(request(), [
        	'password' => 'required|min:5|max:255'
        ]);

		$loggedInUserId = auth()->user()->id;
		if ($loggedInUserId == $user->id){
			$user->updatePassword(request(['password']));

			//Flashes the session with a value for notify user
			//Flash only lasts for 1 redriect
			session()->flash('notifyUser', 'Password updated!');
			return redirect()->route('profile');
		} else {
			echo 'This is not your account!';
		}
	}
}
