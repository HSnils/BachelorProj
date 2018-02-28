@extends('partials.template')

@section('content')
	<div class="panel-body">
	<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
  <div class="mdl-tabs__tab-bar">
    <a href="#about-panel" class="mdl-tabs__tab is-active">About the Beatles</a>
    <a href="#members-panel" class="mdl-tabs__tab">Members</a>
    <a href="#albums-panel" class="mdl-tabs__tab">Discography</a>
  </div>
  <div class="mdl-tabs__panel is-active" id="about-panel">
    <p><b>The Beatles</b> were a four-piece musical group from Liverpool, England.
    Formed in 1960, their career spanned just over a decade, yet they are widely
    regarded as the most influential band in history.</p>
    <p>Their songs are among the best-loved music of all time. It is said that every
    minute of every day, a radio station somewhere is playing a Beatles song.</p>
  </div>
  <div class="mdl-tabs__panel" id="members-panel">
    <p>The Beatles' members were:</p>
    <ul>
      <li>John Lennon (1940-1980)</li>
      <li>Paul McCartney (1942-)</li>
      <li>George Harrison (1943-2001)</li>
      <li>Ringo Starr (1940-)</li>
    </ul>
  </div>
  <div class="mdl-tabs__panel" id="albums-panel">
    <p>The Beatles' original UK LPs, in order of release:</p>
    <ol>
      <li>Please Please Me (1963)</li>
      <li>With the Beatles (1963)</li>
      <li>A Hard Day's Night (1964)</li>
      <li>Beatles for Sale (1964)</li>
      <li>Help! (1965)</li>
      <li>Rubber Soul (1965)</li>
      <li>Revolver (1966)</li>
      <li>Sgt. Pepper's Lonely Hearts Club Band (1967)</li>
      <li>The Beatles ("The White Album", 1968)</li>
      <li>Yellow Submarine (1969)</li>
      <li>Abbey Road (1969)</li>
      <li>Let It Be (1970)</li>
    </ol>
  </div>
</div>
		
	</div>
@endsection
