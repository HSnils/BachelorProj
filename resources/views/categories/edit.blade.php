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
				<option value="Project">Project</option>
				<option value="Education">Education</option>
				<option value="Other">Other</option>
			</select>
			
			<br>

			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" style="float:right">
				Update
			</button>

		</form>

		@include('partials.errors')
	</div>
	
@endsection