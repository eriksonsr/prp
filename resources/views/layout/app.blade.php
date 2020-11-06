<!DOCTYPE html>
<html>
<head>
	<title>PRP</title>
	<meta name="csrf-token" content="<?= csrf_token() ?>" id="csrf-token">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<script src="https://use.fontawesome.com/7ea9864ee7.js"></script>
</head>
<body>
	@include('layout.menu')
	@if(isset($view))
		@include($view)
	@endif
	@include('layout.menu_bottom')
	@include('layout.scripts')
	@include('tags.md_add_tag')
	@include('toast_aviso')
</body>
</html>