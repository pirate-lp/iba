<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>
			@stack('title')
			| {{ config('app.name') }}</title>

		<meta name="description" content="
			@stack('description')
		">
		
		
		<script type="text/javascript" src="/iatelier/atelier/js/analog.js"></script>
		
		<link rel="stylesheet" href="/iatelier/atelier/css/style.css">
<!-- 		<link rel="stylesheet" href="/lil-plp/atelier/css/selectize.css"> -->

		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>

	<body>
	
		@yield('body')
		
	</body>
</html>