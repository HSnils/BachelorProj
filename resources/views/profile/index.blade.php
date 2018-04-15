@extends('partials.template')

@section('content')

    <div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
	PROFILE
    </div>

<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone">
	</div>
	<div class="mdl-cell mdl-cell--3-col mdl-cell--8-col-tablet mdl-cell--4-col-phone">
		<div class="demo-card-square postIt mdl-card postIt mdl-shadow--2dp">
			<div class="mdl-card__title postIt mdl-card--expand">
				<h2 class="mdl-card__title-text"> {{ ucfirst(Auth::user()->name) }}'s Profile </h2>
			</div>
			<div class="mdl-card__supporting-text postIt">
				<br>
				<div class="mdl-typography--headline bulletColor">
					<b>
						<i class="material-icons">assignment_ind</i>
						Role:
					</b> 
					{{ Auth::user()->role }}
				</div>
				<br>
				<div class="mdl-typography--headline bulletColor">
					<b>
						<i class="material-icons">mail_outline</i> 
						E-mail:
					</b> 
					{{ Auth::user()->email }}

				</div>
				<br>
				<br>
			</div>
			<div class="mdl-card__actions postIt">
				<ul id="noBulletPoints" class="bulletColor">
					<li>
						<b>Account status:</b>
						{{ Auth::user()->status }}
					</li>
					<li>
						<b>Last login:</b>
						{{ Auth::user()->last_login }}
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--1-col mmdl-cell--hide-tablet mdl-cell--hide-phone">
	</div>
	<div class="mdl-cell mdl-cell--4-col
				mdl-cell--8-col-tablet mdl-cell--4-col-phone">
		<div class="mdl-typography--display-1-color-contrast">Update your user details</div>

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
	<div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone">
	</div>
</div>
@endsection