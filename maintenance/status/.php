<? include("../../core/header.php"); include("../../core/nav.php"); 

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
        $rson = true; $color = "green"; $line = "on";
    } else {
        $rson = false; $color = "red"; $line = "off";
    }
} else {
    $rson = false; $color = "red"; $line = "off";
}

$check = mysqli_query($conn, "SELECT * FROM users");                    
$usercount = mysqli_num_rows($check);

$oncheck = mysqli_query($conn, "SELECT * FROM users WHERE expiretime > ".time()."");                    
$onusercount = mysqli_num_rows($oncheck);

$experiencecheck = mysqli_query($conn, "SELECT * FROM games");                    
$experiencecount = mysqli_num_rows($experiencecheck);

?>

<div id="Body">
	<h2>Server Status</h2>
<ul>
	<li>ThumbnailServer: <span style="color:<?=$color;?>;"><?=$line;?>line</span></li>
	<li>Games: <span style="color:black;"><?=$experiencecount;?> <text style="color: green;">(N/A online)</text></span></li>
        <li>Users: <span style="color:black;"><?=$usercount;?> <text style="color: green;">(<?=$onusercount;?> online)</text></span></li>
</ul>
</div>

<? include("../../core/footer.php"); ?>