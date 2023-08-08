<?php include('include.php'); ?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usertogive = addslashes(mysqli_real_escape_string($link, $_POST['usertogive']));
    $expiredate = addslashes(mysqli_real_escape_string($link, $_POST['expiredate']));
    $givetype = addslashes(mysqli_real_escape_string($link, $_POST["bctype"]));
    mysqli_query($link, "UPDATE `users` SET `BC` = '".$givetype."', `BCExpire` = '".$expiredate."' WHERE `users`.`username` = '".$usertogive."'");
}
?>
<center>
    <a href="index.php"><h1 style="color: black;">< Back</h1></a>
    <form method="POST" action="">
    <input name="usertogive" type="text" tabindex="1" class="Text" placeholder="User to gift"><br>
    <input name="bctype" type="text" tabindex="1" class="Text" placeholder="Type"><br>
    <input name="expiredate" type="text" tabindex="1" class="Text" placeholder="Expiration Date"><br>
    <input type="submit" value="Give" tabindex="4" class="Button" name="submit">
    </form>
</center>
<?php include('finclude.php'); ?>