<?php

namespace App\Providers;
use Validator;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{	
		//this will run and check if domain is $allowedEmailDomains
		/*Validator::extend('email_domain', function($attribute, $value, $parameters, $validator) {
			$allowedEmailDomains = ['ntnu.no','stud.ntnu.no']; //can add more with ['firstDomain', 'secondDomain']
			return in_array( explode('@', $parameters[0])[1] , $allowedEmailDomains);
		});*/
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
