@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 page-content">
		EDIT USER: {{$thisUser[0]->name}}
	</div>
	<br>

	<div class="marginTop1">
		<form role="form" method="POST" action="{{ url('admin/edit/user') }}/{{$thisUser[0]->id}}" class="formStyle">
			{{ csrf_field() }}

			<select id="selectRole" name="role" class="roleSelect formPadding " required>
				@foreach ($allRoles as $role)
					@if($thisUser[0]->role == $role->role)
						<option selected value="{{$role->role}}">{{$role->role}}</option>
					@else
						<option value="{{$role->role}}">{{$role->role}}</option>
					@endif
				@endforeach
			</select>
			<!-- Simple Tooltip -->
			<div class="mdl-tooltip" data-mdl-for="selectRole">
			Edit role
			</div>

			<select id="selectStatus" name="status" class="roleSelect formPadding marginTop1 marginBottom1" required>
				@php
					$statusArray = ['Active', 'Deleted', 'Banned', 'Pending', 'Scammer'];
				@endphp
				@for($i = 0; $i < count($statusArray); $i++)
					@if($thisUser[0]->status == $statusArray[$i])
						<option selected value="{{$thisUser[0]->status}}">
							{{$thisUser[0]->status}}
						</option>
					@else
						<option value="{{$statusArray[$i]}}">
							{{$statusArray[$i]}}
						</option>
					@endif
				@endfor
			</select>

						<!-- Simple Tooltip -->
			<div class="mdl-tooltip" data-mdl-for="selectStatus">
			Edit status
			</div>

			@if($thisUser[0]->verified == 0)
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="verified" id="verifyLabel">
					<input type="checkbox" id="verified" class="mdl-checkbox__input" name="verified">
					<span class="mdl-checkbox__label">Verify user</span>
				</label>
				<div class="mdl-tooltip" data-mdl-for="verifyLabel">
					Click this to <br>manually verify the user
				</div>
			@endif

			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect marginTop1" style="float:right">
				Update
			</button>

		</form>

		<!--<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect" style="float:right">
			Delete
		</button>-->

		@include('partials.errors')
	</div>
	
@endsection