<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>TITLE</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

  <!-- Stylesheets -->
  <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/swiper.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/ionicons.css') }}" rel="stylesheet">
	{{-- Toastr --}}
	<link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

	@stack('css')
</head>
<body >

	@include('layouts.frontend.partial.header')

	@yield('content')

	@include('layouts.frontend.partial.footer')

	<!-- SCIPTS -->
	<script src="{{ asset('frontend/js/jquery-3.1.1.min.js') }}"></script>
	<script src="{{ asset('frontend/js/tether.min.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
	<script src="{{ asset('frontend/js/swiper.js') }}"></script>
	<script src="{{ asset('frontend/js/scripts.js') }}"></script>
	{{-- Toastr --}}
	<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  {!! Toastr::message() !!}
  @stack('js')

</body>
</html>
