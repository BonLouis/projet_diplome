@extends('layouts.master')

@section('title')
{{ $title }}
@endsection

@section('content')

@include('partials.cards.post', compact('posts'))

@endsection