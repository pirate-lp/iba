<!DOCTYPE html>
<html lang="en">
	
	<head>
	    <meta charset="utf-8" />
	    
	    
	    <title>
	    	@stack('title')
		     | {{ config('app.name') }}'s IBA
		</title>
		
		<meta name="description" content="Interactive Books' Atelier of {{ config('app.name') }}">
		
		<link rel="stylesheet" href="/lil-plp/iba/css/backend.css" type="text/css">
		
		@stack('head')
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
	</head>
	
	<body>
		<script>
			Window.Config = <?php echo json_encode(config('iba')); ?>;
		</script>
		<div id="app"></div>
		<script src="/lil-plp/iba/js/index.js"></script>
	</body>
</html>
