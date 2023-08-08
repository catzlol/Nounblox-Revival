<?php
$num = (int) $_GET["num"];
$numDone = 0;
while ($numDone < $num) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, "http://www.".$_SERVER["SERVER_NAME"]."/asset/?id=" . rand(1, getrandmax()));
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $assetContent = str_replace("roblox.com", $_SERVER["SERVER_NAME"], curl_exec($ch));
    $numDone += 1;
}
echo "Requested downloading ".$num." random assets<br>";
echo "Downloaded " . $numDone . " random assets";