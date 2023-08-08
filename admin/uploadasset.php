<?php include('include.php'); ?>
<?php
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
<?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
} ?>
<center>
<?php
if(!$rson == true){

    echo   "<h1>The rendering server is offline, you may not upload an asset.</h1>";
    echo '</center>';
    include('finclude.php');
    die();

}
?>
<h1>Instructions:</h1>
<p>Download the asset from roblox (it cannot be ugc) <br>open it in notepad, It should be in an xml format, if it is paste it below</p>
<p><b>NOTE: Please make sure the asset is approved by another admin</b></p>
<form method="post" action="/api/renderxml.php">
    <input type="text" name="id" placeholder="Enter asset ID here">
    <br><br>
    <input type="text" name="name" placeholder="Enter asset name here">
    <br><br>
    <input type="text" name="desc" placeholder="Enter asset description here">
    <br><br>
    <input type="text" name="id" placeholder="Enter asset Price here">
    <br><br>
    <textarea name="xml" placeholder="Enter asset XML here" required></textarea>
    <br>
    <input type="submit" value="Upload asset.">
</form>

<?php include('finclude.php'); ?>
</center>

      
