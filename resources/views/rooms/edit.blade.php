@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 page-content">
		EDIT ROOM {{$thisRoom[0]->room_number}}
	</div>
	<br>

	<div class="">
		<form role="form" method="POST" action="{{ url('admin/rooms/edit') }}" class="formStyle">
			{{ csrf_field() }}

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="room_number" name="room_number" value="{{$thisRoom[0]->room_number}}">
				<label class="mdl-textfield__label" for="room_number">Room Number...*</label>
				<span class="mdl-textfield__error"></span>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="type" name="type" value="{{$thisRoom[0]->type}}">
				<label class="mdl-textfield__label" for="type">Type...*</label>
				<span class="mdl-textfield__error"></span>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="building" name="building" value="{{$thisRoom[0]->building}}">
				<label class="mdl-textfield__label" for="building">Building...*</label>
				<span class="mdl-textfield__error"></span>
			</div>

			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" style="float:right">
				Update
			</button>
		</form>
		
		<!-- DELETE
		<br>
		<form action="{{ url('admin/rooms/delete') }}/{{$thisRoom[0]->room_number}}" method="post" class="formStyle marginTop1 marginTop1">
			@method('delete')
			@csrf
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent deleteRoomButton">
				<i class="material-icons removeX">delete</i> Delete
			</button>
		</form>-->

		<!--<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" style="float:right">
			Delete
		</button>-->

		@include('partials.errors')
	</div>
	
@endsection