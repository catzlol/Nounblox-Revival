<?php
error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT']."/core/config.php");


if($_GET['pass'] = "Y0umaydoitlolz"){
$link->query("INSERT INTO ingamechats (userid, message, time, client, place) VALUES ('".$_GET['user']."', '".$_GET['msg']."', '".time()."', '".$_GET['year']."', '".$_GET['place']."');");
}
?>