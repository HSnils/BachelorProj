@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-4 mdl-color-text--grey-600 flex100">
		ROOMS
	</div>

	<br>

	<table class="mdl-card mdl-shadow--4dp flex100">
		<thead class="width100">
			<td>Room</td>
			<td>Type</td>
			<td>Building</td>
		</thead>
		<tbody class="width100">
			@foreach ($allRooms as $room)
			<tr>
				<td >{{$room->room_number}}</td>
				<td >{{$room->type}}</td>
				<td >{{$room->building}}</td>
			</tr>
			@endforeach
		</tbody>	
	</table>
@endsection