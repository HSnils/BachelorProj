@extends('partials.template')

@section('content')

	<div class="contentWrapper">
		<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
			{{$equipment->name}}
		</div>

	</div>
	<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--3-col"></div>
			<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-phone textCenter">
				Type: {{$equipment->type}}
			</div>
			<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-phone textCenter">
				Location: <a href="{{url('rooms')}}/{{$equipment->location}}">{{$equipment->location}}</a>
			</div>
			<div class="mdl-cell mdl-cell--3-col"></div>
			<div class="mdl-cell mdl-cell--3-col"></div>

			<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-phone textCenter">
				NTNU ID: 
				@if(!$equipment->ntnu_id == '')
					{{$equipment->ntnu_id}}
				@else
					<i>No id specified</i>
				@endif
			</div>
			<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-phone textCenter">
				Status: {{$equipment->status}}
			</div>
			<div class="mdl-cell mdl-cell--3-col"></div>

		<div class="mdl-cell mdl-cell--3-col"></div>
		<div class="mdl-cell mdl-cell--6-col mdl-cell--4-col-phone">
			<div class="mdl-typography--display-1 mdl-color-text--grey-600">
				Description:
			</div>
			{{$equipment->desc}}
		</div>
		<div class="mdl-cell mdl-cell--3-col"></div>

		<div class="mdl-cell mdl-cell--3-col"></div>
		<div class="mdl-cell mdl-cell--6-col mdl-cell--4-col-phone">
			<div class="mdl-typography--display-1 mdl-color-text--grey-600">
				Other Documentation:
			</div>
			{{$equipment->other_documentation}}
			<br>
			Last service: 
			@if(!$equipment->last_service == '')
				{{$equipment->last_service}}
			@else
				<i>No information specified</i>
			@endif
		</div>
		<div class="mdl-cell mdl-cell--3-col"></div>
		
		<div class="mdl-cell mdl-cell--12-col contentWrapper">
			<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
				Bookings on this equipment:
			</div>
			<br>
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
		<br>
		<!--REPORT DAMAGE FORM -->
		<div class="mdl-cell mdl-cell--5-col"></div>
		<div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-phone">
			<!-- Accent-colored raised button with ripple -->
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent reportingOpen">
				<i class="material-icons">report_problem</i>Report damage
			</button>
		</div>
		<div class="mdl-cell mdl-cell--5-col"></div>

	</div>

	<!--Reporting dialog -->
	<dialog class="mdl-dialog">
		<div class="mdl-dialog__content">
			<div><i class="material-icons reportingClose">clear</i></div>
			<div id="sortingBox">
				<form action="" method="post">
					{{ csrf_field() }}
					<div class="mdl-typography--display-1 mdl-color-text--grey-600">
						Report damage:
					</div>

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="report" name="report">
						<label class="mdl-textfield__label" for="report">Report message...</label>
					</div>
			</div>
		</div>
		<div class="mdl-dialog__actions mdl-dialog__actions--full-width">
			<button type="submit" class="mdl-button">Send report</button>
			</form>
		</div>
	</dialog>
	<script>
	var dialog = document.querySelector('dialog');
	if (! dialog.showModal) {
		dialogPolyfill.registerDialog(dialog);
	}
	$('.reportingOpen').click( function() {
		dialog.showModal();
	});
	$('.reportingClose').click( function() {
		dialog.close();
	});
	</script>
	<script type="text/javascript" src="{{asset('js/sortTables.js')}}"></script>

@endsection