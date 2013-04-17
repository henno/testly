<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<link rel="stylesheet" href="assets/css/normalize.css">
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/main.css">
	<script src="assets/js/vendor/modernizr-2.6.2.min.js"></script>
	<style>
		body {
			padding-top: 60px;
		}
	</style>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="#">Project name</a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li class="active"><a href="<?= BASE_URL ?>tests">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="<?= BASE_URL ?>auth/logout">Logi välja</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div>
<div>
	<?php
	require 'views/'.$request->controller.'_'.$request->action.'_view.php';
	?>
</div>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<!-- Add your site or application content here -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
