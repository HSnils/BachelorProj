@extends('partials.template')

@section('content')
	<div class="panel-heading"> {{ Auth::user()->name }}'s Profile</div>

	<div class="panel-heading">Settings</div>
	<div class="panel-body">
		<div class="slim-container">
			<div class="mdl-typography--display-2-color-contrast">Update your userdetails:</div>

			<form method="POST" action="{{ url('profile/settings/update/username')}}/{{ Auth::user()->id }}">
				{{ csrf_field() }}

				<div class="form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					<label for="username" class="mdl-textfield__label">Update Username:</label>
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