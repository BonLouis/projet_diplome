@extends('layouts.master')

@section('title')
{{ $title }}
@endsection

@section('content')

@if($path === '/')
<h2 class="center-align" id="home-h2">Nos deux prochains cursus</h2>
@endif

@include('partials.cards.post', compact('posts'))

@endsection