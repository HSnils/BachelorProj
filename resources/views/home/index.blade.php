@extends('partials.template')

@section('content')
   <!-- <div class="mdl-typography--display-4 mdl-color-text--grey-600 flex100">
	BOOKINGS
    </div>-->

	@include('home.booking')

	@include('home.myBookings')

@endsection