<!DOCTYPE html>
<html>
<head>
	<title>PRP</title>
	<meta name="csrf-token" content="<?= csrf_token() ?>" id="csrf-token">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="<?= asset('css/jquery-ui.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= asset('css/custom.css') ?>">
	<script src="https://use.fontawesome.com/7ea9864ee7.js"></script>
</head>
<body style="background-color: #E9ECEF;">
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