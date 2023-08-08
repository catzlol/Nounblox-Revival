<?php
    $id = (int)$_GET["id"];
if(!empty($_GET['id']))
{
    if (file_exists("s/" . $id)) { // regular asset
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"". hash('sha1', $id) ."\"");
        readfile("s/" . $id);
    } else { // regular asset that isn't in our asset folder, also necessary magic is used here
        // put the content of the file in a variable
        $data = file_get_contents("https://assetdelivery.roblox.com/v1/assetId/" . $id); 
        // JSON decode
        $obj = json_decode($data); 


        // header('Content-Type: '.mime_content_type($obj->location));
        // redirect to the location of the file
    echo str_replace("roblox.com", "nounblx.cf", file_get_contents($obj->location)); die();
    }
}
elseif(!empty($_GET['id']) && !empty($_GET['version']))
{ // version asset that certainly isn't in our asset folder, necessary magic is still used here
    // put the content of the file in a variable
    $data = file_get_contents("https://assetdelivery.roblox.com/v1/assetId/" . $_GET['id'] . "/version/" . $_GET['version']);
    // JSON decode
    $obj = json_decode($data); 
    // header('Content-Type: '.mime_content_type($obj->location));
    // redirect to the location of the file
    echo str_replace("roblox.com", "nounblx.cf", file_get_contents($obj->location)); die();
}
exit();