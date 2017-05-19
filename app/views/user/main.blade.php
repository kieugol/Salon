<?php
$_images = Config::get('site.url_image');
$_font = Config::get('site.url_fonts');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		@yield('css')
	</head>
	<body class="big-salon">
		<div id="wrapper">
			<input type="hidden" id="base_url" name="base_url" value="<?php echo Asset('/') ?>">
			@include('user.header')
			<!--Star-Content./-->
			@yield('content')
			<!--Start-Footer./-->
			@include('user.footer')
		</div>
		@yield('script')
		<script>
			$('#contact').click(function(event) {
				$('html, body').animate({scrollTop:$(document).height()},1500);
			});
		</script>
	</body>
</html>