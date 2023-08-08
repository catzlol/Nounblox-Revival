<?php
header("Content-type: text/plain");
include "../core/config.php";

if (!$isloggedin) {
  die("You are not logged in!");
}


$user_from = $_USER['id'];
$user_to = intval($_GET['id']);

if ($user_to < 1) {
  die ("Invalid ID.");
}

mysqli_query($link,"delete from friends where user_to = '".$_USER['id']."' and user_from = '".$user_to."'");

if ($_GET['from_rq_page']) {
  header("Location: /my/home.aspx");
} else {
  header("Location: /User.aspx?ID=".$user_to);
}

// header("Location: " . $_SERVER["HTTP_REFERER"]);
?>