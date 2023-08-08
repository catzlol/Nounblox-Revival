<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/config.php");
header('Content-Type:text/plain');
$id = (int)$_GET["game"];
$gameq = mysqli_query($link, "SELECT * FROM games WHERE id = '$id'");
$game = mysqli_fetch_assoc($gameq);
?>
dofile('http://<?=$_SERVER['HTTP_HOST'];?>/client/2010/host.php?port=<?php echo $game['port']; ?>') 
game:Load('http://<?=$_SERVER['HTTP_HOST'];?>/client/2010/gui.rbxm') 
game:FindFirstChild("Health-GUI").Parent = game.StarterGui 
