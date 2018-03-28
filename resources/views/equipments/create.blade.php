@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-4 mdl-color-text--grey-600 flex100">
		CREATE A NEW EQUIPMENT
	</div>
	<br>

	<div class="">
		<form role="form" method="POST" action="{{ url('admin/equipments/create') }}" class="formStyle">
			{{ csrf_field() }}

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="name" name="name">
				<label class="mdl-textfield__label" for="name">Name...</label>
				<span class="mdl-textfield__error"></span>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="type" name="type">
				<label class="mdl-textfield__label" for="type">Type...</label>
				<span class="mdl-textfield__error"></span>
			</div>

			<label class="materialLabel" for="location">Location</label>
			<select name="location" id="location" class="formPadding">
				<option value="" disabled>Select location</option>
				@foreach($allRooms as $room)
					<option value="{{$room->room_number}}">{{$room->room_number}}</option>
				@endforeach	
			</select>

			<div class="mdl-tooltip" data-mdl-for="location">
				Select location of equipment
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<textarea class="mdl-textfield__input" type="text" rows= "3" id="desc" name="desc" ></textarea>
				<label class="mdl-textfield__label" for="desc">Description...</label>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="ntnu_id" name="ntnu_id" disabled>
				<label class="mdl-textfield__label" for="ntnu_id">NTNU ID... (disabled)</label>
				<span class="mdl-textfield__error"></span>
			</div>
			
			<label class="materialLabel" for="lockdown">Lockdown</label>
			<select name="lockdown" id="lockdown" class="formPadding">
				<option value="" disabled="">Select lockdown state</option>
				<option value="0" selected="">No</option>
				<option value="1">Yes</option>
			</select>
						<!-- Simple Tooltip -->

			<div class="mdl-tooltip" data-mdl-for="lockdown">
				Select lockdown state
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<textarea class="mdl-textfield__input" type="text" rows= "3" id="other_documentation" name="other_documentation" ></textarea>
				<label class="mdl-textfield__label" for="other_documentation">Other Documentation...</label>
			</div>

			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" style="float:right">
				Create
			</button>

		</form>

		@include('partials.errors')
	</div>
	
@endsection