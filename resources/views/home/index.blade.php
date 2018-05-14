@extends('partials.template')

@section('content')
   <!-- <div class="mdl-typography--display-4 mdl-color-text--grey-600 flex100">
	BOOKINGS
    </div>-->
	
	@if(Auth::user()->role == 'Guest')
		<h2>You need to get your account role set by an administrator before you can book</h2>
	@else
		@include('home.booking')
		@include('home.myBookings')
	@endif
@endsection