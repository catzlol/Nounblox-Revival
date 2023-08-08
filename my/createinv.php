<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/core/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/core/config.php';
if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}
if($_SERVER["REQUEST_METHOD"] == 'POST') {
    $newkey = mysqli_real_escape_string($link, htmlspecialchars($_POST["invkeytext"]));
    $sql = "INSERT INTO `invitekeys` (`id`, `invkey`, `isredeemed`, `creatorid`) VALUES (NULL, '".$newkey."', 'no', '".$_USER['id']."');";
    mysqli_query($link, $sql);
}
header('location: /my/invites');
?>
