<!--<div class="mdl-typography--display-4 mdl-color-text--grey-600">
	Welcome
	@if(Auth::user())
		{{", ".Auth::user()->name}}
	@endif
</div>-->
<!-- Wide card with share menu button -->
<style>
.demo-card-wide.mdl-card {
	width: 512px;
}
.demo-card-wide > .mdl-card__title {
	color: #fff;
	height: 176px;
	background: url('images/welcome_card.jpg') center / cover;
}
.demo-card-wide > .mdl-card__menu {
	color: #fff;
}
</style>

<div class="demo-card-wide mdl-card mdl-shadow--2dp">
	<div class="mdl-card__title">
		<h2 class="mdl-card__title-text ">Welcome
			@if(Auth::user())
				{{", ".Auth::user()->name}}
			@endif
		</h2>
	</div>
	<div class="mdl-card__supporting-text">
		Booking coming soon...
	</div>
	<div class="mdl-card__actions mdl-card--border">
		<a class="mdl-button mdl-button--primary mdl-js-button mdl-js-ripple-effect">
			Booking
		</a>
	</div>
	<div class="mdl-card__menu">
		<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
			<i class="material-icons">share</i>
		</button>
	</div>
</div>

<div>
	<form role="form" method="POST" action="{{ url('booking/create') }}" class="formStyle">
		{{ csrf_field() }}
		
		<select name="room_number" id="room_number">
			<option disabled="">Select a room</option>
			@foreach($allRooms as $room)
				<option value="{{$room->room_number}}">{{$room->room_number}}</option>
			@endforeach
		</select>
		
		<label for="dateFrom">Time From</label>
		<input type="date" name="dateFrom" id="dateFrom">
		<input type="time" name="timeFrom" id="timeFrom">

		<label for="dateTo">Time To</label>
		<input type="date" name="dateTo" id="dateTo">
		<input type="time" name="timeTo" id="timeTo">


		<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" style="float:right">
			Book
		</button>

	</form>

	@include('partials.errors')
</div>