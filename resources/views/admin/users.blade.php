@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
		USERS
	</div>


	<div class="relative contentWrapper">
		<div class="sortingOpen"><b>Filter:</b> <i class="material-icons">filter_list</i></div>
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp " id="usersTable">	
			<thead>

				<tr>
					<!--- Only Email, Role, Edit and Delete visible on phone-->
					<th onclick="sortTable(0, this, 'usersTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Name</th>
					<th onclick="sortTable(1, this, 'usersTable')" class="mdl-data-table__cell--non-numeric th">E-Mail</th>
					<th onclick="sortTable(2, this, 'usersTable')" class="mdl-data-table__cell--non-numeric th mdl-data-table__header--sorted-descending hideOnMobile">Created</th>
					<th onclick="sortTable(3, this, 'usersTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Status</th>
					<th onclick="sortTable(4, this, 'usersTable')" class="mdl-data-table__cell--non-numeric th">Role</th>
					<th onclick="sortTable(5, this, 'usersTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Created</th>
					<th onclick="sortTable(6, this, 'usersTable')" class="mdl-data-table__cell--non-numeric th hideOnMobile">Last login</th>
					<th class="mdl-data-table__cell--non-numeric">Edit</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($allUsers as $user)
					<tr>
						<td class="mdl-data-table__cell--non-numeric hideOnMobile">
							{{$user->name}}
						</td >
						<td class="mdl-data-table__cell--non-numeric">
							{{$user->email}}
						</td>
						<td class="mdl-data-table__cell--non-numeric hideOnMobile">
							{{$user->created_at->diffForHumans()}}
						</td>

						<td class="mdl-data-table__cell--non-numeric hideOnMobile">
							@if($user->status == "Inactive")
								<!--Red status-->
								<span style="color: #E53935;">{{$user->status}}</span>
							@elseif($user->status == 'Pending')
								<!-- Blue status -->
								<span style="color: #1976D2;" >{{$user->status}}</span>
							@else
								<!--Green status-->
								<span style="color: #558B2F;" >{{$user->status}}</span>
							@endif
						</td>

						<td class="mdl-data-table__cell--non-numeric"> {{$user->role}}</td>

						<td class="mdl-data-table__cell--non-numeric hideOnMobile"> {{$user->created_at}}</td>

						<td class="mdl-data-table__cell--non-numeric hideOnMobile"> {{$user->last_login}}</td>

						<td class="mdl-data-table__cell--non-numeric " >
							<a href="{{ url('admin/users/edit') }}/{{$user->id}}" ><i class="material-icons mdl-button--primary">edit</i></a>
						</td>
					</tr>
				@endforeach

			</tbody>
		</table>
		<div class="paginateLinks">
			{{$allUsers->links()}}
		</div>
	</div>

	<!--Sorting -->
	<dialog class="mdl-dialog">
		<div class="mdl-dialog__content">
			<div><i class="material-icons sortingClose">clear</i></div>
			<div id="sortingBox">
				<form action="">
					
					

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="name" name="name">
						<label class="mdl-textfield__label" for="sample3">Filter by name...</label>
					</div>

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="email" id="email" name="email">
						<label class="mdl-textfield__label" for="sample3">Filter by email...</label>
					</div>
					
					<span class="materialLabel marginTop1 marginBottom1">Filter by role</span>
					<select class="formPadding flex100 width100" name="role" id="role">
						<option disabled selected="">Select role</option>
						@foreach($allRoles as $role)
							<option value="{{$role->role}}">{{$role->role}}</option>
						@endforeach
					</select>

					<span class="materialLabel marginTop1 marginBottom1">Filter by status</span>
					<select class="formPadding flex100 width100" name="status" id="status">
						<option disabled selected="">Select status</option>
						@php
							$statusArray = ['Active', 'Inactive', 'Pending'];;
						@endphp
						@for($i = 0; $i < count($statusArray); $i++)
							<option value="{{$statusArray[$i]}}">
								{{$statusArray[$i]}}
							</option>
						@endfor
					</select>

					 
			</div>
		</div>
		<div class="mdl-dialog__actions mdl-dialog__actions--full-width">
			<button type="submit" class="mdl-button">Filter</button>
			</form>
		</div>
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
	<script type="text/javascript" src="{{asset('js/sortTables.js')}}"></script>
@endsection