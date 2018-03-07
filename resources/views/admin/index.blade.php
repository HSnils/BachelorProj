@extends('partials.template')

@section('content')

<div class="mdl-typography--display-4 mdl-color-text--grey-600">
	Admin
</div>
	
	<div>
		<span>New Users</span>
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp ">
			<thead>
				<tr>
					<th class="mdl-data-table__cell--non-numeric">Name</th>
					<th class="mdl-data-table__cell--non-numeric">E-Mail</th>
					<th class="mdl-data-table__cell--non-numeric">Role</th>
					<th class="mdl-data-table__cell--non-numeric">Accept</th>
					<th class="mdl-data-table__cell--non-numeric">Reject</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($newUsers as $user)
					<tr>
						<td class="mdl-data-table__cell--non-numeric">
							{{$user->name}}
						</td class="mdl-data-table__cell--non-numeric">
						<td>
							{{$user->email}}
						</td>
						<td class="mdl-data-table__cell--non-numeric">
							<select>
								@foreach ($allRoles as $role)
									<option value="{{$role->role}}">{{$role->role}}</option>
								@endforeach
							</select>
								
						</td>
						<td class="mdl-data-table__cell--non-numeric">
							<a href="#"><i class="material-icons">done</i></a>
						</td>
						<td class="mdl-data-table__cell--non-numeric">
							<a href="#"><i class="material-icons">clear</i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
  @include('../partials.mdl-button')
@endsection