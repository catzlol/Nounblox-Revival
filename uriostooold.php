<?php
require ("core/header.php");
require ("core/nav.php");
?>
<h1>Your Operating System is too old for URI?</h1>
<h1>Go to "My <?=$sitename ?>", "Account Code".</h1>
<h1>Generate a new one and copy it</h1>
<h1>Now download the files listed below:</h1>
<a href="/download/Join.bat"><p>Join.bat</p></a>
<a href="/download/Host.bat"><p>Host.bat (needed only if you want to make a game)</p></a>
<h1>Put Join.bat and Host.bat inside your client folder</h1>
<h1>Put the PlaceId, and your account code.</h1>
<h1>Now Play</h1>
<h5><?=$sitename?> currently supports Windows 7 - Windows 11, if you have Windows 7 or above,the URI will work</h5>
<?php
require ("core/footer.php");
?>