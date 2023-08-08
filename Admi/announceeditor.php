<?php
session_start();
include("./includes/prestart.php");

if(isset($_POST['sbutton'])){
	$afile = fopen("../announcement.txt", "w");
	$input = $_POST['atext'];
	
	fwrite($afile, $input);
	fclose($afile);
}
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
			<center>
				<h1>Announcment Editor</h1>
				<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
					<input type="text" size="100" name="atext"></input>
					<input type="submit" value="Submit" name="sbutton"></input>
				</form>
			</center>
		</div>
	</body>
</html>