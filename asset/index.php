<?php
// my ass burns
$id = (INT)$_GET["id"];

if(file_exists($id . ".txt")){
    header("Content-Type: text/plain");
    echo "\n";
    readfile($id);
}
else {
    header("Location: https://assetdelivery.roblox.com/v1/asset/?id=" . $id . "&version=1");
}
?>