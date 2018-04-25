@extends('partials.template')
@section('content')

<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
	LOG/EQUIPMENTS
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--4-col">
	</div>
	@php
		$totalHoursSpent = 0;
		foreach($filteredBookings as $booking){
			$totalHoursSpent += $booking->hoursSpent();
		}
	@endphp
	<div class="mdl-cell mdl-cell--4-col">
		Total hours spent: <b>{{$totalHoursSpent}}</b>
	<br>
		Total bookings: <b>{{count($filteredBookings)}}</b>
	</div>
	<div class="mdl-cell mdl-cell--4-col">
		<a href="{{url()->current()}}/download?{{request()->getQueryString()}}">Download to CSV <i class="material-icons">file_download</i></a>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col contentWrapper">

	<div class="sortingOpen"><b>Filter:</b> <i class="material-icons">filter_list</i></div>
	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp " id="equipmentsTable">
		<thead class="" >
			<tr class="">
				<th onclick="sortTable(0, this)" class="mdl-data-table__cell--non-numeric th">Name</th>
				<th onclick="sortTable(1, this)" class="mdl-data-table__cell--non-numeric th">Type</th>
				<th onclick="sortTable(2, this)" class="mdl-data-table__cell--non-numeric th">Location</th>
				<th onclick="sortTable(3, this)" class="mdl-data-table__cell--non-numeric th">Start date</th>
				<th onclick="sortTable(4, this)" class="mdl-data-table__cell--non-numeric th">End date</th>
				<th onclick="sortTable(5, this)" class="mdl-data-table__cell--non-numeric th">User</th>
				<th onclick="sortTable(6, this)" class="mdl-data-table__cell--non-numeric th">Usage</th>
				<th onclick="sortTable(7, this)" class="mdl-data-table__cell--non-numeric th">Hours spent</th>
			</tr>
		</thead>
		<tbody class="">
			@foreach($filteredBookings as $booking)

				<tr>
					<td class="mdl-data-table__cell--non-numeric">{{$booking->name}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$booking->type}}</td>
					<td class="mdl-data-table__cell--non-numeric">
						<a href="{{url('admin/log/rooms')}}?room_number={{$booking->location}}">
							{{$booking->location}}
						</a>
					</td>
					<td class="mdl-data-table__cell--non-numeric">{{$booking->from_date}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$booking->to_date}}</td>
					<td class="mdl-data-table__cell--non-numeric">
						<a href="{{url('admin/log/users')}}?name={{$booking->user->name}}">
							{{$booking->user->name}}
						</a>
					</td>
					<td class="mdl-data-table__cell--non-numeric">
						<a href="{{url('admin/log/categories')}}?category={{$booking->category}}">
							{{$booking->category}}
						</a>
					</td>
					<!--If hour spent is more than 1.5 print 'hours' else print 'hour' -->
					<td class="mdl-data-table__cell--non-numeric">{{($booking->hoursSpent() > 1.5) ? $booking->hoursSpent().' hours' : $booking->hoursSpent().' hour' }} </td>
				</tr>
			@endforeach
		</tbody>	
	</table>
	<div class="paginateLinks">
			{{$filteredBookings->links()}}
		</div>
	</div>
</div>




<!--Sorting -->
	<dialog class="mdl-dialog">
		<form action="">
		<div class="mdl-dialog__content">
			<div><i class="material-icons sortingClose">clear</i></div>

			<div id="sortingBox">
				
					<span class="materialLabel marginTop1 marginBottom1">Filter by location</span>
					<select class="formPadding flex100 width100" name="room_number" id="room_numberBooking">
						<option disabled selected>Select a room</option>
						@foreach($allRooms as $room)
							<option value="{{$room->room_number}}">{{$room->room_number}}</option>
						@endforeach
					</select>

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="name" name="name">
						<label class="mdl-textfield__label" for="sample3">Filter by name...</label>
					</div>
					
					<span class="materialLabel marginTop1 marginBottom1">Filter by start and end date</span><hr>
					<label for="dateFrom" class="materialLabel ">Start date</label>
					<br>
					<input type="date" name="dateFrom" id="dateFrom" class="formPadding marginTop1 " >

					<div class="mdl-tooltip" data-mdl-for="dateFrom">
						Select starting date
					</div>
					<br>
					<label for="dateTo" class="materialLabel ">End date</label>
					<br>
					<input type="date" name="dateTo" id="dateTo" class="formPadding marginTop1 ">
					
					<div class="mdl-tooltip" data-mdl-for="dateTo">
						Select ending date
					</div>
			</div>
		</div>
		<div class="mdl-dialog__actions mdl-dialog__actions--full-width">
			<button type="submit" class="mdl-button">Filter</button>
			
		</div>
		</form>
	</dialog>
	<script>
	var dialog = document.querySelector('dialog');
	if (! dialog.showModal) {
		dialogPolyfill.registerDialog(dialog);
	}
	$('.sortingOpen').click( function() {
		dialog.showModal();
	});
	$('.sortingClose').click( function() {
		dialog.close();
	});
	</script>
	<script>
		function sortTable(n, thisHeader) {
			$('.th').removeClass('mdl-data-table__header--sorted-descending mdl-data-table__header--sorted-ascending');
			var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
			table = document.getElementById("equipmentsTable");
			switching = true;
			// Set the sorting direction to ascending:
			dir = "asc"; 
			/* Make a loop that will continue until
			no switching has been done: */
			while (switching) {
				// Start by saying: no switching is done:
				switching = false;
				rows = table.getElementsByTagName("TR");
				/* Loop through all table rows (except the
				first, which contains table headers): */
				for (i = 1; i < (rows.length - 1); i++) {
					// Start by saying there should be no switching:
					shouldSwitch = false;
					/* Get the two elements you want to compare,
					one from current row and one from the next: */
					x = rows[i].getElementsByTagName("TD")[n];
					y = rows[i + 1].getElementsByTagName("TD")[n];
					/* Check if the two rows should switch place,
					based on the direction, asc or desc: */
					if (dir == "asc") {

						if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
							// If so, mark as a switch and break the loop:
							shouldSwitch= true;
							break;
						}
					} else if (dir == "desc") {
						if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
							// If so, mark as a switch and break the loop:
							shouldSwitch= true;
							break;
						}
					}
				}
				if (shouldSwitch) {
					/* If a switch has been marked, make the switch
					and mark that a switch has been done: */
					rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
					switching = true;
					// Each time a switch is done, increase this count by 1:
					
					switchcount ++; 

					//gives class to the header
					thisHeader.className += ' mdl-data-table__header--sorted-ascending';
				} else {
					/* If no switching has been done AND the direction is "asc",
					set the direction to "desc" and run the while loop again. */
					if (switchcount == 0 && dir == "asc") {
						dir = "desc";
						switching = true;

						//gives class to the header
						thisHeader.className += ' mdl-data-table__header--sorted-descending';
					}
				}
			}
		}
	</script>
	

@endsection