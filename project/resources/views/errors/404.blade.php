@extends('errors::layout')

@section('title', 'Error')

@section('message', 'Il semblerait que vous vous soyez perdu. Ne vous inquiétez pas, on s\'occupe de tout.')

<script>
	setTimeout(hey => {
		window.location.replace('{{route('home')}}')
	}, 2000);
</script>