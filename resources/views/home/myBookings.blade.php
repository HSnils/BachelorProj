<section class="flex100 width100 myBookingsBox marginBottom1">
	<hr>
	<div class="mdl-typography--display-1-color-contrast flex100">
		My bookings
	</div>

	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp flex100">
		<thead class="" >
			<tr class="">
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
					<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$booking->type}}
						
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
						<a href="{{url('bookings/delete')}}/{{$booking->id}}"><i class="material-icons removeX">clear</i></a>
					</td>
				</tr>

			@endforeach	
		</tbody>	
	</table>
	<div>{{$yourBookings->links()}}</div>

</section>