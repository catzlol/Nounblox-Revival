<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/config.php");
if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}
$sql = "DELETE FROM `wearing` WHERE `wearing`.`itemid` = ".$_GET["id"]." AND `userid` = ".$_USER["id"]."";
mysqli_query($link, $sql) or die(mysqli_error($link));
header('location: /my/character?wtype='.$_GET["wtype"]);
?>