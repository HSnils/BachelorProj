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
	/*background: url('images/welcome_card.jpg') center / cover;*/
	background-color: rgb(63,81,181);
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
						
						<span class="materialLabel bookingLabel bookingLabel marginTop1 marginBottom1">Book a room</span>
						<select class="formPadding flex100 width100" name="room_number" id="room_numberBooking">
							<option disabled selected>Select a room</option>
							@foreach($allRooms as $room)
								<option value="{{$room->room_number}}">{{$room->room_number}} - {{$room->type}}</option>
							@endforeach
						</select>

						<div hidden class="formGroupParent marginTop1 marginBottom1" id="dateTimeBox">
							<div class="formGroup">
								<label for="dateFrom" class="materialLabel bookingLabel">Book from*</label>
								<input type="date" name="dateFrom" id="dateFrom" class="formPadding marginTop1 " min="{{date('Y-m-d')}}">

								<div class="mdl-tooltip" data-mdl-for="dateFrom">
									Select starting date
								</div>
								<select name="timeFrom" id="timeFrom" class="formPadding width100">
									<option selected disabled>Start time</option>
									@php
										//fills dropdown with options from minimum hour to maximum hour
										inputTimeDropdown(7, 19);
									@endphp
								</select>
								<div class="mdl-tooltip" data-mdl-for="timeFrom">
									Select starting time
								</div>

							</div>

							<div class="formGroup">
								<label for="dateTo" class="materialLabel bookingLabel">Book to*</label>
								<input type="date" name="dateTo" id="dateTo" class="formPadding marginTop1 " min="{{date('Y-m-d')}}">
								
								<div class="mdl-tooltip" data-mdl-for="dateTo">
									Select ending date
								</div>
								
								<select name="timeTo" id="timeTo" class="formPadding width100">
									<option selected disabled>End time</option>
									@php
										//fills dropdown with options from minimum hour to maximum hour
										inputTimeDropdown(7, 19);
									@endphp
								</select>


								<div class="mdl-tooltip" data-mdl-for="timeTo">
									Select ending time
								</div>

							</div>
						</div>
						
						<section id="showOtherBookingsBox">
							<span id="numberFound"></span>
							<div id="otherBookTableDiv" hidden>
								
								<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp width100">
									<thead>
										<tr>
											<td>Start time</td>
											<td>End time</td>
										</tr>
									</thead>
									<tbody id="otherBookingsTBody">
									</tbody>
								</table>
							</div>
							
						</section>

						<section id="bookingUseage" hidden class="formGroupParent marginTop1 marginBottom1">
							<div class="formGroup">
								<label for="useageSelect" class="materialLabel bookingLabel">Usage*</label>
								<br>
								<select name="" id="useageSelect" class="formPadding marginTop1 width100">
									<option value="Education">Education</option>
									<option value="Project">Projects</option>
									<option value="Other" selected>Other</option>
								</select>
								<div class="mdl-tooltip" data-mdl-for="useageSelect">
									Select usage
								</div>
							</div>

							<div class="formGroup">
								<label for="useageSelect" class="materialLabel bookingLabel">Specify use*</label>
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

								<div class="mdl-tooltip" data-mdl-for="spesificUseageSelect">
									Specify usage
								</div>
							</div>
						</section>
						
						<section id="roomPrivacy" hidden>
							<span class="materialLabel bookingLabel marginTop1 marginBottom1">Room privacy*</span>
							<br>
							<span class="roomPrivacyBox">
								<span>
									<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="room_is_private" id="room_is_private_label">
										<input type="radio" id="room_is_private" class="mdl-radio__button" name="roomPrivacy" value="1" checked>
										<span class="mdl-radio__label">Private</span>
									</label>
									<div class="mdl-tooltip" data-mdl-for="room_is_private_label">
									Only you<br>can use room
									</div>
								</span>
								<span>
									<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="others_can_use" id="others_can_use_label">
										<input type="radio" id="others_can_use" class="mdl-radio__button" name="roomPrivacy" value="0" >
										<span class="mdl-radio__label">
											Public
										</span>

									</label>
									<div class="mdl-tooltip" data-mdl-for="others_can_use_label">
									Others can<br> use room
									</div>

								</span>
								
							</span>
						</section>
						<br>
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