<?php
session_start();
include("./includes/prestart.php");

$GLOBALS['db'] = new mysqli('db682268557.db.1and1.com', 'dbo682268557', 'Helios@18', 'db682268557');
if($GLOBALS['db']->connect_errno > 0){
    die('Unable to connect to database');
}


if(isset($_POST['submit']))
{
	$sql = "SELECT Pass, UserId, VerCode FROM users WHERE UserName = '".$_SESSION['user_name']."' COLLATE latin1_general_cs";
	if(!$result = $GLOBALS['db']->query($sql)){
    	die("error");
	}
	$g = $result->fetch_assoc();
	if(password_verify($_POST['pass'],$g['Pass']))
	{
		$f = fopen("../.htaccess", "a+");
	fwrite($f, "
RewriteEngine on
RewriteCond %{REQUEST_URI} !^/ide/util/Security.php$
RewriteCond %{REQUEST_URI} !\.(gif|jpe?g|png|css|js)$
RewriteRule .* /ide/util/Security.php [L,R=302]
#emergency shutdown by " . $_SESSION['user_name']);
	fclose($f);
	
	}
header("Location: http://androdome.com/ide/Start.php");
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
		<form method="post">
			<table border width="99%" bgcolor="#EEEEEE">
				<tr bgcolor="lightsteelblue"><th colspan="2" >Input your password to continue</th></tr>
				<tr><th><input type="password" name="pass"/></th><th><input type="submit" name="submit" value="Shutdown"/></th></tr>
			</table>
		</form>
		</div>
	</body>
</html>