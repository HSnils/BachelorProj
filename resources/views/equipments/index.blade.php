@extends('partials.template')

@section('content')

<div class="mdl-typography--display-4 mdl-color-text--grey-600 flex100">
	EQUIPMENT
</div>
	
	<div class="contentWrapper">
		<div class="sortingOpen"><b>Sort:</b> <i class="material-icons">sort</i></div>
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp  ">
			<thead class="">
				<tr class=" ">
					<th class="mdl-data-table__cell--non-numeric">Name</th>
					<th class="mdl-data-table__cell--non-numeric">Type</th>
					<th class="mdl-data-table__cell--non-numeric">Location</th>
					<th class="mdl-data-table__cell--non-numeric">Description</th>
				</tr>
			</thead>
			<tbody class="">
				@foreach ($allEquipments as $equipment)
					<tr class="">
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->name}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->type}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->location}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$equipment->desc}}</td>
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
					<span class="materialLabel marginTop1 marginBottom1">Sort by room</span>
					<select class="formPadding flex100 width100" name="room_number" id="room_numberBooking">
						<option disabled selected>Select a room</option>
						@foreach($allRooms as $room)
							<option value="{{$room->room_number}}">{{$room->room_number}}</option>
						@endforeach
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
@endsection