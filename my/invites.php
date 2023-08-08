<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/core/nav.php';
if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}
?>
<center>
    <form method="POST" action="createinv.php">
    <h1>Invite Someone</h1>
    <input name="invkeytext" type="text" tabindex="1" class="Text" placeholder="Type your key." value=""><br>
    <br>
    <input type="submit" value="Create an invite key" tabindex="4" class="Button" name="submit">
    </form>
</center>
