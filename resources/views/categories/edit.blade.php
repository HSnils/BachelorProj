@extends('partials.template')

@section('content')
	<div class="mdl-typography--display-2 mdl-color-text--grey-600 flex100 page-content">
		EDIT CATEGORY: {{$thisCategory[0]->category}}
	</div>
	<br>

	<div class="">
		<form role="form" method="POST" action="{{ url('categories/edit') }}/{{$thisCategory[0]->category}}" class="formStyle">
			{{ csrf_field() }}

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="category" name="category" value="{{$thisCategory[0]->category}}">
				<label class="mdl-textfield__label" for="category">Category...</label>
				<span class="mdl-textfield__error"></span>
			</div>
			
			<label class="materialLabel" for="type">Type</label>
			<select name="type" id="type" class="formPadding">
				<option value="" disabled>Select Type</option>
				@php
					$typeArray = ['Project', 'Education', 'Other'];
				@endphp
				@for($i = 0; $i < count($typeArray); $i++)
					@if($thisCategory[0]->type == $typeArray[$i])
						<option selected value="{{$thisCategory[0]->type}}">
							{{$thisCategory[0]->type}}
						</option>
					@else
						<option value="{{$typeArray[$i]}}">
							{{$typeArray[$i]}}
						</option>
					@endif
				@endfor
			</select>
			
			<br>

			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" style="float:right">
				Update
			</button>

		</form>

		@include('partials.errors')
	</div>
	
@endsection