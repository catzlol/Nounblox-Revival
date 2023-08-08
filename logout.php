<?php
include("core/config.php");
if($_USER){
$link->query("UPDATE users SET expiretime='$now' WHERE id='$_USERID'");
}
$_SESSION = array();
session_destroy();
header("location: /");
?>
