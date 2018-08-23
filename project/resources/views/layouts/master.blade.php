<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Toutes les formations</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1">
    <!-- <link href="{{asset('css/app.css')}}" rel="stylesheet"> -->
</head>
<body>
	<header>
		@include('partials.header')
	</header>
	@yield('content')
	<footer>
		@include('partials.footer')
	</footer>
</body>
</html>