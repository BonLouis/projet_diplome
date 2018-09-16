<div id="header">
	<h1 class="center-align white-text">{{$title}}</h1>
	<div id="scroll-down">
		<div>
			<i class="medium material-icons white-text">keyboard_arrow_down</i>
			<i class="medium material-icons white-text">keyboard_arrow_down</i>
			<i class="medium material-icons white-text">keyboard_arrow_down</i>
		</div>
	</div>
	<nav id="pin" class="blue-grey">
		<div class="nav-wrapper">
			<a href="#" class="brand-logo">Form&Vous</a>
			{{-- Nav for desktop --}}
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li class="white-text"><a href="{{ route('home') }}">Accueil</a></li>
				<li class="white-text"><a href="{{ route('showFormations') }}">Formations</a></li>
				<li class="white-text"><a href="{{ route('showStages') }}">Stages</a></li>
				<li class="white-text"><a href="{{ route('contact') }}">Contact</a></li>
				@guest
				<li class="white-text"><a href="{{ route('login') }}">S'identifier</a></li>
				<li class="white-text"><a href="{{ route('register') }}">Créer un compte</a></li>
				@endguest
				@auth
				<li><a class="waves-effect white-text" href="{{ route('post.index') }}">Administrer</a></li>
				<li><a class="waves-effect white-text" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}">Se déconnecter</a></li>
				@endauth
			</ul>
		  	<a href="#" data-target="sidenav" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
			{{-- Side nav for mobile, trigger on nav --}}
		</div>
	</nav>
	<ul id="sidenav" class="sidenav blue-grey">
		<li class="waves-effect white-text"><a href="{{ route('home') }}">Accueil</a></li>
		<li class="waves-effect white-text"><a href="{{ route('showFormations') }}">Formations</a></li>
		<li class="waves-effect white-text"><a href="{{ route('showStages') }}">Stages</a></li>
		<li class="waves-effect white-text"><a href="{{ route('contact') }}">Contact</a></li>
		<li class="container"><div class="divider"></div></li>
		@guest
		<li><a class="white-text waves-effect" href="{{ route('login') }}">S'identifier</a></li>
		<li><a class="white-text waves-effect" href="{{ route('register') }}">Créer un compte</a></li>
		@endguest
		@auth
		<li><a class="waves-effect white-text" href="{{ route('post.index') }}">Administrer</a></li>
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
</div>
@push('scripts')
    <script defer src="{{ asset('js/scripts/initMaterialize.js') }}"></script>
@endpush