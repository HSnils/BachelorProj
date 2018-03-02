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
        <a class="mdl-navigation__link" href="{{ route('home') }}">Home</a>
        <a class="mdl-navigation__link" href="{{ route('rooms') }}">Rooms</a>
        <a class="mdl-navigation__link" href="{{ route('equipments') }}">Equipments</a>
        <a class="mdl-navigation__link" href="{{ route('login') }}">Profile</a>
        <a class="mdl-navigation__link" href="{{ route('login') }}">Sign in</a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Colorlab</span>
    <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="{{ route('home') }}">Home</a>
        <a class="mdl-navigation__link" href="{{ route('rooms') }}">Rooms</a>
        <a class="mdl-navigation__link" href="{{ route('equipments') }}">Equipments</a>
        <a class="mdl-navigation__link" href="{{ route('login') }}">Profile</a>
        <a class="mdl-navigation__link" href="{{ route('login') }}">Sign in</a>
      </nav>
  </div>
  <main class="mdl-layout__content">