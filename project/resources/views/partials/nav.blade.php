<div id="header">
	<h1 class="center-align white-text">
		@yield('title')
	</h1>

	<div id="scroll-down">
		<div>
			<i class="medium material-icons white-text">keyboard_arrow_down</i>
			<i class="medium material-icons white-text">keyboard_arrow_down</i>
			<i class="medium material-icons white-text">keyboard_arrow_down</i>
		</div>
	</div>
	<nav id="pin" class="blue-grey">
		<div class="nav-wrapper">
			<a href="/" class="brand-logo"><img src="{{asset('images/logo.png')}}" alt=""></a>
			{{-- Nav for desktop --}}
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li>    
					<a href="#search-modal" class="modal-trigger"><i class="white-text material-icons prefix">search</i></a>
				</li>
				<li class="white-text"><a href="/">Accueil</a></li>
				<li class="white-text"><a href="/formations">Formations</a></li>
				<li class="white-text"><a href="/stages">Stages</a></li>
				<li class="white-text"><a href="/contact">Contact</a></li>
				@admin
				<li><a class="waves-effect white-text" href="{{ route('post.index') }}">Administrer</a></li>
				<li><a class="waves-effect white-text" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}">Se déconnecter</a></li>
				@endadmin
			</ul>
		  	<a href="#" data-target="sidenav" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
			{{-- Side nav for mobile, trigger on nav --}}
		</div>
	</nav>
	<ul id="sidenav" class="sidenav blue-grey">
		<li><a class="waves-effect white-text" href="/">Accueil</a></li>
		<li><a class="waves-effect white-text" href="/formations">Formations</a></li>
		<li><a class="waves-effect white-text" href="/stages">Stages</a></li>
		<li><a class="waves-effect white-text" href="/contact">Contact</a></li>
		<li>    
			<a href="#search-modal" class="modal-trigger white-text waves-effect">Rechercher</a>
		</li>
		@admin
		<li class="container"><div class="divider"></div></li>
		<li><a class="waves-effect white-text" href="{{ route('post.index') }}">Administrer</a></li>
		<li><a class="waves-effect white-text" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}">Se déconnecter</a></li>
		@endadmin
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