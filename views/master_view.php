<!DOCTYPE html>
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
<html class="no-js lt-ie9 lt-ie8">
<html class="no-js lt-ie9">
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Testly</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
	<script src="<?=ASSETS_URL ?>js/vendor/modernizr-2.6.2.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?=ASSETS_URL?>js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<script src="<?=ASSETS_URL?>js/plugins.js"></script>
	<script src="<?=ASSETS_URL?>js/main.js"></script>
	<script>BASE_URL = '<?=BASE_URL?>'</script>

	<?if(!EMPTY($this->scripts)) : ?>
		<?foreach($this->scripts as $script) : ?>
			<script src="<?=ASSETS_URL?>js/<?=$script?>"></script>
		<?endforeach?>
	<?endif?>

	<style>
		body {
			padding-top: 60px;
		}
		body, html {
			background: url('<?=BASE_URL?>assets/img/black-texture.jpg');
			height: 100%;
		}
		.container2
		{
			margin-left: 90px;
			margin-top: 50px;
		}
		table.table-bordered tr {
			background-color: #F5F5DC;

		}
		table.table-bordered th {
			text-align: center;
			background-color: #FACA69;
			opacity:0.5;
			filter:alpha(opacity=50); /* For IE8 and earlier */
		}

		table.table-bordered td {
			padding-left: 15px;
		}
	</style>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" >
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="nav-collapse collapse">
				<ul class="nav" >

					<li><a  href="#" class="brand" style="pointer-events: none; cursor: default; color: #003881 !important;">Testly</a></li>
					<li id="li_tests"><a   href="<?=BASE_URL?>tests">Testid</a></li>
					<li id="li_groups"><a   href="<?=BASE_URL?>groups">Grupid</a></li>
					<li id="li_students"><a   href="<?=BASE_URL?>students">Õpilased</a></li>
				</ul>
			</div><!--/.nav-collapse -->
			<div class="pull-right">
				<ul class="nav" >
					<li id="li_info"><a href="<?=BASE_URL?>info">Info</a></li>
					<li><a href="<?=BASE_URL?>auth/logout">Logi välja</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="container2">
	<?php
	require 'views/'.$request->controller.'_'.$request->action.'_view.php';
	?>
</div>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

</body>
</html>

<script type="text/javascript">
	function GetCurrentPageName() {
		//method to get Current page name from url.
		var PageURL = document.location.href;
		var PageName = PageURL.substring(PageURL.lastIndexOf('/') + 1);

		return PageName.toLowerCase() ;
	}

	$(document).ready(function(){
		var CurrPage = GetCurrentPageName();

		switch(CurrPage){
			case 'tests':
				$('#li_tests').addClass('active') ;
				break;
			case 'groups':
				$('#li_groups').addClass('active') ;
				break;
			case 'students':
				$('#li_students').addClass('active') ;
				break;
			case 'info':
				$('#li_info').addClass('active') ;
				break;
		}
	});
</script>