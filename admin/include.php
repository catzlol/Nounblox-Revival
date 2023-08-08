<?php require_once($_SERVER["DOCUMENT_ROOT"]."/core/config.php");
if($_USER['USER_PERMISSIONS'] !== 'Administrator') {header('location: /');}
include($_SERVER["DOCUMENT_ROOT"]."/core/header.php");
include($_SERVER["DOCUMENT_ROOT"]."/core/nav.php");
?>
