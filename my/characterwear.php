<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/config.php");
if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}
$sql1 = "SELECT * FROM wearing WHERE itemid = '".$_GET["id"]."' AND userid = '".$_USER["id"]."';";
$result1 = mysqli_query($link, $sql1);
$resultCheck1 = mysqli_num_rows($result1);
if ($resultCheck1 > 0) {
while ($row = mysqli_fetch_assoc($result1)) {
    header('location: /my/character?wtype='.$_GET["wtype"]); die();
}}
$sql = "INSERT INTO `wearing` (`id`, `userid`, `itemid`) VALUES (NULL, '".$_USER["id"]."', '".$_GET["id"]."'); ";
mysqli_query($link, $sql) or die(mysqli_error($link));
header('location: /my/character?wtype='.$_GET["wtype"]);
?>