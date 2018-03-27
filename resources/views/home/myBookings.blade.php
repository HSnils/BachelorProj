<section class="flex100 width100">
	<h1 class="">My Upcomming Bookings</h1>

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
					<td class="mdl-data-table__cell--non-numeric">{{$booking->type}}</td>
					
					<td class="mdl-data-table__cell--non-numeric">
						@if($booking->type == 'Room')
							{{$booking->bookingRoom->room_number}}
						@elseif($booking->type == 'Equipment')
							{{$booking->bookingEquipment->equipment_id}}
						@endif
					</td>

					<td>{{date("d-m-Y H:i",strtotime($booking->from_date))}}</td>
					<td>{{date("d-m-Y H:i",strtotime($booking->to_date))}}</td>
					
					<td class="mdl-data-table__cell--non-numeric">
					@if($booking->type == 'Room')
						{{$booking->bookingRoom->room_number}}
					@elseif($booking->type == 'Equipment')
						Not working yet
					@endif
					</td>
				</tr>

			@endforeach	
		</tbody>	
	</table>

</section>