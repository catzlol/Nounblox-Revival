<?php header('Content-Type:text/plain'); if($_GET['accountcode'] == 'Guest') {include('guestplay.php'); die();} ?>
dofile("http://<?=$_SERVER['HTTP_HOST'];?>/client/2010/character.php?<?php echo $_SERVER["QUERY_STRING"]; ?>&") 
dofile("http://<?=$_SERVER['HTTP_HOST'];?>/client/2010/join.php?<?php echo $_SERVER["QUERY_STRING"]; ?>&") 
