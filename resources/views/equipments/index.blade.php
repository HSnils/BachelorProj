@extends('partials.template')

@section('content')

	<div class="contentWrapper">
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
	EQUIPMENT
    </div>
		<div class="sortingOpen"><b>Filter:</b> <i class="material-icons">filter_list</i></div>
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" id="equipmentTable">
			<thead class="">
				<tr class="">
					<th onclick="sortTable(0, this, 'equipmentTable')" class="mdl-data-table__cell--non-numeric th">Name</th>
					<th onclick="sortTable(1, this,'equipmentTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Type</th>
					<th onclick="sortTable(2, this,'equipmentTable')" class="mdl-data-table__cell--non-numeric th">Location</th>
					<th onclick="sortTable(3, this,'equipmentTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Description</th>
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
					<tr class="clickable-row" data-href="{{url('equipments')}}/{{$equipment->id}}">
						<td class="mdl-data-table__cell--non-numeric">{{$nameText}}</td>
						<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$equipment->type}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->location}}</td>
						<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{substr($equipment->desc, 0, 25)}}(...)</td>
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

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="name" name="name">
						<label class="mdl-textfield__label" for="sample3">Filter by name...</label>
					</div>
					
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
	<script type="text/javascript" src="{{asset('js/sortTables.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/clickableTableRow.js')}}"></script>

@endsection