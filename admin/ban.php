<?php include('include.php'); ?>
<?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usertoban = addslashes($_POST['usertoban']);
    $banreason = addslashes($_POST['banreason']);
    if($_POST['bantype'] == 'reminder') {$bantype = 'Reminder';} elseif($_POST['bantype'] == 'warning') {$bantype = 'Warning';} elseif($_POST['bantype'] == 'ban') {$bantype = 'Ban';} else {$bantype = 'None';}
    $banq = mysqli_query($link, "UPDATE `users` SET `bantype` = '".$bantype."', `banreason` = '".$banreason."', `bantime` = '".time()."' WHERE `users`.`username` = '".$usertoban."'; ") or die(mysqli_error($link));
} ?>
<center>
    <a href="index.php"><h1 style="color: black;">< Back</h1></a>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input name="usertoban" type="text" tabindex="1" class="Text" placeholder="User to ban"><br>
    <input id="bantype" type="radio" name="bantype" value="unban" checked="checked" tabindex="6"><label>Unban</label><br>
    <input id="bantype" type="radio" name="bantype" value="reminder" tabindex="6"><label>Reminder</label><br>
    <input id="bantype" type="radio" name="bantype" value="warning" tabindex="6"><label>Warning</label><br>
    <input id="bantype" type="radio" name="bantype" value="ban" tabindex="6"><label>Ban</label><br>
    <input name="banreason" type="text" tabindex="1" class="Text" placeholder="Ban Reason"><br>
    <input type="submit" value="(Un)ban" tabindex="4" class="Button" name="submit">

    </form>
           NOTICE: Do not be unprofessional in moderator notes.
</center>
<?php include('finclude.php'); ?>
      
 