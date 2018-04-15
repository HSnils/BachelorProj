@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 headers">
		USERS
	</div>


	<div class="relative contentWrapper">
		<div class="sortingOpen"><b>Sort:</b> <i class="material-icons">filter_list</i></div>
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp ">
			<thead>
				<tr>
					<th class="mdl-data-table__cell--non-numeric">Name</th>
					<th class="mdl-data-table__cell--non-numeric">E-Mail</th>
					<th class="mdl-data-table__cell--non-numeric">Created</th>
					<th class="mdl-data-table__cell--non-numeric">Status</th>
					<th class="mdl-data-table__cell--non-numeric">Role</th>
					<th class="mdl-data-table__cell--non-numeric">Edit</th>
					<th class="mdl-data-table__cell--non-numeric">Delete</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($allUsers as $user)
					<tr>
						<td class="mdl-data-table__cell--non-numeric">
							{{$user->name}}
						</td >
						<td class="mdl-data-table__cell--non-numeric">
							{{$user->email}}
						</td>
						<td class="mdl-data-table__cell--non-numeric">
							{{$user->created_at->diffForHumans()}}
						</td>

						<td class="mdl-data-table__cell--non-numeric">
							@if($user->status != "Active")
								<span style="color: red;">{{$user->status}}</span>
							@else
								<span style="color: green;" >{{$user->status}}</span>
							@endif
						</td>

						<td class="mdl-data-table__cell--non-numeric"> {{$user->role}}</td>

						<td class="mdl-data-table__cell--non-numeric " >
							<a href="{{ url('admin/users/edit') }}/{{$user->id}}" ><i class="material-icons mdl-button--primary">edit</i></a>
						</td>

						<td class="mdl-data-table__cell--non-numeric ">
							<form action=" {{url('admin/delete/user')}}/{{$user->id}}" method="post">
								@method('delete')
								@csrf

								<button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--accent deleteUserButton">
									<i class="material-icons">clear</i>
								</button>
							</form>
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
						<label class="mdl-textfield__label" for="sample3">Sort by name...</label>
					</div>

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="email" id="email" name="email">
						<label class="mdl-textfield__label" for="sample3">Sort by email...</label>
					</div>
					
					<span class="materialLabel marginTop1 marginBottom1">Sort by role</span>
					<select class="formPadding flex100 width100" name="role" id="role">
						<option disabled selected="">Select role</option>
						@foreach($allRoles as $role)
							<option value="{{$role->role}}">{{$role->role}}</option>
						@endforeach
					</select>

					<span class="materialLabel marginTop1 marginBottom1">Sort by status</span>
					<select class="formPadding flex100 width100" name="status" id="status">
						<option disabled selected="">Select status</option>
						@php
							$statusArray = ['Active', 'Deleted', 'Banned', 'Pending', 'Scammer'];
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
			<button type="submit" class="mdl-button">Sort</button>
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
@endsection