<?php
session_start();
include("./includes/prestart.php");
?>

<html>
	<head>
	<link rel="stylesheet" type="text/css" href="topbar.css">
	<style>
	</style>
	</head>

	<body bgcolor="#DDDDDD" style="margin: 0px; padding: 0px; font-family: Verdana;">
		<div style="background-color:#EEEEEE; border-right: outset 2px #EEEEEE; width: 15%; height: 100%; padding-left: 5px; padding-top: 5px; float: left;">
			<?php
				include("./includes/sidebar.php");
			?>
		</div>
		<div style="width: 84%; float: right;">
			
		</div>
	</body>
</html>