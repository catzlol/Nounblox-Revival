<?php require_once($_SERVER['DOCUMENT_ROOT']."/core/config.php"); ?>
<?php
$id = (int)$_GET["id"];
$echothing = "";
$sql = "SELECT * FROM wearing WHERE userid='".$id."';";
$result = mysqli_query($link, $sql);
$resultCheck = mysqli_num_rows($result);
  
if ($resultCheck > 0) {
while ($row = mysqli_fetch_assoc($result)) {
$itemq = mysqli_query($link, "SELECT * FROM catalog WHERE id='".$row['itemid']."'") or die(mysqli_error($link));
$item = mysqli_fetch_assoc($itemq);
$echothing = $echothing."http://".$_SERVER["HTTP_HOST"]."/asset/?id=".$item['assetid'].";";
}}
$echothing = $echothing."http://".$_SERVER["HTTP_HOST"]."/asset/BodyColors.ashx?userId=".$id;
echo $echothing;
?>