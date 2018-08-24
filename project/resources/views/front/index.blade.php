@extends('layouts.master')

@section('content')

<h1>Nos prochaines formations</h1>

@forelse($posts as $post)
	@include('partials.postCard')
@empty
	<h2>Aucune formation à venir.</h2>
@endforelse

@endsection