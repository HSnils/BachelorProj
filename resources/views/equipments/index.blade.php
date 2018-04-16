@extends('partials.template')

@section('content')

	<div class="contentWrapper">
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
	EQUIPMENT
    </div>
		<div class="sortingOpen"><b>Filter:</b> <i class="material-icons">filter_list</i></div>
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" id="equipmentTable">
			<thead class="">
				<tr class=" ">
					<th onclick="sortTable(0, this)" class="mdl-data-table__cell--non-numeric th">Name</th>
					<th onclick="sortTable(1, this)" class="mdl-data-table__cell--non-numeric th">Type</th>
					<th onclick="sortTable(2, this)" class="mdl-data-table__cell--non-numeric th">Location</th>
					<th onclick="sortTable(3, this)" class="mdl-data-table__cell--non-numeric th">Description</th>
				</tr>
			</thead>
			<tbody class="">
				@foreach ($allEquipments as $equipment)
					<tr class="">
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->name}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->type}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->location}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->desc}}</td>
					</tr>
				@endforeach
			</tbody>	
		</table>
		
		<div class="paginateLinks">
			{{$allEquipments->links()}}
		</div>
	</div>
	
	<!--Sorting -->
	<dialog class="mdl-dialog">
		<div class="mdl-dialog__content">
			<div><i class="material-icons sortingClose">clear</i></div>
			<div id="sortingBox">
				<form action="">
					<span class="materialLabel marginTop1 marginBottom1">Filter by room</span>
					<select class="formPadding flex100 width100" name="room_number" id="room_numberBooking">
						<option disabled selected>Select a room</option>
						@foreach($allRooms as $room)
							<option value="{{$room->room_number}}">{{$room->room_number}}</option>
						@endforeach
					</select>
					
					<!--<span class="materialLabel marginTop1 marginBottom1">and/or search by name:</span>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
						<label class="mdl-button mdl-js-button mdl-button--icon" for="sample6">
							<i class="material-icons">search</i>
						</label>
						<div class="mdl-textfield__expandable-holder">
							<input class="mdl-textfield__input" type="text" id="sample6" placeholder="Search..">
							<label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
						</div>
					</div>-->
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
		function sortTable(n, thisHeader) {
			$('.th').removeClass('mdl-data-table__header--sorted-descending mdl-data-table__header--sorted-ascending');
			var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
			table = document.getElementById("equipmentTable");
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