@extends('partials.template')

@section('content')

	<div class="contentWrapper">
		<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
			{{$room->room_number}}
		</div>

	</div>
	<div class="mdl-grid">
		<div class="mdl-cell mdl-cell--12-col">
			<div class="mdl-typography--display-5 mdl-color-text--grey-600  headers mdl-cell mdl-cell--6-col">
				Type: {{$room->type}}
			</div>
			<div class="mdl-typography--display-5 mdl-color-text--grey-600  headers mdl-cell mdl-cell--6-col">
				Building: {{$room->building}}
			</div>
		</div>
	</div>

	<div class="mdl-grid">
		<div class="mdl-cell mdl-cell--12-col contentWrapper">
		<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
			Bookings on this room:
		</div>
		<div class="sortingOpen"><b>Filter:</b> <i class="material-icons">filter_list</i></div>
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp " id="roomsTable">
			<thead class="" >
				<tr class="">
					<th onclick="sortTable(0, this, 'usersTable')" class="mdl-data-table__cell--non-numeric th">User</th>
					<th onclick="sortTable(1, this, 'usersTable')" class="mdl-data-table__cell--non-numeric th">E-mail</th>
					<th onclick="sortTable(2, this, 'usersTable')" class="mdl-data-table__cell--non-numeric th">Start date</th>
					<th onclick="sortTable(3, this, 'usersTable')" class="mdl-data-table__cell--non-numeric th">End date</th>
					
					<th onclick="sortTable(4, this, 'usersTable')" class="mdl-data-table__cell--non-numeric th">Usage</th>
				</tr>
			</thead>
			<tbody class="">
				@foreach($bookingsOnThisRoom as $booking)
					<tr>
						<td class="mdl-data-table__cell--non-numeric">{{$booking->user->name}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{$booking->user->email}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{date("D d-M. H:i", strtotime($booking->from_date))}}</td>
						<td class="mdl-data-table__cell--non-numeric">{{date("D d-M. H:i", strtotime($booking->to_date))}}</td>
						<td class="mdl-data-table__cell--non-numeric"><a href="{{url('admin/log/categories')}}?category={{$booking->category}}">{{$booking->category}}</a></td>
					</tr>
				@endforeach
			</tbody>	
		</table>
		<div class="paginateLinks">
				{{$bookingsOnThisRoom->links()}}
			</div>
		</div>
	</div>
	
	<script type="text/javascript" src="js/sortTables.js"></script>

@endsection