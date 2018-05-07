@extends('partials.template')
@section('content')

<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
	LOG/CATEGORIES
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--4-col">
	</div>
	@php
		$totalHoursSpent = 0;
		foreach($filteredBookings as $booking){
			$totalHoursSpent += $booking->hoursSpent();
		}
	@endphp
	<div class="mdl-cell mdl-cell--4-col">
		Total hours spent: <b>{{$totalHoursSpent}} </b>
	<br>
		Total bookings: <b>{{count($filteredBookings)}}</b>
	</div>
	<div class="mdl-cell mdl-cell--4-col">
		<a href="{{url()->current()}}/download?{{request()->getQueryString()}}">Download to CSV <i class="material-icons">file_download</i></a>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col contentWrapper">

	<div class="sortingOpen"><b>Filter:</b> <i class="material-icons">filter_list</i></div>
	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp " id="categoriesTable">
		<thead class="" >
			<tr class="">
				<th onclick="sortTable(0, this, 'categoriesTable')" class="mdl-data-table__cell--non-numeric th">Name</th>
				<th onclick="sortTable(1, this, 'categoriesTable')" class="mdl-data-table__cell--non-numeric th">Type</th>
				<th onclick="sortTable(2, this, 'categoriesTable')" class="mdl-data-table__cell--non-numeric th">User</th>
				<th onclick="sortTable(4, this, 'categoriesTable')" class="mdl-data-table__cell--non-numeric th">Start date</th>
				<th onclick="sortTable(5, this, 'categoriesTable')" class="mdl-data-table__cell--non-numeric th">End date</th>
				<th onclick="sortTable(6, this, 'categoriesTable')" class="mdl-data-table__cell--non-numeric th">Hours spent</th>
			</tr>
		</thead>
		<tbody class="">
			@foreach($filteredBookings as $booking)

				<tr>
					<td class="mdl-data-table__cell--non-numeric">{{$booking->category}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$booking->type}}</td>
					<td class="mdl-data-table__cell--non-numeric">
						<a href="{{url('admin/log/users')}}?name={{$booking->name}}">{{$booking->name}}</a>
					</td>
					<td class="mdl-data-table__cell--non-numeric">{{$booking->from_date}}</td>
					<td class="mdl-data-table__cell--non-numeric">{{$booking->to_date}}</td>
					<!--If hour spent is more than 1.5 print 'hours' else print 'hour' -->
					<td class="mdl-data-table__cell--non-numeric">{{($booking->hoursSpent() > 1.5) ? $booking->hoursSpent().' hours' : $booking->hoursSpent().' hour' }} </td>
				</tr>
			@endforeach
		</tbody>	
	</table>
	<div class="paginateLinks">
			{{$filteredBookings->links()}}
		</div>
	</div>
</div>




<!--Sorting -->
	<dialog class="mdl-dialog">
		<form action="">
		<div class="mdl-dialog__content">
			<div><i class="material-icons sortingClose">clear</i></div>

			<div id="sortingBox">
				
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="category" name="category">
						<label class="mdl-textfield__label" for="category">Filter by categoryname...</label>
					</div>
					
					<span class="materialLabel marginTop1 marginBottom1">Filter by type...</span>
					<select class="formPadding flex100 width100" name="type" id="type">
						<option disabled selected="">Select category type</option>
						<option value="Project">Project</option>
						<option value="Education">Education</option>
						<option value="Other">Other</option>
					</select>

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="username" name="username">
						<label class="mdl-textfield__label" for="username">Filter by username...</label>
					</div>
					
					<span class="materialLabel marginTop1 marginBottom1">Filter by start and end date</span><hr>
					<label for="dateFrom" class="materialLabel ">Start date</label>
					<br>
					<input type="date" name="dateFrom" id="dateFrom" class="formPadding marginTop1 " >

					<div class="mdl-tooltip" data-mdl-for="dateFrom">
						Select starting date
					</div>
					<br>
					<label for="dateTo" class="materialLabel ">End date</label>
					<br>
					<input type="date" name="dateTo" id="dateTo" class="formPadding marginTop1 ">
					
					<div class="mdl-tooltip" data-mdl-for="dateTo">
						Select ending date
					</div>
			</div>
		</div>
		<div class="mdl-dialog__actions mdl-dialog__actions--full-width">
			<button type="submit" class="mdl-button">Filter</button>
			
		</div>
		</form>
	</dialog>
	<script>
	var dialog = document.querySelector('dialog');
	if (! dialog.showModal) {
		dialogPolyfill.registerDialog(dialog);
	}
	$('.sortingOpen').click( function() {
		dialog.showModal();
	});
	$('.sortingClose').click( function() {
		dialog.close();
	});
	</script>
	<script type="text/javascript" src="js/sortTables.js"></script>
	

@endsection