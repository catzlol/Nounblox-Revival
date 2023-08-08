<?php

if(isset($_POST)){
    $assetxml = $_POST["xml"];
    $assetid = $_POST["id"];

    $myfile = fopen("/usr/home/catzloll/domains/nounblx.cf/public_html/asset/" . $assetid . ".txt", "w", false) or die("Unable to create file!");
    fwrite($myfile, $assetxml);

}