<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\VerifyUser;
use App\Mail\VerifyMail;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		//|email_domain:'.$data['email'].' add this after email and uncomment function in appprovider to run check on domain
		return Validator::make($data, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:3|confirmed',
		]);
	}


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
   /** protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }
	**/
	protected function create(array $data)
    {
 
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'last_login' => now()
        ]);
 
        $verifyUser = VerifyUser::create([
			'user_id' => $user->id, 
            'token' => sha1(time())
        ]);
 
        Mail::to($user->email)->send(new VerifyMail($user));
		
		if (Mail::failures()) {
        	return redirect('/login')->with('status', 'Mail did not send, ask an admin for verification');
    	}
		else {
			
			$user->mailSent = 1;
			
		}
		
 		
        return $user;
    }
	
	public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now sign in.";
            }else{
                $status = "Your e-mail is already verified. You can now sign in.";
            }
        }else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }
 
        return redirect('/login')->with('status', $status);
    }
	
	protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
		
        return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }
}
