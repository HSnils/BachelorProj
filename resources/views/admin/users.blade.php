@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-4 mdl-color-text--grey-600 flex100">
		USERS
	</div>

	<br>

	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp ">
	<thead>
		<tr>
			<th class="mdl-data-table__cell--non-numeric">Name</th>
			<th class="mdl-data-table__cell--non-numeric ">E-Mail</th>
			<th class="mdl-data-table__cell--non-numeric mdl-data-table__header--sorted-descending">Created</th>
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

				<form action="{{url('admin/edit/user')}}/{{$user->id}}" method="post">
					{{ csrf_field() }}
					<td class="mdl-data-table__cell--non-numeric">
						<select id="selectRole{{$user->id}}" name="role" class="roleSelect" required>
							@foreach ($allRoles as $role)
								@if($user->role == $role->role)
									<option selected value="{{$role->role}}">{{$role->role}}</option>
								@else
									<option value="{{$role->role}}">{{$role->role}}</option>
								@endif
							@endforeach
						</select>
						<!-- Simple Tooltip -->
						<div class="mdl-tooltip" data-mdl-for="selectRole{{$user->id}}">
						Select role
						</div>

					</td>
					<td class="mdl-data-table__cell--non-numeric">
						<button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary editButton">
							<i class="material-icons">edit</i>
						</button>
					</td>
				</form>

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
@endsection