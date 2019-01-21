<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layouts.partials.head')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

  </head>

  <body>

	@include('layouts.partials.nav')

    @include('layouts.partials.header') 


	@yield('content')

	@include('layouts.partials.footer')
	
	@include('layouts.partials.footer-scripts')


  </body>
</html>