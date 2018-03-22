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
@endsection