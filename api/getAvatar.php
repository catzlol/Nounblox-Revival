<?php
include "../core/config.php";

if(!isset($_GET['page'])) {
    $size = 195;
}
    $size = $_GET['size'];



$userid = $_GET['id'];

if ($userid < 1) {
  die ("Invalid ID.");
}

$itemcheck = mysqli_query($connect, "SELECT * FROM avatar_cache WHERE userid='$userid'") or die(mysqli_error($connect));
$item = mysqli_fetch_assoc($itemcheck);
?>
<?php
if($item['hatid1'] == "1"){
				        echo"<div style='position:absolute; width:200; height:200; z-index:4;'><img width='$size' src='/assets/items/hats/1.png'></div>";
}
echo"<div style='width:200; height:200; z-index:0;'><img width='$size' src='/images/userthumbs/default.png'></div>";
?>