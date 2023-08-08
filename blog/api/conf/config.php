<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/core/config.php'); 
$baseurl = "/blog";
$db_host = DB_SERVER;
$db_username = DB_USERNAME;
$db_password = DB_PASSWORD;
$db_databasename = DB_NAME;

$db = new mysqli($db_host, $db_username, $db_password, $db_databasename);


?>