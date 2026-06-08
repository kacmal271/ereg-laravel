<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

  @yield('head')
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- My Style -->
	<link rel='icon' href='{{ config('SVG-PATH') . '/favicon-ereg.ico' . '?v=' . time() }}' />
  {{-- Order of Inclusion: Does it matter ? --}}
  <link rel="stylesheet" href="{{ url('style/BiWork/biwork.css') . '?v=' . time() }}" />
  <link rel="stylesheet" href="{{ url('style/Gridwork/gridwork12.css') . '?v=' . time() }}" />

  {{-- CSRF Token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

</head>

<body>

  <div id="app" class="container">

    @yield('content')

  </div>

</body>

</html>
