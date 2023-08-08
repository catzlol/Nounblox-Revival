<?php require_once($_SERVER['DOCUMENT_ROOT']."/core/config.php");
$usridq = mysqli_query($link, "SELECT * FROM users WHERE id='".(int)$_GET['id']."'") or die(mysqli_error($link));
$usrid = mysqli_fetch_assoc($usridq);
// $usrid['rblxid']

header("Content-Type: image/png");

if($usrid['thumb']){

echo base64_decode($usrid['thumb']);

}else{

// echo file_get_contents("/images/unavail.png");

header('location: /images/unavail.png');

}

// header('location: http://roblock.cf/api/rbxavatar/thumbnail.php?id=18');
?>
