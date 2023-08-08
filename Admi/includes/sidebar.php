<?php
if(!isset($_MODERATOR) || $_MODERATOR !== true)
{
	die();
}
?>
<a href="../Start"><img src="../webimg/Dynamica.png" width="150px"/></a><br />
Admin Panel
<br /><br /><br />
	<a href="./index">Home</a><br />
	<a href="./placelist">Place Moderation</a><br />
	<a href="./model">Model Moderation</a><br />
	<a href="./clotheslist">Clothes Moderation</a><br />
	<a href="./report">Report Moderation</a><br />
	<a href="./modlog">Moderation Logs</a><br />
	<a href="./banlist">Ban Listing</a><br />
	<a href="./shutdown">Emergency Site Shut Down</a><br />