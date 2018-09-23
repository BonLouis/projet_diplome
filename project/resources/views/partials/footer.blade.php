<footer class="page-footer blue-grey">
	<div class="container">
		<div class="row">
			<div class="col l5 s12">
				<h5 class="white-text"><img src="{{ asset('images/logo.png') }}" alt=""></h5>
			</div>
			<div class="col l5 offset-l2 s12">
				<h5 class="white-text" style="padding-left: .75rem;">Menu</h5>
				<ul class="col s6">
					<li><a class="grey-text text-lighten-3" href="{{ route('home') }}">Accueil</a></li>
					<li><a class="grey-text text-lighten-3" href="{{ route('showFormations') }}">Formations</a></li>
					<li><a class="grey-text text-lighten-3" href="{{ route('showStages') }}">Stages</a></li>
				</ul>
				<ul class="col s6">
					<li><a class="grey-text text-lighten-3" href="{{ route('contact') }}">Contact</a></li>
					<li>
						<a href="#search-modal" class="modal-trigger white-text waves-effect">Rechercher</a>
					</li>
					@admin
					<li><a class="grey-text text-lighten-3" href="{{ route('post.index') }}">Administrer</a></li>
					<li><a class="grey-text text-lighten-3" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}">Se déconnecter</a></li>
					@endadmin
				</ul>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			© 2018 Copyright
			<a class="grey-text text-lighten-4 right" href="https://github.com/BonLouis/projet_diplome">Github</a>
		</div>
	</div>
</footer>