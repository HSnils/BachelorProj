@extends('partials.template')

@section('content')

<div class="mdl-typography--display-4 mdl-color-text--grey-600">
	Welcome
	@if(Auth::user())
		{{", ".Auth::user()->name}}
	@endif
</div>
	
	


  @include('../partials.mdl-button')
@endsection