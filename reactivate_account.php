<?php
include($_SERVER['DOCUMENT_ROOT']."/core/config.php");
if($_USER['bantype'] == 'Ban') {header('location: /'); die();}
$unbanq = mysqli_query($link, "UPDATE `users` SET `bantype` = 'None', `banreason` = '' WHERE `users`.`username` = '".$_USER["username"]."'; ") or die(mysqli_error($link));
header('location: /');
?>