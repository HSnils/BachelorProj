@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 page-content">
		CREATE NEW ROOM
	</div>
	<br>

	<div class="">
		<form role="form" method="POST" action="{{ url('admin/rooms/create') }}" class="formStyle">
			{{ csrf_field() }}

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="room_number" name="room_number">
				<label class="mdl-textfield__label" for="room_number">Room Number...</label>
				<span class="mdl-textfield__error"></span>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="type" name="type">
				<label class="mdl-textfield__label" for="type">Type...</label>
				<span class="mdl-textfield__error"></span>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="building" name="building">
				<label class="mdl-textfield__label" for="building">Building...</label>
				<span class="mdl-textfield__error"></span>
			</div>

			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" style="float:right">
				Create
			</button>

		</form>

		@include('partials.errors')
	</div>
	
@endsection