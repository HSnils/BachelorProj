@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-4 mdl-color-text--grey-600">
		ROOMS
	</div>

	<br>

	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp flex100">
		<thead class="" >
			<tr class="">
				<th class="mdl-data-table__cell--non-numeric">Room</th>
				<th class="mdl-data-table__cell--non-numeric">Type</th>
				<th class="mdl-data-table__cell--non-numeric">Building</th>
				<th class="mdl-data-table__cell--non-numeric">Edit</th>
			</tr>
		</thead>
		<tbody class="">
			@foreach ($allRooms as $room)
			<tr class="">
				<td class="mdl-data-table__cell--non-numeric">{{$room->room_number}}</td>
				<td class="mdl-data-table__cell--non-numeric"class="mdl-data-table__cell--non-numeric">{{$room->type}}</td>
				<td class="mdl-data-table__cell--non-numeric">{{$room->building}}</td>
				<td class="mdl-data-table__cell--non-numeric mdl-button--primary" >
					<i class="material-icons">edit</i>
				</td>
			</tr>
			@endforeach
		</tbody>	
	</table>

	<!-- Colored FAB button with ripple -->
	<button class="roundButton mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
		<i class="material-icons">add</i>
	</button>
@endsection