<!DOCTYPE html>
<html>
<head>
	<title>PRP</title>
	<meta name="csrf-token" content="<?= csrf_token() ?>" id="csrf-token">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://use.fontawesome.com/7ea9864ee7.js"></script>
</head>
<body>
	@include('layout.menu')
	@if(isset($view))
		@include($view)
	@endif
	@include('layout.menu_bottom')
	@include('layout.scripts')
</body>
</html>