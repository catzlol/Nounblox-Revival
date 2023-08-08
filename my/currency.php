<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/core/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/core/config.php';

if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}

$brickamt = 0;
$studamt = 0;

$users = mysqli_query($conn, "SELECT robux, tix FROM users") or die(mysqli_error($connect));

while ($user = mysqli_fetch_assoc($users)) {
  $brickamt = $brickamt + $user['robux'];
  $studamt = $studamt + $user['tix'];
}
?>
<title><?=$title?></title>
<label for="ctl00_cphRoblox_Password" id="ctl00_cphRoblox_LabelPassword" class="Label">Tix:</label>&nbsp;<input type="password" name="password" id="ctl00_cphRoblox_Password" tabindex="2" class="TextBox">
<label for="ctl00_cphRoblox_Password" id="ctl00_cphRoblox_LabelPassword" class="Label">Bux:</label>&nbsp;<input type="password" name="password" id="ctl00_cphRoblox_Password" tabindex="2" class="TextBox">
<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/footer.php';
?>