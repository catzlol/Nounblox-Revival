<?php
include('include.php');
$renderServerCurl = curl_init();
curl_setopt($renderServerCurl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($renderServerCurl, CURLOPT_URL, $renderServerUrl);
curl_setopt($renderServerCurl, CURLOPT_SSL_VERIFYPEER, false);
$renderServerResult = curl_exec($renderServerCurl);
$RShttpCode = curl_getinfo($renderServerCurl, CURLINFO_HTTP_CODE);
curl_close($renderServerCurl);
if ($RShttpCode == 200 || $RShttpCode == 500) {
    $fuckYou = 'SOAP-ENV:Client';
    if (strpos($renderServerResult, $fuckYou) !== false) {
        $rson = true;
    } else {
        $rson = false;
    }
} else {
    $rson = false;
}
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
    <p>O<?if($rson){?>n<?}else{?>ff<?}?>line</p>
<hr>
    <h3>Site</h3>
    <p><?=php_uname()?></p>
    <p style="color: grey;"><?=PHP_OS?></p>
    <p>Host name: <?=gethostname()?></p>
</center>
<?php include('finclude.php'); ?>