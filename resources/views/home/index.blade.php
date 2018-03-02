@extends('partials.template')

@section('content')

	<!-- Wide card with share menu button -->
<!--<style>
.demo-card-wide.mdl-card {
  width: 512px;
}
.demo-card-wide > .mdl-card__title {
  color: #fff;
  height: 176px;
  background: url('../assets/demos/welcome_card.jpg') center / cover;
}
.demo-card-wide > .mdl-card__menu {
  color: #000;
}

.mdl-card__title-text{
	color: #000;
}
</style>

<div class="demo-card-wide mdl-card mdl-shadow--2dp">
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text">Welcome</h2>
  </div>
  <div class="mdl-card__supporting-text">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Mauris sagittis pellentesque lacus eleifend lacinia...
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Get Started
    </a>
  </div>
  <div class="mdl-card__menu">
    <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
      <i class="material-icons">share</i>
    </button>
  </div>
</div>-->

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



  @include('../partials.mdl-button')
@endsection