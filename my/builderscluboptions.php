<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/core/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/core/config.php';

if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}

$removebc = str_replace("'","\'",'None');
$sql = "UPDATE `users` SET `BC` = '".$removebc."' WHERE `users`.`id` = ".$_USER["id"].";";
mysqli_query($link, $sql);  
header('location: /my/settings');
?>
