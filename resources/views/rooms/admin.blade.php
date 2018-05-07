@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
		ROOMS
	</div>

	<br>

	<div class="relative">
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp " id="roomsTable">
			<thead class="" >
				<tr class="">
					<th onclick="sortTable(0, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th">Room</th>
					<th onclick="sortTable(1, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th ">Type</th>
					<th onclick="sortTable(2, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Building</th>
					<th class="mdl-data-table__cell--non-numeric">Edit</th>
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
				<tr class="">
					<td class="mdl-data-table__cell--non-numeric">{{$room->room_number}}</td>
					<td class="mdl-data-table__cell--non-numeric ">{{$descText}}</td>
					<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$room->building}}</td>
					<td class="mdl-data-table__cell--non-numeric " >
						<a href="{{ url('admin/rooms/edit') }}/{{$room->room_number}}" ><i class="material-icons mdl-button--primary">edit</i></a>
					</td>
				</tr>
				@endforeach
			</tbody>	
		</table>
		<button class=" mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored knappis mdl-shadow--2dp">
			<i class="material-icons">add</i>
		</button>
	</div>
	
	<script>
		$('.knappis').click(function(){
			document.location.href="{{route('newRoom')}}";
			
		});
	</script>

	<script type="text/javascript" src="js/sortTables.js"></script>
@endsection