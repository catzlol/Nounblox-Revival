<?php
include('include.php');
?>
<center>
    <h1 style="color: black;">What's up, <?php echo $_USER['username']; ?></h1>
    <h3 style="color: blue;">Not Dangerous</h3>
    <a style="color: blue;" href="ban.php">ban or unban someone</a><br>
    <a style="color: blue;" href="sitealerts.php">Change Site Alerts</a><br>
    <a style="color: blue;" href="altidentification.php">Alt identification</a><br>
    <a style="color: blue;" href="currencygift.php">Currency Gift</a><br>
    <a style="color: blue;" href="givebuildersclub.php">Give Builders Club</a><br>
    <a style="color: blue;" href="uploadasset.php">Upload an asset</a><br>

    <h3 style="color: red;">Dangerous</h3>
    <a style="color: red;" href="maintenance.php">Enable Maintenance Mode</a><br>
    <hr>
       <h3>RCCService (Avatar Rendering System)</h3>
    <p>Go to the main admin page to see the RCC status</p>
<hr>
    <h3>Site</h3>
    <p><?=php_uname()?></p>
    <p style="color: grey;"><?=PHP_OS?></p>
    <p>Host name: <?=gethostname()?></p>
</center>
<?php include('finclude.php'); ?>