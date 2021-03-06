@extends('partials.template')

@section('content')

<div class="flex-container">
	<div class="mdl-card mdl-shadow--4dp flex-item">
		 <!--<div class="mdl-card__media"><img src="skytower.jpg" width="173" height="157" border="0"
		 alt="" style="padding:10px;">
		 </div>-->
		<div class="mdl-card__title">
			<h2 class="mdl-card__title-text">Sign in</h2>
		</div>
		@if (session('status'))
			<div class="alertBox alertGreen">
				{{ session('status') }}
			</div>
		@endif
		@if (session('warning'))
			<div class="alertBox alertYellow">
				{{ session('warning') }}
			</div>
		@endif
		 <div class="mdl-card__supporting-text">
			  <form role="form" method="POST" action="{{ route('login') }}">
					{{ csrf_field() }}

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">

						 <input class="mdl-textfield__input" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" pattern="[\w._%+-]+@ntnu.no|[\w._%+-]+@stud.ntnu.no" title="Use your @ntnu.no e-mail!"  autofocus>
						 <label class="mdl-textfield__label" for="email">E-mail</label>
						 <span class="mdl-textfield__error">Only @ntnu.no e-mails allowed.</span>

						 @if ($errors->has('email'))
							  <span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
							  </span>
						 @endif
					</div>

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">

						 <input class="mdl-textfield__input" type="password" id="password" name="password" >
						 <label class="mdl-textfield__label" for="password">Password...</label>

						 @if ($errors->has('password'))
							  <span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
							  </span>
						 @endif
					</div>

					<div class="form-group">
						 <div class="col-md-6 col-md-offset-4">
							  <div class="checkbox">
									<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
										<input class="mdl-checkbox__input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
										<span class="mdl-checkbox__label">Remember me</span>
									</label>
							  </div>
						 </div>
					</div>
				  	<div class="form-group">
						<a class="reset_pass" href="{{route('password.request')}}">Lost your password?</a>
				  	</div>
					<br>
					<div class="mdl-card__actions mdl-card--border" >
						 <!-- Accent-colored raised button with ripple -->
						 <!-- Accent-colored flat button -->
						 <button type="submit" class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" style="float:right">
							  Sign in
						 </button>
						 <!-- Flat button with ripple -->
						 <a href="{{ route ('register') }}" class="mdl-button mdl-js-button mdl-js-ripple-effect" style="float:right">
							  Register
						 </a>
					</div>
			  </form>
		 </div>

	</div>
</div>
@endsection
