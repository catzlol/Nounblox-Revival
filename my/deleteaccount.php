<?php
include($_SERVER['DOCUMENT_ROOT']."/core/config.php");
$banq = mysqli_query($link, "UPDATE `users` SET `bantype` = 'Ban', `banreason` = 'Your account has been deleted due to you pressing the Delete Account button.' WHERE `users`.`username` = '".$_USER["username"]."'; ") or die(mysqli_error($link));
echo 'Account succesfully deleted!';
header('location: /');
?>
