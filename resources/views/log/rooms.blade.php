@extends('partials.template')
@section('content')

<!-- Shows the most used room and how many hours it was used last month aswell as a cakechart with the top 4 rooms this month and how many times they were booked (disabled/commented out as of now because not sure if needed)

<div>Room <b>{{$topRoomThisMonth[0]->room_number}}</b> was used {{$hoursTopRoom}} hours in the past month<span>

</span></div>
<div id="donutchart" style="width: 450px; height: 250px;"></div>
	<script type="text/javascript">
		new Morris.Donut({
			// ID of the element in which to draw the chart.
			element: 'donutchart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: [
				@foreach($topRoomsThisMonth as $room)
				{ label: '{{$room->room_number}}', value: '{{$room->count}}' },
				@endforeach
			],
			
			colors: [ 
				"#552988",
				"#663E93",
				"#76539F",
				"#8869AB",
				"#997EB7",
				"#AA94C3",
				"#BBA9CF",
				"#CCBEDB"
			]
		
		});
	</script>
-->
<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
	LOG/ROOMS
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
	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp overflowOnMobile" id="roomsTable">
		<thead class="" >
			<tr class="">
				<th onclick="sortTable(0, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th">Room</th>
				<th onclick="sortTable(1, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th">Start date</th>
				<th onclick="sortTable(2, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th">End date</th>
				<th onclick="sortTable(3, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th">User</th>
				<th onclick="sortTable(4, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th">Usage</th>
				<th onclick="sortTable(5, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th">Hours spent</th>
			</tr>
		</thead>
		<tbody class="">
			@foreach($filteredBookings as $booking)

				<tr>
					<td class="mdl-data-table__cell--non-numeric">{{$booking->room_number}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$booking->from_date}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$booking->to_date}}</td>
					<td class="mdl-data-table__cell--non-numeric"><a href="{{url('admin/log/users')}}?name={{$booking->user->name}}">{{$booking->user->name}}</a></td>
					<td class="mdl-data-table__cell--non-numeric"><a href="{{url('admin/log/categories')}}?category={{$booking->category}}">{{$booking->category}}</a></td>
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
				
					<span class="materialLabel marginTop1 marginBottom1">Filter by room</span>
					<select class="formPadding flex100 width100 marginBottom1" name="room_number" id="room_numberBooking">
						<option disabled selected>Select a room</option>
						@foreach($allRooms as $room)
							<option value="{{$room->room_number}}">{{$room->room_number}}</option>
						@endforeach
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
	<script type="text/javascript" src="{{asset('js/sortTables.js')}}"></script>
@endsection