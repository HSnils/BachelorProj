<section class="flex100 width100 myBookingsBox marginBottom1">
	<hr>
	<div class="mdl-typography--display-1-color-contrast">
		My bookings 
	</div>
	
	<!--If user is student, show status explaination -->
	@if(Auth::user()->role == 'Student')
		<div>
			<div class="inline">
				<div class="cirlceStatus blueCircle inline"></div> <span class="inline"> = Active booking</span>
			</div>
			<div class="inline">
				<div class="cirlceStatus orangeCircle inline"></div> <span class="inline"> = Pending booking</span>
			</div>
		</div>
	@endif

	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp flex100 overflowOnMobile">
		<thead class="" >
			<tr class="">
				@if(Auth::user()->role == 'Student')
					<th class="mdl-data-table__cell--non-numeric">Status</th>
				@endif
				<th class="mdl-data-table__cell--non-numeric hideOnMobile">Type</th>
				<th class="mdl-data-table__cell--non-numeric">Name</th>
				<th class="">Time From</th>
				<th class="hideOnMobile">Time To</th>
				<th class="mdl-data-table__cell--non-numeric hideOnMobile">Location</th>
				<th class="mdl-data-table__cell--non-numeric">Delete</th>
			</tr>
		</thead>
		<tbody class="">
			
			@foreach($yourBookings as $booking)

				<tr>
					@if(Auth::user()->role == 'Student')
						<td class="mdl-data-table__cell--non-numeric">
							
							@if($booking->status == "Pending")
								<div class="cirlceStatus orangeCircle" id="bookingStatusFor{{ $booking->id}}"></div>
								<div class="mdl-tooltip" data-mdl-for="bookingStatusFor{{ $booking->id}}">
									Pending booking
								</div>
							@elseif($booking->status == "Active")
								<div class="cirlceStatus blueCircle" id="bookingStatusFor{{ $booking->id}}"></div>
								<div class="mdl-tooltip" data-mdl-for="bookingStatusFor{{ $booking->id}}">
									Active booking
								</div>							
							@endif
						</td>
					@endif
					<td class="mdl-data-table__cell--non-numeric hideOnMobile">
						{{$booking->type}}
						
						<!--Prints private or public privacy -->
						@if(($booking->type == "Room") && ($booking->bookingRoom->private == 0))
							- <span class="size09em">Public</span>
						@elseif($booking->type == "Room")
							- <span class="size09em">Private</span>
						@endif
					</td>
					
					<td class="mdl-data-table__cell--non-numeric">
						@if($booking->type == 'Room')
							{{$booking->bookingRoom->room_number}}
							
						@elseif($booking->type == 'Equipment')
							{{$booking->getEquipmentName($booking->bookingEquipment->equipment_id)}}
						@endif
					</td>

					<td>{{date("D d-M. H:i", strtotime($booking->from_date))}}</td>
					<td class="hideOnMobile">{{date("D d-M. H:i", strtotime($booking->to_date))}}</td>
					
					<!--location-->
					<td class="mdl-data-table__cell--non-numeric hideOnMobile">
					@if($booking->type == 'Room')
						{{$booking->bookingRoom->room_number}}
					@elseif($booking->type == 'Equipment')
						{{$booking->getEquipmentLocation($booking->bookingEquipment->equipment_id)}}
					@endif
					</td>

					<td class="mdl-data-table__cell--non-numeric">
						<form action="{{url('bookings/delete')}}/{{$booking->id}}" method="post">
							@method('delete')
							@csrf
							<button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--accent deleteBookingButton">
								<i class="material-icons removeX">clear</i>
							</button>
						</form>
					</td>
				</tr>

			@endforeach	
		</tbody>	
	</table>
	<div>{{$yourBookings->links()}}</div>

</section>