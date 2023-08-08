<?php

require("../core/config.php");

if(isset($_POST['pose'])){

$color = mysqli_real_escape_string($link, $_POST['pose']);

$newcolor = mysqli_query($link, "UPDATE users SET pose='$color' WHERE id='$_USERID'") or die("ERR:".mysqli_error($link));

}

header("Location: /api/render.php?id=".$_USERID); die(); exit;

?>