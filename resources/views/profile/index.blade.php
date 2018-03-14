@extends('partials.template')

@section('content')

<div class="flex-container">
	<div class="profileDiv">
		<div class="mdl-typography--display-1-color-contrast"> {{ Auth::user()->name }}'s Profile<br> </div>
		<ul>
			<li>
				<b>Role:</b> 
				{{ Auth::user()->role }}
			</li>
			<br>
			<li>
				<b>E-mail:</b> 
				{{ Auth::user()->email }}
			</li>
			<li>
				<b>Account status:</b>
				{{ Auth::user()->status }}
			</li>
			<hr>
			<li>
				<b>Last login:</b>
				{{ Auth::user()->last_login }}
			</li>
		</ul>
		<!--<i class="material-icons profilePicture square100">account_box</i>-->
		<!--<img class="profilePicture" height="100px" width="100px">-->
	</div>
	<div class="slim-container">
		<div class="mdl-typography--display-1-color-contrast">Update your user details:</div>

		<form method="POST" action="{{ url('profile/settings/update/username')}}/{{ Auth::user()->id }}">
			{{ csrf_field() }}

			<div class="form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<label for="username" class=" form-control mdl-textfield__label">Update Username:</label>
				<input type="text" class="form-control mdl-textfield__input" id="username" name="username" minlength="2" maxlength="30">
			</div>

			<div class="form-group">

				<button type="submit" class="btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Update Username</button>
			</div>
		</form>
		
		<br>

		<form method="POST" action="{{ url('profile/settings/update/password')}}/{{ Auth::user()->id }}">
			{{ csrf_field() }}

			<div class="form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<label for="password" class="mdl-textfield__label">Update Password:</label>
				<input type="password" class="form-control mdl-textfield__input" id="password" name="password" minlength="3" maxlength="255">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Update Password</button>
			</div>
		</form>

		@include('partials.errors')
	</div>
</div>
@endsection