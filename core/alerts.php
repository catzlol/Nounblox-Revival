<?php
$qa = "SELECT * FROM alerts ORDER BY id DESC";
$ra = mysqli_query($link,$qa);
while($alertrow = mysqli_fetch_array($ra)){
$one = $row['text'];
$one = htmlspecialchars(str_replace('{domain}',$sitedomain,$one));
$cullah = htmlspecialchars($row['color']);
?>
<div class="SystemAlertText" style="background-color: <?=$cullah;?>">
            <div class="Exclamation">
            </div>
            <div id="sitealert1txt"><?=$one;?></div>
          </div>
        </div>
<?}?>