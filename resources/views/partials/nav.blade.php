@php
		function activeTab($location){
			return Request::is($location) ? 'activeTab' : '';
		}
@endphp

<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
	<header class="mdl-layout__header ">
	<div class="mdl-layout__header-row">
		<!-- Title -->
		<span class="mdl-layout-title">Colourlab NTNU</span>
		<!-- Add spacer, to align navigation to the right -->
		<div class="mdl-layout-spacer"></div>

		<!-- Navigation. We hide it in small screens. -->
		<nav class="mdl-navigation mdl-layout--large-screen-only">
			<!-- Checks if the user hasnt logged in-->
			@if (Auth::guest())
				<hr>
				<a class="mdl-navigation__link {{ activeTab('login')}}" href="{{ route('login') }}">Sign in</a>
			@else
				<!-- Show this if user is logged in -->
				<!--$pagelocation == 'home' ? 'mdl-navigation__link--current a_no_underline' : 'mdl-navigation__link'}}-->
				<a class="mdl-navigation__link {{ activeTab('home')}}" href="{{ route('home') }}">Bookings</a>
				<a class="mdl-navigation__link {{ activeTab('rooms')}}" href="{{ route('rooms') }}">Rooms</a>
				<a class="mdl-navigation__link {{ activeTab('equipments')}}" href="{{ route('equipments') }}">Equipments</a>
				<a class="mdl-navigation__link {{ activeTab('profile')}}" href="{{ route('profile') }}">Profile</a>
				
				<!-- Show this if the user is admin -->
				@if (Auth::user()->role == 'Admin')
				<a href="{{ route('admin') }}" class="mdl-navigation__link">
					Admin
				</a>
				@endif
				
				<!--SIGN OUT -->
				<hr>
				<a class="mdl-navigation__link" href="{{ route('logout') }}" onclick="
					event.preventDefault();
					document.getElementById('logout-form').submit();">
				Sign out
				</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			@endif

		</nav>
	</div>
	</header>
	<div class="mdl-layout__drawer">
		<span class="mdl-layout-title">Colourlab</span>
		<nav class="mdl-navigation">
			
			<!-- Checks if the user hasnt logged in-->
			@if (Auth::guest())
				<hr>
				<a class="mdl-navigation__link {{ activeTab('login')}}" href="{{ route('login') }}">Sign in</a>
			@else
				<!-- Show this if user is logged in -->
				<!--$pageLocation == 'home' ? 'mdl-navigation__link a_no_underline sidenavActive' : 'mdl-navigation__link'-->
				<a class="mdl-navigation__link {{ activeTab('home')}}" href="{{ route('home') }}">Bookings</a>
				<a class="mdl-navigation__link {{ activeTab('rooms')}}" href="{{ route('rooms') }}">Rooms</a>
				<a class="mdl-navigation__link {{ activeTab('equipments')}}" href="{{ route('equipments') }}">Equipments</a>
				<a class="mdl-navigation__link {{ activeTab('profile')}}" href="{{ route('profile') }}">Profile</a>
				
				<!-- Show this if the user is admin -->
				@if (Auth::user()->role == 'Admin')
				<a href="{{ route('admin') }}" class="mdl-navigation__link">
					Admin
				</a>
				@endif
				
				<!--SIGN OUT -->
				<hr>
				<a class="mdl-navigation__link" href="{{ route('logout') }}" onclick="
					event.preventDefault();
					document.getElementById('logout-form-sidebar').submit();">
				Sign out
				</a>
				<form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			@endif
		</nav>
	</div>
