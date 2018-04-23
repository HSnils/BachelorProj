@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
		ROOMS
	</div>
	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp " id="roomsTable">
		<thead class="" >
			<tr class="">
				<th onclick="sortTable(0, this)" class="mdl-data-table__cell--non-numeric th">Room</th>
				<th onclick="sortTable(1, this)" class="mdl-data-table__cell--non-numeric th">Type</th>
				<th onclick="sortTable(2, this)" class="mdl-data-table__cell--non-numeric th hideOnMobile">Building</th>
			</tr>
		</thead>
		<tbody class="">
			@foreach ($allRooms as $room)
			<tr class="">
				<td class="mdl-data-table__cell--non-numeric">{{$room->room_number}}</td>
				<td class="mdl-data-table__cell--non-numeric"class="mdl-data-table__cell--non-numeric">{{$room->type}}</td>
				<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$room->building}}</td>
			</tr>
			@endforeach
		</tbody>	
	</table>

	<script>
		function sortTable(n, thisHeader) {
			$('.th').removeClass('mdl-data-table__header--sorted-descending mdl-data-table__header--sorted-ascending');
			var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
			table = document.getElementById("roomsTable");
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