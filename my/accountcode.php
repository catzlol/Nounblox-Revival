<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/core/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/core/config.php';

if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}

$accountcode = $_USER['accountcode'];
?>
<h1>Your current Account Code is: <?php echo $accountcode; ?></h1>
<a href="/my/generateaccountcode.php"><h2>Generate new Account Code</h2></a>