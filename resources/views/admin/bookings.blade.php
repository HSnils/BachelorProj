@extends('partials.template')

@section('content')
	
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
    	BOOKINGS 
	</div>

	<div class="relative contentWrapper">
		<div class="sortingOpen"><b>Filter:</b> <i class="material-icons">filter_list</i></div>
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp " id="bookingsTable">
			<thead class="">
				<tr class=" ">
					<th onclick="sortTable(0, this)" class="mdl-data-table__cell--non-numeric th ">Type</th>
					<th onclick="sortTable(1, this)" class="mdl-data-table__cell--non-numeric th">Name</th>
					<th onclick="sortTable(2, this)" class="mdl-data-table__cell--non-numeric th ">Start date</th>
					<th onclick="sortTable(3, this)" class="mdl-data-table__cell--non-numeric th mdl-data-table__header--sorted-descending">End date</th>
					<th onclick="sortTable(4, this)" class="mdl-data-table__cell--non-numeric th ">User</th>
					<th onclick="sortTable(5, this)" class="mdl-data-table__cell--non-numeric th ">Used for</th>
					<th class="mdl-data-table__cell--non-numeric">Edit</th>
				</tr>
			</thead>
			<tbody class="">
				@foreach ($allBookings as $booking	)
						
					@php
						$name = '';
						if($booking->type == 'Room'){
							$name = $booking->bookingRoom->room_number;
						} else if($booking->type == 'Equipment'){
							$name = $booking->getEquipmentName($booking->bookingEquipment->equipment_id);
						}
						
					@endphp
					<tr class="">
						<td class="mdl-data-table__cell--non-numeric">{{$booking->type}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$name}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$booking->from_date}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$booking->to_date}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$booking->user->name}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$booking->category}}</td>
						<td class="mdl-data-table__cell--non-numeric " >
							<a href="{{ url('admin/bookings/edit') }}/{{$booking->id}}" ><i class="material-icons mdl-button--primary">edit</i></a>
						</td>
					</tr>
				@endforeach
			</tbody>	
		</table>
		<div class="paginateLinks">
			{{$allBookings->links()}}
		</div>
		<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored knappis {{$allBookings->hasMorePages() ? 'equipmentAdd' : ''}} mdl-shadow--2dp">
			<i class="material-icons">add</i>
		</button>
	</div>
	
	<!--Sorting -->
	<dialog class="mdl-dialog">
		<div class="mdl-dialog__content">
			<div><i class="material-icons sortingClose">clear</i></div>
			<div id="sortingBox">
				<form action="">
					

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="name" name="name">
						<label class="mdl-textfield__label" for="sample3">Filter by name...</label>
					</div>

					<span class="materialLabel marginTop1 marginBottom1">Filter by lockdown state</span>
					<select class="formPadding flex100 width100" name="lockdown" id="lockdown">
						<option disabled selected="">Select lockdownstate</option>
						<option value="0">0</option>
						<option value="1">1</option>
					</select> 

			</div>
		</div>
		<div class="mdl-dialog__actions mdl-dialog__actions--full-width">
			<button type="submit" class="mdl-button">Filter</button>
			</form>
		</div>
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
		$('.knappis').click(function(){
			document.location.href="{{route('newEquipment')}}";
			
		});
	</script>

	<script>
		function sortTable(n, thisHeader) {
			$('.th').removeClass('mdl-data-table__header--sorted-descending mdl-data-table__header--sorted-ascending');
			var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
			table = document.getElementById("bookingsTable");
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