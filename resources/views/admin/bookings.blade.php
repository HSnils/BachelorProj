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
					<th onclick="sortTable(0, this, 'bookingsTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Type</th>
					<th onclick="sortTable(1, this, 'bookingsTable')" class="mdl-data-table__cell--non-numeric th">Name</th>
					<th onclick="sortTable(2, this, 'bookingsTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Start date</th>
					<th onclick="sortTable(3, this, 'bookingsTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile mdl-data-table__header--sorted-descending">End date</th>
					<th onclick="sortTable(4, this, 'bookingsTable')" class="mdl-data-table__cell--non-numeric th ">User</th>
					<th onclick="sortTable(5, this, 'bookingsTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Used for</th>
					<!-- <th class="mdl-data-table__cell--non-numeric">Edit</th>	--> 
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
						<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$booking->type}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$name}}</td>
						<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$booking->from_date}}</td>
						<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$booking->to_date}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$booking->user->name}}</td>
						<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$booking->category}}</td>
						<!--
						<td class="mdl-data-table__cell--non-numeric " >
							<a href="{{ url('admin/bookings/edit') }}/{{$booking->id}}" ><i class="material-icons mdl-button--primary">edit</i></a>
						</td>
					</tr>
					--> 
				@endforeach
			</tbody>	
		</table>
		<div class="paginateLinks">
			{{$allBookings->links()}}
		</div>
		<!--
		<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored knappis {{$allBookings->hasMorePages() ? 'equipmentAdd' : ''}} mdl-shadow--2dp">
			<i class="material-icons">add</i> 	 
		</button>
	</div>
	-->
	<!--Sorting -->
	<dialog class="mdl-dialog">
		<div class="mdl-dialog__content">
			<div><i class="material-icons sortingClose">clear</i></div>
			<div id="sortingBox">
				<form action="">
					
					<span class="materialLabel marginTop1 marginBottom1">Filter by type</span>
					<select class="formPadding flex100 width100 marginBottom1" name="type" id="type">
						<option disabled selected>Select a type</option>
						<option value="Room">Room</option>
						<option value="Equipment">Equipment</option>
					</select>

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

	<script type="text/javascript" src="{{asset('js/sortTables.js')}}"></script>
@endsection