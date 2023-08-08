<?php
header("Content-type: text/plain");

require("../core/config.php");

if (!$_USER) {
    die ("ERR:notloggedin");
} else {
    $username = $_USER['username'];
}

$color = $_GET['color'] or die("ERR:nocolor");
$part = $_GET['part'] or die("ERR:nopart");

$color = intval($color);

if ($part == "Head") {
    $dbval = "HeadColor";
} else if ($part == "Torso") {
    $dbval = "TorsoColor";
} else if ($part == "LeftArm") {
    $dbval = "LeftArmColor";
} else if ($part == "RightArm") {
    $dbval = "RightArmColor";
} else if ($part == "LeftLeg") {
    $dbval = "LeftLegColor";
} else if ($part == "RightLeg") {
    $dbval = "RightLegColor";
} else {
    die("ERR:invpart_" . $part);
}

$RobloxColor = array(
    1,          //1
    208,        //2
    194,        //3
    199,        //4
    26,         //5
    21,         //6
    24,         //7
    226,        //8
    23,         //9
    107,        //10
    102,        //11
    11,         //12
    45,         //13
    135,        //14
    106,        //15
    105,        //16
    141,        //17
    28,         //18
    37,         //19
    119,        //20
    29,         //21
    151,        //22
    38,         //23
    192,        //24
    104,        //25
    9,          //26
    101,        //27
    5,          //28
    153,        //29
    217,        //30
    18,         //31
    125,
    666         //32
);


if (!in_array($color, $RobloxColor)) {
    die ("ERR:invcolor");
} else {
  //Valid color and part: change avatar!
  $avq = mysqli_query($link, "SELECT * FROM `users` WHERE id='". $_USER['id'] ."'") or die ("ERR:".mysqli_error($connect));

  $_AVATAR = mysqli_fetch_assoc($avq);

  $_AVATAR[$dbval] = $color;

  $updusr = mysqli_query($link, "UPDATE users SET $dbval='$color' WHERE id='$CURRENT_USER_ID'") or die("ERR:".mysqli_error($connect));
  // $htmlclr = $RobloxColorsHtml[array_search($color, $RobloxColors)];
  die("done");
}

?>
