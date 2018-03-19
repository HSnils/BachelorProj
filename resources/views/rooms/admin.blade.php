@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-4 mdl-color-text--grey-600 flex100">
		ROOMS
	</div>

	<br>

	<div class="relative">
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp ">
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
					<td class="mdl-data-table__cell--non-numeric">{{$room->type}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$room->building}}</td>
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
@endsection