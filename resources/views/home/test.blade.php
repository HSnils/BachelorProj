@extends('partials.template')

@section('content')

	<h1>{{$checkAvalibility}}</h1>
	<h1>{{$checkAvalibilityEquipment}}</h1>
	<br>
	IF NUMBER IS <b>0</b> YOU HAVE BOOKED A ROOM <br>
	IF NUMBER IS <b>1</b> THERE WAS ALLREADY A BOOKING

@endsection