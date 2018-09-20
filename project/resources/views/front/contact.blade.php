@extends('layouts.master')
@section('content')
<form action="{{ route('contact.send') }}" method="POST" class="container">
	@csrf
	<div class="row">
		<div class="input-field col s12">
			<input class="{{ $errors->has('name') ? 'invalid' : '' }}" id="name" name="name" type="text"
			value="{{ old('name')}}">
			<label for="name">Votre nom</label>
			<span class="helper-text" data-error="Veuillez spécifier votre nom"></span>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input class="{{ $errors->has('email') ? 'invalid' : '' }}" id="email" name="email" type="email"
				value="{{ old('email')}}">
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
		<button class="btn waves-effect waves-light" type="submit">Envoyer
		<i class="material-icons right">send</i>
		</button>
	</form>
	@endsection