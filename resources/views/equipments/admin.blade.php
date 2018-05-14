@extends('partials.template')

@section('content')
	
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
    	EQUIPMENT 
	</div>

	<div class="relative contentWrapper">
		<div class="sortingOpen"><b>Filter:</b> <i class="material-icons">filter_list</i></div>
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp " id="equipmentTable">
			<thead class="">
				<tr class=" ">
					<th onclick="sortTable(0, this, 'equipmentTable')" class="mdl-data-table__cell--non-numeric th">Name</th>
					<th onclick="sortTable(1, this, 'equipmentTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Type</th>
					<th onclick="sortTable(2, this, 'equipmentTable')" class="mdl-data-table__cell--non-numeric th">Location</th>
					<th onclick="sortTable(3, this, 'equipmentTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Description</th>
					<th onclick="sortTable(4, this, 'equipmentTable')" class="th hideOnMobile">NTNU ID </th>
					<th onclick="sortTable(5, this, 'equipmentTable')" class="th hideOnMobile">Lockdown</th>
					<th onclick="sortTable(6, this, 'equipmentTable')" class="th hideOnMobile">Status</th>
					<th onclick="sortTable(7, this, 'equipmentTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Created</th>
					<th onclick="sortTable(8, this, 'equipmentTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Updated</th>
					<th class="mdl-data-table__cell--non-numeric">Edit</th>
				</tr>
			</thead>
			<tbody class="">
				@foreach ($allEquipments as $equipment)

					@php
						if(strlen($equipment->name) > 20){
							$nameText = substr($equipment->name, 0,20).'(...)';
						}else{
							$nameText = $equipment->name;
						}
					@endphp
					<tr class="">
						<td class="mdl-data-table__cell--non-numeric">{{$nameText}}</td>
						<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$equipment->type}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->location}}</td>
						<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{substr($equipment->desc, 0, 15)}}(...)</td>
						<td class="hideOnMobile">{{ $equipment->ntnu_id }}</td>
						<td class="hideOnMobile">{{$equipment->lockdown}}</td>
						<td class="hideOnMobile">{{$equipment->status}}</td>
						<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$equipment->created_at->diffForHumans()}}</td>
						<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$equipment->updated_at->diffForHumans()}}</td>
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
					<span class="materialLabel marginTop1 marginBottom1">Filter by room</span>
					<select class="formPadding flex100 width100" name="room_number" id="room_number">
						<option disabled selected="">Select a room</option>
						@foreach($allRooms as $room)
							<option value="{{$room->room_number}}">{{$room->room_number}}</option>
						@endforeach
					</select>

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="name" name="name">
						<label class="mdl-textfield__label" for="sample3">Filter by name...</label>
					</div>

					<span class="materialLabel marginTop1 marginBottom1">Filter by lockdown state</span>
					<select class="formPadding flex100 width100" name="lockdown" id="lockdown">
						<option disabled selected="">Select lockdownstate</option>
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