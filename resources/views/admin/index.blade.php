@extends('partials.template')

@section('content')

<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers marginB">
	DASHBOARD
</div>
<div class="">
	<div class="mdl-typography--headline mdl-color-text--grey-600 flex100">
	New users
    </div>
	@include('admin.newUsersTable')
</div>

<div class="marginL">
    <div class="mdl-typography--headline mdl-color-text--grey-600 flex100">
	New student bookings
    </div>
	@include('admin.newBookingsTable')
</div>


@endsection