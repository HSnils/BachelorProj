@extends('partials.template')

@section('content')

<div class="mdl-typography--display-4 mdl-color-text--grey-600 flex100">
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