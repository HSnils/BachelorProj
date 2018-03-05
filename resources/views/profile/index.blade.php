@extends('partials.template')

@section('content')
	<div class="panel-heading"> {{ Auth::user()->name }}'s Profile</div>

	<div class="panel-heading">Settings</div>
	<div class="panel-body">
		<div class="slim-container">
			<h3>Update your userdetails:</h3>

			<form method="POST" action="{{ url('profile/settings/update/username')}}/{{ Auth::user()->id }}">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="username">Update Username:</label>
					<input type="text" class="form-control" id="username" name="username" minlength="2" maxlength="30">
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Update Username</button>
				</div>
			</form>
			
			<br>

			<form method="POST" action="{{ url('profile/settings/update/password')}}/{{ Auth::user()->id }}">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="password">Update Password:</label>
					<input type="password" class="form-control" id="password" name="password" minlength="3" maxlength="255">
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Update Password</button>
				</div>
			</form>

			@include('partials.errors')
		</div>
	</div>
@endsection