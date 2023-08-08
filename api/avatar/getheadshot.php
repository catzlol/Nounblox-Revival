<?php require_once($_SERVER['DOCUMENT_ROOT']."/core/config.php");
$usridq = mysqli_query($link, "SELECT * FROM users WHERE id='".(int)$_GET['id']."'") or die(mysqli_error($link));
$usrid = mysqli_fetch_assoc($usridq);
header('location: http://roblock.cf/api/rbxavatar/headshot.php?id='.$usrid['rblxid']);
?>