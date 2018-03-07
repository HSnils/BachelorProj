@extends('partials.template')

@section('content')

<div class="mdl-typography--display-4 mdl-color-text--grey-600">
	Admin
</div>
	
	<div>
		<span>New Users</span>
		<table>
			<thead>
				<tr>
					<td>Name</td>
					<td>E-Mail</td>
					<td>Role</td>
					<td>Accept</td>
					<td>Reject</td>
				</tr>
			</thead>
			<tbody>
				@foreach ($newUsers as $user)
					<tr>
						<td>
							{{$user->name}}
						</td>
						<td>
							{{$user->email}}
						</td>
						<td>
							<select>
								@foreach ($allRoles as $role)
									<option value="{{$role->role}}">{{$role->role}}</option>
								@endforeach
							</select>
								
						</td>
						<td>
							<a href="#"><i class="material-icons">done</i></a>
						</td>
						<td>
							<a href="#"><i class="material-icons">clear</i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
  @include('../partials.mdl-button')
@endsection