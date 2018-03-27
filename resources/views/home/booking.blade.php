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
		<div>
			<form role="form" method="POST" action="{{ url('booking/create') }}" class="bookingForm">
				{{ csrf_field() }}
						
						<span class="marginTop1 marginBottom1">Choose a room</span>
						<select class="formPadding flex100 width100" name="room_number" id="room_numberBooking">
							<option disabled="">Select a room</option>
							@foreach($allRooms as $room)
								<option value="{{$room->room_number}}">{{$room->room_number}}</option>
							@endforeach
						</select>
						
						<div class="formGroupParent marginTop1 marginBottom1">
							<div class="formGroup">
								<label for="dateFrom" class=" ">Book From</label>
								<input type="date" name="dateFrom" id="dateFrom" class="formPadding marginTop1 ">
								<select name="timeFrom" id="timeFrom" class="formPadding width100">
									@php
										inputTimeDropdown(6, 20);
									@endphp
								</select>
							</div>

							<div class="formGroup">
								<label for="dateTo" class=" ">Book To</label>
								<input type="date" name="dateTo" id="dateTo" class="formPadding marginTop1 ">
								<select name="timeTo" id="timeTo" class="formPadding width100">
									@php
										inputTimeDropdown(6, 20);
									@endphp
								</select>
							</div>
						</div>
						<section id="equipmentsSection" class="marginTop1 marginBottom1 width100">
			
						</section>

				<div class="mdl-card__actions mdl-card--border">
					<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" style="float:right">
						Book
					</button>
				</div>

			</form>
			@include('partials.errors')
		</div>
	</div>
	<div class="mdl-card__menu">
		<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
			<i class="material-icons">share</i>
		</button>
	</div>
</div>

@php
	function inputTimeDropdown($minHour, $maxHour){
		for($i=$minHour;$i<=$maxHour;$i++){
			for($e=0; $e <= 1; $e++){

				if($e == 1){
					$minutes = 30;
				} else {
					$minutes = 0;
				}
				$zero = 0;

				//checks if time is less than 10hours and minutes adds extra zero in front and adds extra zero in the back
				if($i < 10 && $e == 0){
					echo '<option value="'.$zero.$i.':'.$minutes.$minutes.'">'.$zero.$i.':'.$minutes.$minutes.'</option>';
				//Does not add zero in the back
				}elseif($i<10 && $e==1){
					echo '<option value="'.$zero.$i.':'.$minutes.'">'.$zero.$i.':'.$minutes.'</option>';
				//ands zero in the back not in the front
				}elseif($e==0){
					echo '<option value="'.$i.':'.$minutes.$minutes.'">'.$i.':'.$minutes.$minutes.'</option>';
				//adds no zeros
				}else{
					echo '<option value="'.$i.':'.$minutes.'">'.$i.':'.$minutes.'</option>';
				}
				
			}	
		}
	}
@endphp
<!--<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
			<input class="mdl-textfield__input" value="" id="room_number" readonly/>
			<input value="" type="hidden" name="Select Room"/>
			<i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
				<label class="mdl-textfield__label" for="room_number">Room Number</label>
					<ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="room_number">
						@foreach($allRooms as $room)
							<li class="mdl-menu__item" data-val="{{ $room->room_number }}">{{ $room->room_number }}</li>
						@endforeach
					</ul>
		</div>-->

