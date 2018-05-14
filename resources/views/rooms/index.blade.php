@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
		ROOMS
	</div>
	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp " id="roomsTable">
		<thead class="" >
			<tr>
				<th onclick="sortTable(0, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th">Room</th>
				<th onclick="sortTable(1, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th">Type</th>
				<th onclick="sortTable(2, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Building</th>
			</tr>
		</thead>
		<tbody class="">
			@foreach ($allRooms as $room)
			@php
				if(strlen($room->type) > 20){
					$descText = substr($room->type, 0,20).'(...)';
				}else{
					$descText = $room->type;
				}
			@endphp

			<tr class="clickable-row" data-href="{{url('rooms')}}/{{$room->room_number}}">
				<td class="mdl-data-table__cell--non-numeric">{{$room->room_number}}</td>
				<td class="mdl-data-table__cell--non-numeric">{{$descText}}</td>
				<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$room->building}}</td>
			</tr>
			@endforeach
		</tbody>	
	</table>

	<script type="text/javascript" src="{{asset('js/sortTables.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/clickableTableRow.js')}}"></script>
@endsection