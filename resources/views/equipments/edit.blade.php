@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 page-content">
		EDIT EQUIPMENT: {{$thisEquipment[0]->name}}
	</div>
	<br>

	<div class="">
		<form role="form" method="POST" action="{{ url('admin/equipments/edit') }}/{{$thisEquipment[0]->id}}" class="formStyle">
			{{ csrf_field() }}

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="name" name="name" value="{{$thisEquipment[0]->name}}">
				<label class="mdl-textfield__label" for="name">Name...</label>
				<span class="mdl-textfield__error"></span>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="type" name="type" value="{{$thisEquipment[0]->type}}">
				<label class="mdl-textfield__label" for="type">Type...</label>
				<span class="mdl-textfield__error"></span>
			</div>
			
			<label class="materialLabel" for="location">Location</label>
			<select name="location" id="location" class="formPadding">
				<option value="" disabled>Select location</option>
				@foreach($allRooms as $room)
					@if($thisEquipment[0]->location == $room->room_number)
						<option value="{{$room->room_number}}" selected="">{{$room->room_number}}</option>
					@else
						<option value="{{$room->room_number}}">{{$room->room_number}}</option>
					@endif
				@endforeach	
			</select>

			<div class="mdl-tooltip" data-mdl-for="location">
				Select location of equipment
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<textarea class="mdl-textfield__input" type="text" rows= "3" id="desc" name="desc" >{{$thisEquipment[0]->desc}}</textarea>
				<label class="mdl-textfield__label" for="desc">Description...</label>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="ntnu_id" name="ntnu_id" value="{{$thisEquipment[0]->ntnu_id}}">
				<label class="mdl-textfield__label" for="ntnu_id">NTNU ID...</label>
				<span class="mdl-textfield__error"></span>
			</div>

			
			<label class="materialLabel" for="lockdown">Lockdown</label>
			<select name="lockdown" id="lockdown" class="formPadding">

				<option value="" disabled>Select lockdown state</option>
				@if($thisEquipment[0]->lockdown == 0)
					<option value="0" selected>No</option>
					<option value="1" >Yes</option>
				@else
					<option value="0">No</option>
					<option value="1" selected>Yes</option>
				@endif

			</select>

			<div class="mdl-tooltip" data-mdl-for="lockdown">
				Select lockdownstate
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<textarea class="mdl-textfield__input" type="text" rows= "3" id="other_documentation" name="other_documentation">{{$thisEquipment[0]->other_documentation}}</textarea>
				<label class="mdl-textfield__label" for="other_documentation">Other Documentation...</label>
			</div>

			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" style="float:right">
				Update
			</button>

		</form>

		@include('partials.errors')
	</div>
	
@endsection