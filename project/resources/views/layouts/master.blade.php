<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <header>
        @include('partials.nav')
    </header>

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    
    @include('partials.loader')
    <!--
        Not defered script,
        loaded first
    -->
    <script src="{{ asset('js/scripts/beforeDOMLoad.js') }}"></script>
    <!--
        Childs scripts will be put here
    -->
    @stack('scripts')
    {{-- 
        His name says everything.
     --}}
    @include('partials.messager')
    {{-- 
     --}}
    @include('partials.search')

</body>
</html>