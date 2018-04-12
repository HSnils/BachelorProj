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

.mdl-card__title-text{

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
						
						<span class="materialLabel marginTop1 marginBottom1">Choose a room</span>
						<select class="formPadding flex100 width100" name="room_number" id="room_numberBooking">
							<option disabled>Select a room</option>
							@foreach($allRooms as $room)
								<option value="{{$room->room_number}}">{{$room->room_number}} - {{$room->type}}</option>
							@endforeach
						</select>

						<!--<div class="calendarBox mdl-grid">
							<div class="calendarHead mdl-cell mdl-cell--12-col">
								<div class="calendarCell">
									Monday
								</div>
								<div class="calendarCell">
									Tuesday
								</div>
								<div class="calendarCell">
									Wednesday
								</div>
								<div class="calendarCell">
									Thursday
								</div>
								<div class="calendarCell">
									Friday
								</div>
							</div>
							<div class="calendarColums mdl-cell mdl-cell--12-col">
								<div class="calendarCell">
									<div class="calendarBooked">Booked</div>
								</div>
								<div class="calendarCell">
									<div class="calendarBooked">Booked</div>
								</div>
								<div class="calendarCell">
									<div class="calendarBooked">Booked</div>
								</div>
								<div class="calendarCell">
									<div class="calendarBooked">Booked</div>
								</div>
								<div class="calendarCell">
									<div class="calendarBooked">Booked</div>
								</div>
							</div>
						</div>-->
						
						<div class="formGroupParent marginTop1 marginBottom1">
							<div class="formGroup">
								<label for="dateFrom" class="materialLabel ">Book From</label>
								<br>
								<input type="date" name="dateFrom" id="dateFrom" class="formPadding marginTop1 ">

								<div class="mdl-tooltip" data-mdl-for="dateFrom">
									Select starting date
								</div>

								<select name="timeFrom" id="timeFrom" class="formPadding width100">
									@php
										//fills dropdown with options from minimum hour to maximum hour
										inputTimeDropdown(6, 20);
									@endphp
								</select>

								<div class="mdl-tooltip" data-mdl-for="timeFrom">
									Select starting time
								</div>

							</div>

							<div class="formGroup">
								<label for="dateTo" class="materialLabel ">Book To</label>
								<br>
								<input type="date" name="dateTo" id="dateTo" class="formPadding marginTop1 ">
								
								<div class="mdl-tooltip" data-mdl-for="dateTo">
									Select ending date
								</div>

								<select name="timeTo" id="timeTo" class="formPadding width100">
									@php
										//fills dropdown with options from minimum hour to maximum hour
										inputTimeDropdown(6, 20);
									@endphp
								</select>

								<div class="mdl-tooltip" data-mdl-for="timeTo">
									Select ending time
								</div>

							</div>
						</div>

						<section id="bookingUseage" hidden class="formGroupParent marginTop1 marginBottom1">
							<div class="formGroup">
								<label for="useageSelect" class="materialLabel ">Useage:</label>
								<br>
								<select name="" id="useageSelect" class="formPadding marginTop1 width100">
									<option value="Education">Education</option>
									<option value="Project">Projects</option>
									<option value="Other" selected>Other</option>
								</select>
							</div>

							<div class="formGroup">
								<label for="spesificUseageSelect" class="materialLabel ">Specific:</label>
								<br>
								<select name="spesificUseageSelect" id="spesificUseageSelect" class="formPadding marginTop1 width100">
									<span id="spesificUseageItems">
										<option disabled selected>Choose useage</option>
										@foreach($allCategories as $category)
											@if($category->type == "Other")
												<option value="{{$category->category}}">{{$category->category}}</option>
											@endif
										@endforeach
									</span>
								</select>
							</div>
						</section>
						
						<section id="roomPrivacy" hidden>
							<span class="materialLabel marginTop1 marginBottom1">Room privacy</span>
							<br>
							<span class="roomPrivacyBox">
								<span>
									<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="others_can_use" id="others_can_use_label">
										<input type="radio" id="others_can_use" class="mdl-radio__button" name="roomPrivacy" value="0" checked>
										<span class="mdl-radio__label">
											Public
										</span>

									</label>
									<div class="mdl-tooltip" data-mdl-for="others_can_use_label">
									Others can<br> use room
									</div>

								</span>
								<span>
									<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="room_is_private" id="room_is_private_label">
										<input type="radio" id="room_is_private" class="mdl-radio__button" name="roomPrivacy" value="1">
										<span class="mdl-radio__label">Private</span>
									</label>
									<div class="mdl-tooltip" data-mdl-for="room_is_private_label">
									Only you<br>can use room
									</div>
								</span>
							</span>
						</section>

						<section id="equipmentsSection" class="marginTop1 marginBottom1 width100">
			
						</section>

				<div class="mdl-card__actions mdl-card--border">
					<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" style="float:right" disabled id="bookingButton">
						Book
					</button>
				</div>

			</form>
			
		</div>
	</div>
	@include('partials.errors')
</div>


@php
	function inputTimeDropdown($minHour, $maxHour){
		for($i=$minHour;$i<=$maxHour;$i++){
			for($e=0; $e <= 1; $e++){

				//will only happen once per hour
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
<!--
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
	<input class="mdl-textfield__input" value="" id="room_number" readonly/>
	<input value="" type="hidden" name="Select Room"/>
	<i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
		<label class="mdl-textfield__label" for="room_number">Room Number</label>
			<ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="room_number">
				@foreach($allRooms as $room)
					<li class="mdl-menu__item" data-val="{{ $room->room_number }}">{{ $room->room_number }}</li>
				@endforeach
			</ul>
</div>
-->

