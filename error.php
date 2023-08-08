<?php
if(!$sitename){include 'core/config.php';}
$title = $sitename.' | Missing Item';
include 'core/header.php';
include 'core/nav.php';
?>
<style>.Navigation{display:none!important;}#Alerts{display:none!important;}#Authentication{display:none!important;}#Settings{display:none!important;}</style>
<br>
<br>
<br>
<br>
<h2 style="text-align:center">The item you requested does not exist</h2>
<br>
<br>
<br>
<br>
<?
include 'core/footer.php';
?>