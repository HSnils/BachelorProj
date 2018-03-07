@extends('partials.template')

@section('content')

<div class="mdl-typography--display-4 mdl-color-text--grey-600 flex100">
	Admin
</div>

<div class="flex50">
	<span>New Users</span>
	@include('admin.newUsersTable')
</div>

<div class="flex50">
	<span>New Student-bookings</span>
	@include('admin.newBookingsTable')
</div>

  @include('../partials.mdl-button')
@endsection