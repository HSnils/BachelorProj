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
						<form action="" method="post">
							<td class="mdl-data-table__cell--non-numeric">
								<select>
									@foreach ($allRoles as $role)
										<option value="{{$role->role}}">{{$role->role}}</option>
									@endforeach
								</select>
									
							</td>
							<td class="mdl-data-table__cell--non-numeric">
								<button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary" >
									<i class="material-icons">done</i>
								</button>
							</td>
						</form>
						<td class="mdl-data-table__cell--non-numeric ">
							<a href="#"><i class="material-icons">clear</i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>