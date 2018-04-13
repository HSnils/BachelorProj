@extends('partials.template')

@section('content')
	
	<div class="mdl-typography--display-4 mdl-color-text--grey-600 flex100">
    	EQUIPMENT 
	</div>

	<div class="relative contentWrapper">
		<div class="sortingOpen"><b>Sort:</b> <i class="material-icons">sort</i></div>
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp ">
			<thead class="">
				<tr class=" ">
					<th class="mdl-data-table__cell--non-numeric">Name</th>
					<th class="mdl-data-table__cell--non-numeric">Type</th>
					<th class="mdl-data-table__cell--non-numeric">Location</th>
					<th class="mdl-data-table__cell--non-numeric">Description</th>
					<th>NTNU ID </th>
					<th>Lockdown</th>
					<th>Status</th>
					<th class="mdl-data-table__cell--non-numeric">Created</th>
					<th class="mdl-data-table__cell--non-numeric">Updated</th>
					<th class="mdl-data-table__cell--non-numeric">Edit</th>
				</tr>
			</thead>
			<tbody class="">
				@foreach ($allEquipments as $equipment)
					<tr class="">
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->name}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->type}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->location}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->desc}}</td>
						<td>{{ $equipment->ntnu_id }}</td>
						<td >{{$equipment->lockdown}}</td>
						<td >{{$equipment->status}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->created_at->diffForHumans()}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->updated_at->diffForHumans()}}</td>
						<td class="mdl-data-table__cell--non-numeric " >
							<a href="{{ url('admin/equipments/edit') }}/{{$equipment->id}}" ><i class="material-icons mdl-button--primary">edit</i></a>
						</td>
					</tr>
				@endforeach
			</tbody>	
		</table>
		<div class="paginateLinks">
			{{$allEquipments->links()}}
		</div>
		<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored knappis {{$allEquipments->hasMorePages() ? 'equipmentAdd' : ''}} mdl-shadow--2dp">
			<i class="material-icons">add</i>
		</button>
	</div>
	
	<!--Sorting -->
	<dialog class="mdl-dialog">
		<div class="mdl-dialog__content">
			<div><i class="material-icons sortingClose">clear</i></div>
			<div id="sortingBox">
				<form action="">
					<span class="materialLabel marginTop1 marginBottom1">Sort by room</span>
					<select class="formPadding flex100 width100" name="room_number" id="room_number">
						<option disabled>Select a room</option>
						@foreach($allRooms as $room)
							<option value="{{$room->room_number}}">{{$room->room_number}}</option>
						@endforeach
					</select>

					<span class="materialLabel marginTop1 marginBottom1">Sort by lockdown state</span>
					<select class="formPadding flex100 width100" name="lockdown" id="lockdown">
						<option disabled>Select lockdownstate</option>
						<option value="0">0</option>
						<option value="1">1</option>
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
			<button type="submit" class="mdl-button">Sort</button>
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
@endsection