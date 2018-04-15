@extends('partials.template')

@section('content')

<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
	DASHBOARD
</div>

<div class="">
	<span>New Users</span>
	@include('admin.newUsersTable')
</div>

<div class="marginL">
	<span>New Student-bookings</span>
	@include('admin.newBookingsTable')
</div>


@endsection