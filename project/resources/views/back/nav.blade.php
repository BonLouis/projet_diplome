<nav>
	<div class="nav-wrapper">
		<a href="{{ route('home') }}" class="brand-logo"><img src="{{asset('images/logo.png')}}" alt=""></a>
		{{-- Nav for desktop --}}
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li class="white-text"><a href="{{ route('home') }}">Accueil</a></li>
			<li class="white-text"><a href="{{ route('showFormations') }}">Formations</a></li>
			<li class="white-text"><a href="{{ route('showStages') }}">Stages</a></li>
			@auth
			<li><a class="waves-effect white-text" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}">Se déconnecter</a></li>
			@endauth
		</ul>
	  	<a href="#" data-target="admin-sidenav" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
	</div>
</nav>

<ul id="admin-sidenav" class="sidenav">
	<li class="white-text"><a href="{{ route('home') }}">Accueil</a></li>
	<li class="white-text"><a href="{{ route('showFormations') }}">Formations</a></li>
	<li class="white-text"><a href="{{ route('showStages') }}">Stages</a></li>
	@auth
	<li><a class="waves-effect white-text" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}">Se déconnecter</a></li>
	@endauth
</ul>
@auth
<form id="logout-form" 
	action="{{ route('logout') }}" 
	method="POST" 
	style="display: none;">
@csrf
</form>
@endauth

@push('backScripts')
    <script>
    	document.addEventListener('DOMContentLoaded', yiha => {
			$('#admin-sidenav').sidenav();
    	});
    </script>
@endpush