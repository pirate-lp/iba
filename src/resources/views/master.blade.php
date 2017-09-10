<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	    <title>
	    	@stack('title')
		    | LIL</title>

		<meta name="description" content="@stack('description')
			">


	    @stack('rssfeed')

	    <link rel="stylesheet" href="/css/pure.css" type="text/css">
		<link rel="stylesheet" href="/css/app.css" type="text/css">
		<link rel="stylesheet" href="/css/backgrounds.css" type="text/css">


		<link rel="stylesheet" href="/css/selectize.css" type="text/css">
		<link rel="stylesheet" href="/css/style.css" type="text/css">
		<link rel="stylesheet" href="/css/fonts.css" type="text/css">
		<link rel="stylesheet" href="/css/journal.css" type="text/css">
		<link rel="stylesheet" href="/css/ideas.css" type="text/css">

		<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700&amp;subset=latin-ext" rel="stylesheet">



	    <script type="text/javascript" src="/js/template.js"></script>
	    <link  href="/fotorama/fotorama.css" rel="stylesheet">
		<script src="/fotorama/fotorama.js"></script>
		<script src="/js/selectize.js"></script>


<link rel="apple-touch-icon-precomposed" sizes="57x57" href="http://lostideaslab.com/assets/favicon/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://lostideaslab.com/assets/favicon/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://lostideaslab.com/assets/favicon/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://lostideaslab.com/assets/favicon/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="http://lostideaslab.com/assets/favicon/apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="http://lostideaslab.com/assets/favicon/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="http://lostideaslab.com/assets/favicon/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="http://lostideaslab.com/assets/favicon/apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="http://lostideaslab.com/assets/favicon/favicon-196x196.png" sizes="196x196" />
<link rel="icon" type="image/png" href="http://lostideaslab.com/assets/favicon/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href="http://lostideaslab.com/assets/favicon/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="http://lostideaslab.com/assets/favicon/favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="http://lostideaslab.com/assets/favicon/favicon-128.png" sizes="128x128" />
<meta name="application-name" content="Lost Ideas Lab"/>
<meta name="msapplication-TileColor" content="#5A83AA" />
<meta name="msapplication-TileImage" content="http://lostideaslab.com/assets/favicon/mstile-144x144.png" />
<meta name="msapplication-square70x70logo" content="http://lostideaslab.com/assets/favicon/mstile-70x70.png" />
<meta name="msapplication-square150x150logo" content="http://lostideaslab.com/assets/favicon/mstile-150x150.png" />
<meta name="msapplication-wide310x150logo" content="http://lostideaslab.com/assets/favicon/mstile-310x150.png" />
<meta name="msapplication-square310x310logo" content="http://lostideaslab.com/assets/favicon/mstile-310x310.png" />
<meta name="msapplication-notification" content="frequency=30;polling-uri=http://notifications.buildmypinnedsite.com/?feed=http://lostideaslab.com/rssfeed/&amp;id=1;polling-uri2=http://notifications.buildmypinnedsite.com/?feed=http://lostideaslab.com/rssfeed/&amp;id=2;polling-uri3=http://notifications.buildmypinnedsite.com/?feed=http://lostideaslab.com/rssfeed/&amp;id=3;polling-uri4=http://notifications.buildmypinnedsite.com/?feed=http://lostideaslab.com/rssfeed/&amp;id=4;polling-uri5=http://notifications.buildmypinnedsite.com/?feed=http://lostideaslab.com/rssfeed/&amp;id=5;cycle=1" />


		<meta name="p:domain_verify" content="da70cf112667d986419921458fd912f4"/>

	</head>

	<body class="template-@yield('cssclass')
		">

	    @yield('body')

		@include('iba::modules.master.footer')

	</body>
</html>
