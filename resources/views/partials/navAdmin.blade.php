@php
		function activeTabAdmin($location){
			return Request::is($location) ? 'activeTab adminTab' : '';
		}

		function activeTab($location){
			return Request::is($location) ? 'activeTab' : '';
		}
@endphp

<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
	<header class="mdl-layout__header adminNavColor ">
	<div class="mdl-layout__header-row">
		<!-- Title -->
		<span class="mdl-layout-title">Colourlab NTNU (Admin)</span>
		<!-- Add spacer, to align navigation to the right -->
		<div class="mdl-layout-spacer"></div>
		<!-- Navigation. We hide it in small screens. -->
		<nav class="mdl-navigation mdl-layout--large-screen-only">
			
			<!-- Show this if user is logged in -->
			<a class="mdl-navigation__link {{activeTabAdmin('admin')}}" href="{{ route('admin') }}">Dashboard</a>
			<a class="mdl-navigation__link {{activeTabAdmin('admin/rooms')}} " href="{{ route('roomsAdmin') }}">Rooms</a>
			<a class="mdl-navigation__link {{activeTabAdmin('admin/equipments')}}" href="{{ route('equipmentsAdmin') }}">Equipments</a>
			<a class="mdl-navigation__link {{activeTabAdmin('admin/bookings')}}" href="{{ route('bookingsAdmin')}}">Bookings</a>
			<a class="mdl-navigation__link {{activeTabAdmin('admin/users')}}" href="{{ route('users') }}">Users</a>
			<a class="mdl-navigation__link {{activeTabAdmin('admin/logg')}}" href="{{ route('logg') }}">Logg</a>


			<a href="{{ route('home') }}" class="mdl-navigation__link">
			Back to normal page
			</a>
			

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

		</nav>
	</div>
  </header>
  <div class="mdl-layout__drawer">
	<span class="mdl-layout-title">Colourlab (Admin)</span>
		<nav class="mdl-navigation">

				<!-- Show this if user is logged in -->
				<a class="mdl-navigation__link {{activeTab('admin')}}" href="{{ route('admin') }}">Dashboard</a>
				<a class="mdl-navigation__link {{activeTab('admin/rooms')}}" href="{{ route('roomsAdmin') }}">Rooms</a>
				<a class="mdl-navigation__link {{activeTab('admin/equipments')}}" href="{{ route('equipmentsAdmin') }}">Equipments</a>
				<a class="mdl-navigation__link {{activeTab('admin/bookings')}}" href="{{ route('bookingsAdmin')}}">Bookings</a>
				<a class="mdl-navigation__link {{activeTab('admin/users')}}" href="{{ route('users') }}">Users</a>
				<a class="mdl-navigation__link {{activeTab('admin/logg')}}" href="{{ route('logg') }}">Logg</a>

				<a href="{{ route('home') }}" class="mdl-navigation__link">
				Back to normal page
				</a>

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
				
			</nav>
		</div>