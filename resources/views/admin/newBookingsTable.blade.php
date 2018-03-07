<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp ">
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
							{{$booking->room_number}}
						</td >
						<td class="mdl-data-table__cell--non-numeric">
							{{$booking->name}}
						</td>
						<td>
							{{$booking->from_date}}
						</td>
						<td>
							{{$booking->to_date}}
						</td>
						<td class="mdl-data-table__cell--non-numeric">
							<a href="#"><i class="material-icons">done</i></a>
						</td>
						<td class="mdl-data-table__cell--non-numeric">
							<a href="#"><i class="material-icons">clear</i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>