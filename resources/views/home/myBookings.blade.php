<section class="flex100 width100 myBookingsBox">
	<hr>
	<div class="mdl-typography--display-1-color-contrast flex100">
		My bookings
	</div>

	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp flex100">
		<thead class="" >
			<tr class="">
				<th class="mdl-data-table__cell--non-numeric">Type</th>
				<th class="mdl-data-table__cell--non-numeric">Name</th>
				<th class="">Time From</th>
				<th class="">Time To</th>
				<th class="mdl-data-table__cell--non-numeric">Location</th>
			</tr>
		</thead>
		<tbody class="">

			@foreach($yourBookings as $booking)

				<tr>
					<td class="mdl-data-table__cell--non-numeric">{{$booking->type}}
							@if(($booking->type == "Room") && ($booking->bookingRoom->private == 0))
								 - <span style="font-size:0.9em;">Public</span>
							@elseif($booking->type == "Room")
								 - <span style="font-size:0.9em;">Private</span>
							@endif
					</td>
					
					<td class="mdl-data-table__cell--non-numeric">
						@if($booking->type == 'Room')
							{{$booking->bookingRoom->room_number}}
							
						@elseif($booking->type == 'Equipment')
							@foreach($yourEquipments as $equipment)
								@if($booking->bookingEquipment->bookings_id == $equipment->bookingsEquipmentBookingID)
									{{$equipment->equipmentName}}
								@endif
							@endforeach
						@endif
					</td>

					<td>{{date("D d-M. H:i", strtotime($booking->from_date))}}</td>
					<td>{{date("D d-M. H:i", strtotime($booking->to_date))}}</td>
					<td class="mdl-data-table__cell--non-numeric">
					@if($booking->type == 'Room')
						{{$booking->bookingRoom->room_number}}
					@elseif($booking->type == 'Equipment')
						@foreach($yourEquipments as $equipment)
							@if($booking->bookingEquipment->bookings_id == $equipment->bookingsEquipmentBookingID)
								{{$equipment->location}}
							@endif
						@endforeach
					@endif
					</td>
				</tr>

			@endforeach	
		</tbody>	
	</table>

</section>