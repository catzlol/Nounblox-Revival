<?php require_once($_SERVER['DOCUMENT_ROOT']."/core/config.php");
$usridq = mysqli_query($link, "SELECT * FROM games WHERE id='".(int)$_GET['id']."'") or die(mysqli_error($link));
$usrid = mysqli_fetch_assoc($usridq);
// $usrid['rblxid']

header("Content-Type: image/png");

if($usrid['thumbnail']){

echo base64_decode($usrid['thumbnail']);

}else{

// echo file_get_contents("/images/unavail.png");

// header('location: /thumbs/default/game.png');

header('location: /images/unavail-160x100.png');

}

// header('location: http://roblock.cf/api/rbxavatar/thumbnail.php?id=18');
?>