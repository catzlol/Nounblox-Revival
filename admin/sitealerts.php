<?php include('include.php'); 

if($_POST['purge']){
$get = "DELETE FROM alerts";
$almost = mysqli_query($link,$get);
header("Location: /admin/sitealerts.php");
}

?>
<center>
    <a href="index.php"><h1 style="color: black;">< Back</h1></a>
<h1>Site Alerts</h1>
<form method="POST" action="">
<input type="submit" value="Add Alert" tabindex="4" class="Button" name="new"> 
<input type="submit" value="Purge All" tabindex="4" class="Button" name="purge">
</form>
<?php if($_POST['new']){
$q = "SELECT * FROM alerts ORDER BY id DESC LIMIT 1";
$r = mysqli_query($link,$q);
$almost = mysqli_fetch_array($r);
$ok = $almost['id'] + 1;
?>
    <hr>
    <form method="POST" action="">
    <h1>Site Alert <?=$ok;?></h1>
    <input name="submitnew" type="text" tabindex="1" class="Text" placeholder="Text" value=""><br>
    <input id="enabled1" type="radio" name="color" checked="checked" value="#dfa811" tabindex="6"><label>Orange</label>
    <input id="enabled1" type="radio" name="color" value="green" tabindex="6"><label>Green</label>
    <input id="enabled1" type="radio" name="color" value="red" tabindex="6"><label>Red</label>
    <input id="enabled1" type="radio" name="color" value="blue" tabindex="6"><label>Blue</label>
    <input id="enabled1" type="radio" name="color" value="black" tabindex="6"><label>Black</label>
    <input id="enabled1" type="radio" name="color" value="#7123db" tabindex="6"><label>Purple</label>
<br>
    <input type="submit" tabindex="4" class="Button" name="submit">
    </form>
<?}?>

<?php if($_POST['submitnew']){

$sql = "INSERT INTO alerts (text, color) VALUES ('".mysqli_real_escape_string($link,$_POST['submitnew'])."', '".mysqli_real_escape_string($link,$_POST['color'])."')";

mysqli_query($link,$sql);

header("Location: /admin/sitealerts.php");

}
?>

<?php if($_POST['editexisting']){
$get = "UPDATE alerts SET text = '".mysqli_real_escape_string($link,$_POST['editexisting'])."' WHERE id = '".mysqli_real_escape_string($link,$_POST['bruh'])."'";
$almost = mysqli_query($link,$get);
header("Location: /admin/sitealerts.php");
}

if($_POST['deleteexisting']){
$get = "DELETE FROM alerts WHERE id = '".mysqli_real_escape_string($link,$_POST['bruh'])."'";
$almost = mysqli_query($link,$get);
header("Location: /admin/sitealerts.php");
}
?>

<?php
$q = "SELECT * FROM alerts ORDER BY id DESC";
$r = mysqli_query($link,$q);
while($row = mysqli_fetch_array($r)){ 
?>
    <hr>
    <form method="POST" action="">
    <h1>Site Alert <?=$row['id'];?></h1>
    <input type="hidden" value="<?=$row['id'];?>" name="bruh">
    <input name="editexisting" type="text" tabindex="1" class="Text" placeholder="Text" value="<?=htmlspecialchars($row['text']);?>"><br>
    <input id="enabled2" type="radio" name="deleteexisting" value="delete" tabindex="6"><label>Delete</label><br>
    <input type="submit" tabindex="4" class="Button" name="submit">
    </form>
<?}?>
</center>
<?php include('finclude.php'); ?>