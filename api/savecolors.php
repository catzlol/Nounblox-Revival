<?php

require("../core/config.php");

if(isset($_POST['head'])){

$color = mysqli_real_escape_string($link, $_POST['head']);

$newcolor = mysqli_query($link, "UPDATE users SET HeadColor='$color' WHERE id='$_USERID'") or die("ERR:".mysqli_error($link));

}

if(isset($_POST['torso'])){

$color2 = mysqli_real_escape_string($link, $_POST['torso']);

$newcolor2 = mysqli_query($link, "UPDATE users SET TorsoColor='$color2' WHERE id='$_USERID'") or die("ERR:".mysqli_error($link));

}

if(isset($_POST['larm'])){

$color3 = mysqli_real_escape_string($link, $_POST['larm']);

$newcolor3 = mysqli_query($link, "UPDATE users SET LeftArmColor='$color3' WHERE id='$_USERID'") or die("ERR:".mysqli_error($link));

}

if(isset($_POST['rarm'])){

$color4 = mysqli_real_escape_string($link, $_POST['rarm']);

$newcolor4 = mysqli_query($link, "UPDATE users SET RightArmColor='$color4' WHERE id='$_USERID'") or die("ERR:".mysqli_error($link));

}

if(isset($_POST['lleg'])){

$color5 = mysqli_real_escape_string($link, $_POST['lleg']);

$newcolor5 = mysqli_query($link, "UPDATE users SET LeftLegColor='$color5' WHERE id='$_USERID'") or die("ERR:".mysqli_error($link));

}

if(isset($_POST['rleg'])){

$color6 = mysqli_real_escape_string($link, $_POST['rleg']);

$newcolor6 = mysqli_query($link, "UPDATE users SET RightLegColor='$color6' WHERE id='$_USERID'") or die("ERR:".mysqli_error($link));

}




//if (isset($_SERVER["HTTP_REFERER"])) {
//        header("Location: " . $_SERVER["HTTP_REFERER"]);
//}

header("Location: /api/render.php?id=".$_USERID); die(); exit;