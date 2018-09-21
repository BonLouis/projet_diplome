@extends('layouts.master')
@section('content')
<div class="row py-5">
	<div class="col s12 m12">
		<div class="card">
			<div class="card-content">
				<span class="card-title center-align"><h3>Nous contacter</h3></span>
				<form action="{{ route('contact.send') }}" method="POST" class="container">
					@csrf
					<div class="row">
						<div class="input-field col s12">
							<input class="{{ $errors->has('name') ? 'invalid' : '' }}" id="name" name="name" type="text"
							value="{{ old('name')}}" required>
							<label for="name">Votre nom</label>
							<span class="helper-text" data-error="Veuillez spécifier votre nom"></span>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input class="{{ $errors->has('email') ? 'invalid' : '' }}" id="email" name="email" type="email"
							value="{{ old('email')}}" required>
							<label for="email">Votre mail</label>
							<span class="helper-text" data-error="Précisez un email valide"></span>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<textarea id="body" name="body" class="materialize-textarea {{ $errors->has('body') ? 'invalid' : '' }}">{{ old('body') }}</textarea>
							<label for="body">Votre message</label>
							<span class="helper-text" data-error="Merci de mettre du contenu à votre message"></span>
						</div>
					</div>
					<div class="row right-align">
						<button class="btn waves-effect waves-light" type="submit">Envoyer
						<i class="material-icons right">send</i>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection