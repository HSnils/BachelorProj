@extends('layouts.template')

@section('content')

    
<div class="mdl-card mdl-shadow--4dp">
    <!--<div class="mdl-card__media"><img src="skytower.jpg" width="173" height="157" border="0"
    alt="" style="padding:10px;">
    </div>-->
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Sign in</h2>
    </div>
    <div class="mdl-card__supporting-text">
        <form action="#">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="email" id="email">
                <label class="mdl-textfield__label" for="email">E-mail</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="password" id="password">
                <label class="mdl-textfield__label" for="password">Password...</label>
            </div>
        </form>
    </div>
    <br>
    <div class="mdl-card__actions mdl-card--border">
        <!-- Accent-colored raised button with ripple -->
        <!-- Accent-colored flat button -->
        <button class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect">
            Sign in
        </button>
        <!-- Flat button with ripple -->
        <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
            Register
        </button>
    </div>
</div>

    <div class="panel-heading">Login</div>
    <div class="panel-body">
        <div class="slim-container">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
