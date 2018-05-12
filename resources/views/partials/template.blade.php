<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<!--Standard stuff -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--Jquery and UI-->
	<script src="{{asset('jquery-ui/external/jquery/jquery.js')}}"></script>
	<link rel="stylesheet" href="{{asset('jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('jquery-ui/jquery-ui.structure.min.css')}}">
	<link rel="stylesheet" href="{{asset('jquery-ui/jquery-ui.theme.min.css')}}">
	<script src="{{asset('jquery-ui/jquery-ui.min.js')}}"></script>
	
	<!-- Morris.js (css) (graphs) -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	
	<!-- Raphael.js -->
	<script src="{{ asset('js/raphael.min.js') }}"></script>
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- Tab title -->
	<title>{{ config('app.name', 'Colourlab booking') }}</title>


	
	
	
	<!-- Styles -->
	<link href="{{ asset('css/normalize.css') }}?<?php echo time();?>" rel="stylesheet">
	
	<!--Bootstrap (not in use) -->
	<!--<link href="{{ asset('css/app.css') }}?<?php echo time();?>" rel="stylesheet">
	<script src="{{ URL::asset('js/app.js') }}"></script>-->
	
	<!-- GETMDL.IO-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-orange.min.css" />

	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">

	<!--GETMDL-select-->   
	<!--<link rel="stylesheet" href="{{ url('/') }}/css/getmdl-select/getmdl-select.min.css">
	<script defer src="{{ url('/') }}/css/getmdl-select/getmdl-select.min.js"></script>-->

	
	<!-- Materializecss 
	<link href="{{ url('/') }}/css/materializecss/materialize.min.css?<?php echo time();?>" rel="stylesheet"> --> 
	


	<!-- Our css -->
	<link href="{{ url('/') }}/css/style.css?<?php echo time();?>" rel="stylesheet">
</head>
<body>
	<div id="app">
	
		<!-- Display for the notification flash send to the user -->
		@include('partials.notifyFlash')

		<!-- Navbar -->
		<!-- If user is at the admin page they get a different navigation -->
		@if(session('adminDashboard') == 'true')
			@include('partials.navAdmin')
		@else
			@include('partials.nav')
		@endif

			<main class="mdl-layout__content" style="flex: 1 0 auto;">
				<div class="page-content"><!-- Your content goes here -->  
					@yield('content')<!-- Content for each page -->
				</div>
			</main>
		<!-- Footer -->
		@include('partials.footer')
		</div>	
	</div>


	<!-- Scripts -->
   
	<script src="{{ URL::asset('js/ajax.js') }}"></script>
	<script src="{{ URL::asset('js/deleteAlert.js') }}"></script>
	<!-- Materializecss 
	<script src="{{ URL::asset('js/materialize.js') }}">
	</script>-->
	
	<!-- Morris.js
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> -->
	
</body>
</html>
