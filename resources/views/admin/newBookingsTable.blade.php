<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp overflowOnMobile">
	<thead>
		<tr>
			<th class="mdl-data-table__cell--non-numeric">Type</th>
			<th class="mdl-data-table__cell--non-numeric">Name</th>
			<th class="mdl-data-table__cell--non-numeric">User</th>
			<th>From</th>
			<th>To</th>
			<th class="mdl-data-table__cell--non-numeric">Accept</th>
			<th class="mdl-data-table__cell--non-numeric">Reject</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($newBookings as $booking)
			<tr>
				<td>
					{{$booking->type}}
				</td>
				
				<td class="mdl-data-table__cell--non-numeric">

					@if( $booking->type == "Room")
						{{$booking->room}}

					@elseif( $booking->type == "Equipment")
						{{$booking->getEquipmentName($booking->bookingEquipment->equipment_id)}}

					@endif

				</td>

				<td class="mdl-data-table__cell--non-numeric">				
					{{$booking->userName}}
				</td>
				
				<td>
					{{date("D d-M. H:i", strtotime($booking->from_date))}}
				</td>

				<td>
					{{date("D d-M. H:i", strtotime($booking->to_date))}}
				</td>

				<td class="mdl-data-table__cell--non-numeric">
					<a href="{{ url('admin/bookings/accept') }}/{{$booking->bookingID}}" class="approveBookingButton"><i class="material-icons mdl-button--primary">done</i></a>
				</td>
				<td class="mdl-data-table__cell--non-numeric">
					<form action="{{ url('admin/bookings/delete') }}/{{$booking->bookingID}}" method="post">
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
