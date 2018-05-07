@extends('partials.template')

@section('content')

	<div class="contentWrapper">
		<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
			{{$equipment->name}}
		</div>

	</div>
	<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--3-col"></div>
			<div class="mdl-cell mdl-cell--3-col">
				Type: {{$equipment->type}}
			</div>
			<div class="mdl-cell mdl-cell--3-col">
				Building: {{$equipment->location}}
			</div>
			<div class="mdl-cell mdl-cell--3-col"></div>
			<div class="mdl-cell mdl-cell--4-col"></div>
			<div class=" mdl-cell mdl-cell--4-col">
				<a href="{{url('rooms')}}/{{$equipment->location}}">See more information about the location.</a>
			</div>
			<div class="mdl-cell mdl-cell--4-col"></div>

		<div class="mdl-cell mdl-cell--12-col">
			<div class="mdl-typography--display-1 mdl-color-text--grey-600">
				Description:
			</div>
			{{$equipment->desc}}
		</div>
		<div class="mdl-cell mdl-cell--12-col">
			<div class="mdl-typography--display-1 mdl-color-text--grey-600">
				Other Documentation:
			</div>
			{{$equipment->other_documentation}}
			<br>
			Last service: 
			@if(!$equipment->last_service == '')
				{{$equipment->last_service}}
			@else
				<i>No information spesified</i>
			@endif
		</div>
		<div class="mdl-cell mdl-cell--4-col">
			NTNU ID: 
			@if(!$equipment->ntnu_id == '')
				{{$equipment->ntnu_id}}
			@else
				<i>No id spesified</i>
			@endif
		</div>
		<div class="mdl-cell mdl-cell--4-col">
			Status: {{$equipment->status}}
		</div>
		<div class="mdl-cell mdl-cell--4-col">
			Lockdown status: {{$equipment->lockdown}}
		</div>
	</div>

	<div class="mdl-grid">
		<div class="mdl-cell mdl-cell--12-col contentWrapper">
			<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
				Bookings on this equipment:
			</div>
			<!--<div class="sortingOpen"><b>Filter:</b> <i class="material-icons">filter_list</i></div>-->
			<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp " id="roomsTable">
				<thead class="" >
					<tr class="">
						<th onclick="sortTable(0, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">User</th>
						<th onclick="sortTable(1, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">E-mail</th>
						<th onclick="sortTable(2, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th">Start date</th>
						<th onclick="sortTable(3, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th">End date</th>
						
						<th onclick="sortTable(4, this, 'roomsTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Usage</th>
					</tr>
				</thead>
				<tbody class="">
					@foreach($bookingsOnThisEquipment as $booking)
						<tr>
							<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$booking->user->name}}</td>
							<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$booking->user->email}}</td>
							<td class="mdl-data-table__cell--non-numeric">{{date("D d-M. H:i", strtotime($booking->from_date))}}</td>
							<td class="mdl-data-table__cell--non-numeric">{{date("D d-M. H:i", strtotime($booking->to_date))}}</td>
							<td class="mdl-data-table__cell--non-numeric hideOnMobile">{{$booking->category}}</td>
						</tr>
					@endforeach
				</tbody>	
			</table>
			<div class="paginateLinks">
				{{$bookingsOnThisEquipment->links()}}
			</div>
		</div>
	</div>
	
	<script type="text/javascript" src="{{asset('js/sortTables.js')}}"></script>

@endsection