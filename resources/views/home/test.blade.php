@extends('partials.template')

@section('content')

	<h1 class="flex100">
	@if($checkRoomAvalibility == 0)
		Room is avalible 
	@else
		Room is allready booked
	@endif
	</h1>
	
	<h1 class="flex100">Number of equipments you are trying to book: {{$numberOfEquipments}}</h1>
	<br>
	<br>
	<br>
	<h1>{{print_r($allInputs)}}</h1>
	

@endsection