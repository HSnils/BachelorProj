@extends('partials.template')

@section('content')
        <div class="mdl-card mdl-shadow--4dp">
    		<div class="mdl-card__title">
				<h2 class="mdl-card__title-text">Register</h2>
			</div>
			<div class="mdl-card__supporting-text">
				<form class="form" role="form" method="POST" action="{{ route('register') }}">
					{{ csrf_field() }}

					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<label for="name" class="col-md-4 control-label mdl-textfield__label">Name</label>

						<div class="col-md-6">
							<input id="name" type="text" class="form-control mdl-textfield__input" name="name" minlength="2" maxlength="30" value="{{ old('name') }}" autofocus>

							@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<label for="email" class="col-md-4 control-label mdl-textfield__label">E-Mail Address</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control mdl-textfield__input" name="email" maxlength="90" value="{{ old('email') }} " pattern="[\w._%+-]+@ntnu.no|[\w._%+-]+@stud.ntnu.no" title="Use your @ntnu.no e-mail!" >
							<span class="mdl-textfield__error">
								Use your NTNU e-mail! Check subdomain (@stud.ntnu.no or @ntnu.no) 
							</span>
							@if ($errors->has('email'))
								<span class="">
									{{ $errors->first('email') }}
								</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<label for="password" class="col-md-4 control-label mdl-textfield__label">Password</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control mdl-textfield__input" name="password" minlength="3" maxlength="255" >

							@if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<label for="password-confirm" class="col-md-4 control-labe mdl-textfield__label">Confirm Password</label>

						<div class="col-md-6">
							<input id="password-confirm" type="password" class="form-control mdl-textfield__input" name="password_confirmation">
						</div>
					</div>

					<br>

						<div class="mdl-card__actions mdl-card--border">
							
							<button type="submit" class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" style="float:right">
								Register
							</button>
							
						</div>
				</form>
			</div>
        </div>
@endsection
