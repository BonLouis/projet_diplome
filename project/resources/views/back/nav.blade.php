<nav>
	<div class="nav-wrapper">
		<a href="#" class="brand-logo">Administration</a>
		{{-- Nav for desktop --}}
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li class="white-text"><a href="/">Accueil</a></li>
			<li class="white-text"><a href="/formations">Formations</a></li>
			<li class="white-text"><a href="/stages">Stages</a></li>
			@auth
			<li><a class="waves-effect white-text" href="/admin">Administrer</a></li>
			<li><a class="waves-effect white-text" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}">Se déconnecter</a></li>
			@endauth
		</ul>
	  	<a href="#" data-target="admin-sidenav" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
	</div>
</nav>

<ul id="admin-sidenav" class="sidenav">
	
</ul>