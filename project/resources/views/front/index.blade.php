@extends('layouts.master')

@section('content')

{{-- <h1 class="center-align">{{ $title }}</h1> --}}

{{-- A trick to auto inject pagination
	if it's has been specified by the controller --}}
{{-- @includeWhen(method_exists($posts, 'links'), 'partials.paginate', compact('posts')) --}}

{{-- @forelse($posts as $post) --}}
@include('partials.cards.post', compact('posts'))
{{-- @empty --}}
	{{-- <h2>Nous n'avons aucune formation pour le moment.</h2> --}}
{{-- @endforelse --}}

{{-- @includeWhen(method_exists($posts, 'links'), 'partials.paginate', compact('posts')) --}}

@endsection