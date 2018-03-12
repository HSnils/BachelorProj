        <!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
	<header class="mdl-layout__header">
	<div class="mdl-layout__header-row">
		<!-- Title -->
		<span class="mdl-layout-title">Cololab NTNU</span>
		<!-- Add spacer, to align navigation to the right -->
		<div class="mdl-layout-spacer"></div>
		<!-- Navigation. We hide it in small screens. -->
		<nav class="mdl-navigation mdl-layout--large-screen-only">
			
			<!-- Show this if user is logged in -->
			<a class="mdl-navigation__link" href="{{ route('admin') }}">Dashboard</a>
			<a class="mdl-navigation__link" href="{{ route('roomsAdmin') }}">Rooms</a>
			<a class="mdl-navigation__link" href="{{ route('equipmentsAdmin') }}">Equipments</a>
			<a class="mdl-navigation__link" href="{{ route('users') }}">Users</a>
			<a class="mdl-navigation__link" href="{{ route('logg') }}">Logg</a>


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
    <span class="mdl-layout-title">Colorlab</span>
    <nav class="mdl-navigation">
        
        <!-- Show this if user is logged in -->
        	<a class="mdl-navigation__link" href="{{ route('admin') }}">Dashboard</a>
			<a class="mdl-navigation__link" href="{{ route('roomsAdmin') }}">Rooms</a>
			<a class="mdl-navigation__link" href="{{ route('equipmentsAdmin') }}">Equipments</a>
			<a class="mdl-navigation__link" href="{{ route('users') }}">Users</a>
			<a class="mdl-navigation__link" href="{{ route('logg') }}">Logg</a>


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
  <main class="mdl-layout__content">