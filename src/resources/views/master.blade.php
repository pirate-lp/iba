<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	    <title>@stack('title') | {{ config('app.name') }}</title>

		<meta name="description" content="@stack('description')">

	</head>

	<body class="template-@yield('cssclass')">

	    @yield('body')

		@include('iba::modules.master.footer')

	</body>
</html>
