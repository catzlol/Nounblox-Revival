<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/core/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/core/config.php';

if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}
  
$allowedtypes = [
  "tshirt",
  "shirt",
  "pants",
  "hat",
  "face"
];
$querytype = addslashes($_GET["wtype"]);
if(!in_array($querytype,$allowedtypes)) {
  $querytype = "hat";
}

function colorlist($part) {

return '
<select id="'.$part.'" name="'.$part.'">
    <option value="119">Br. yellowish green</option>
                         <option value="24">Bright yellow</option>
                         <option value="106">Bright orange</option>
                         <option value="21">Bright red</option>
                         <option value="106">Bright violet</option>
                         <option value="23">Bright blue</option>
                         <option value="107">Bright bluish green</option>
                         <option value="37">Bright green</option>
                         <option value="1001">Institutional white</option>
                         <option value="1">White</option>
                         <option value="208">Light stone grey</option>
                         <option value="1002">Mid gray</option>
                         <option value="194" selected="">Medium stone grey</option>
                         <option value="199">Dark stone grey</option>
                         <option value="26">Black</option>
                         <option value="1003">Really black</option>
                         <option value="1022">Grime</option>
                         <option value="105">Br. yellowish orange</option>
                         <option value="125">Light orange</option>
                         <option value="153">Sand red</option>
                         <option value="1023">Lavender</option>
                         <option value="135">Sand blue</option>
                         <option value="102">Medium blue</option>
                         <option value="151">Sand green</option>
                         <option value="5">Brick yellow</option>
                         <option value="226">Cool yellow</option>
                         <option value="133">Neon orange</option>
                         <option value="101">Medium red</option>
                         <option value="9">Light reddish violet</option>
                         <option value="11">Pastel Blue</option>
                         <option value="1018">Teal</option>
                         <option value="29">Medium green</option>
                         <option value="1030">Pastel brown</option>
                         <option value="1029">Pastel yellow</option>
                         <option value="1025">Pastel orange</option>
                         <option value="1016">Pink</option>
                         <option value="1026">Pastel violet</option>
                         <option value="1024">Pastel light blue</option>
                         <option value="1027">Pastel blue-green</option>
                         <option value="1028">Pastel green</option>
                         <option value="1008">Olive</option>
                         <option value="1009">New Yeller</option>
                         <option value="1005">Deep orange</option>
                         <option value="1004">Really red</option>
                         <option value="1032">Hot pink</option>
                         <option value="1010">Really blue</option>
                         <option value="1019">Toothpaste</option>
                         <option value="1020">Lime green</option>
                         <option value="217">Brown</option>
                         <option value="18">Nougat</option>
                         <option value="38">Dark orange</option>
                         <option value="1031">Royal purple</option>
                         <option value="1006">Alder</option>
                         <option value="1013">Cyan</option>
                         <option value="45">Light blue</option>
                         <option value="1021">Camo</option>
                         <option value="192">Reddish brown</option>
                         <option value="1014">CGA brown</option>
                         <option value="1007">Dusty Rose</option>
                         <option value="1015">Magenta</option>
                         <option value="1012">Deep blue</option>
                         <option value="1011">Navy blue</option>
                         <option value="28">Dark green</option>
                         <option value="141">Earth green</option>
      </select>
';
}


?>
<div id="Body">
    <style>

  .clothe
  {
    width:110px;
    /*height: 200px;*/
    margin: 10px;
    text-align: left;
    
    vertical-align: top;
    display: inline-block;
    display: -moz-inline-stack;
    *display: inline;
  }
  .clothe .name {
    font-weight: bold;
  }
  .nocl
  {
    font-family: Verdana;
    font-weight: bold;
    text-align: center;
  }
  .img{
    border:none;
    height: 100%;
  }
  .imgc
  {
    border:1px solid black;
    width: 110px;
    height: 110px;
    text-align: center;
    padding: 10px;
    position: relative;
  }
  .fixed
  {
    position:absolute;
    right:0;
    top:0;
    background-color: #EEEEEE;
    border: 1px solid #555555;
    color: blue;
    font-family: Verdana;
    font-size: 10px;
    font-weight: lighter;
  }
  #left{
    width: 69%;
    float: left;
  }
  #right{
    width: 30%;
    float: right;
  }
  #Body table
  {
    border: 1px black solid;
  }
  .tablehead
  {
    font-size:16px; font-weight: bold; border-bottom:black 1px solid; width: 100%; background-color: #CCCCCC; color: #222222;
  }
  .tablebody
  {
    font-weight: lighter; background-color: transparent;font-family: Verdana;
  }
  .margin{
    margin:10px;
  }
  .clickable, .clickable3, .clickable2
  {
    border: none;
    margin:1px;
  }
  .clickable{
    width:50px;
    height: 50px;
  }
  .clickablesm{
    width:40px;
    height:40px;
    margin:5px;
  }
  .clickable2{
    width:47px;
    height: 100px;
  }
  .clickable3{
    width:100px;
    height: 100px;
  }
  .nonsbtn
  {
    font-weight:normal;
  }
  #col{
    position: fixed;
    top: 50%;
    left: 50%;
    margin-top: -105px;
    margin-left: -205px;
    width: 410px;
    height: 210px;
    z-index: 498;
    background-color: white;
    text-align: center;
    vertical-align: center;
  }
  .tablebody a {
      color:blue;
  }
  .tablebody a:hover {
      cursor:pointer;
  }
#left {
    width: 69%;
    float: left;
}
.clickable2 {
    width: 47px;
    height: 100px;
}
.clickable3 {
    width: 100px;
    height: 100px;
}
#right {
    width: 30%;
    float: right;
}
.tablebody {
    font-weight: lighter;
    background-color: transparent;
    font-family: Verdana;
}
.clickable {
    width: 50px;
    height: 50px;
}
.clickable, .clickable3, .clickable2 {
    border: none;
    margin: 1px;
}
#Body table {
    border: 1px black solid;
}
.tablehead {
    font-size: 16px;
    font-weight: bold;
    border-bottom: black 1px solid;
    width: 100%;
    background-color: #CCCCCC;
    color: #222222;
}
</style>
<div id="left">
  <table cellspacing="0px" width="100%" style="margin-bottom:10px;">
    <tbody><tr>
        <th class="tablehead">My Wardrobe</th>
    </tr>
    <tr>
        <?php
        echo"
        <td class=\"tablebody\" style=\"font-size:12px; text-align: center; border-bottom: 1px solid black;\">
        ";
        if($querytype == "tshirt") {
        echo"<a id=\"btn2\" href=\"/my/character?wtype=tshirt\" style=\"font-weight: bold;\">T-Shirts</a>";
        }else{
        echo"<a id=\"btn2\" href=\"/my/character?wtype=tshirt\">T-Shirts</a>";
        }
        if($querytype == "shirt") {
        echo"             |             <a id=\"btn5\" href=\"/my/character?wtype=shirt\" style=\"font-weight: bold;\">Shirts</a>";
        }else{
        echo"             |             <a id=\"btn2\" href=\"/my/character?wtype=shirt\">Shirts</a>";
        }
        if($querytype == "pants") {
        echo"             |             <a id=\"btn5\" href=\"/my/character?wtype=pants\" style=\"font-weight: bold;\">Pants</a>";
        }else{
        echo"             |             <a id=\"btn2\" href=\"/my/character?wtype=pants\">Pants</a>";
        }
        if($querytype == "hat") {
        echo"             |             <a id=\"btn5\" href=\"/my/character?wtype=hat\" style=\"font-weight: bold;\">Hats</a>";
        }else{
        echo"             |             <a id=\"btn2\" href=\"/my/character?wtype=hat\">Hats</a>";
        }
        if($querytype == "face") {
        echo"             |             <a id=\"btn5\" href=\"/my/character?wtype=face\" style=\"font-weight: bold;\">Face</a>";
        }else{
        echo"             |             <a id=\"btn2\" href=\"/my/character?wtype=face\">Face</a>";
        }
        echo"
        <br><a href=\"/Catalog.aspx\">Shop</a>
        </td>";
        ?>
    </tr>
    <tr>
        <td class="tablebody">
            <div id="wardrobe" style="padding-left:13px;">
                  <?php
                  $itemsq = mysqli_query($link, "SELECT * FROM owned_items WHERE ownerid='".$_USER["id"]."' AND type='".$querytype."'") or die(mysqli_error($link));
                                  while($row = mysqli_fetch_assoc($itemsq)) {
                  $itemq = $link->query("SELECT * FROM catalog WHERE id='".$row['itemid']."'") or die(mysqli_error($link));

                                $item = mysqli_fetch_assoc($itemq);
                                
                                $thumburl = $item['thumbnail'];
                                
                  $iteml = $link->query("SELECT * FROM users WHERE id='".$item['creatorid']."'") or die(mysqli_error($link));

                                $user = mysqli_fetch_assoc($iteml);
                  



                  $id = htmlspecialchars($row['assetid']);
                  $name = htmlspecialchars($item['name']);
                  $creator = htmlspecialchars($user['username']);
                  

                  echo"<div class='clothe' style='font-size:10.85px; display:inline-block; *display:inline; margin:5px; display: inline-block; display: -moz-inline-stack; *display: inline; vertial-align:top;'>
                          <div id='$name' class='imgc' style='cursor:pointer;'><img class='img' src='$thumburl'>
                            <div class='fixed'><a href=\"/my/characterwear.php?id=".$item['id']."&wtype=".$querytype."\">[ wear ]</a></div>
                          </div>
                          <a class='name' href='/Catalog/item.php?id=$id'>$name</a><br>
                          Type: Hat<br>
                          Creator: <a href='/user/?id={$item['creator']}'>$creator</a>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                  

                                  }
                                  ?>
<?php $checkt = mysqli_query($link, "SELECT * FROM owned_items WHERE ownerid='".$_USER["id"]."' AND type='".$querytype."'") or die(mysqli_error($link));
if(mysqli_num_rows($checkt) == 0) {
if($querytype == "pants") {
echo"<tr>
        <td class='tablebody'>
            <div id='wardrobe' style='padding-left:13px;'>No {$querytype} have been found.</div>
        <div style='clear:both;'></div>
      </td>
    </tr>";
}else{
echo"<tr>
        <td class='tablebody'>
            <div id='wardrobe' style='padding-left:13px;'>No {$querytype}s have been found.</div>
        <div style='clear:both;'></div>
      </td>
    </tr>";
}
}else{
echo"<br>
<div class='tablebody' style='font-size:12px; text-align: center; border-top: 1px solid black; padding: 5px 0;'>
<a style='color:black;font-weight:bold;' disabled=''>First</a>
<a style='color:black;font-weight:bold;' disabled=''>Previous</a>
<a style='color:black;font-weight:bold;' disabled=''>Next</a>
<a style='color:black;font-weight:bold;' disabled=''>Last</a>
<div>";
                                  }
                                  ?>
                                            </div>
        <div style="clear:both;"></div>
      </td>
    </tr>
  </tbody></table><div class="seperator"></div>
  <table cellspacing="0px" width="100%">
    <tbody><tr>
        <th class="tablehead">Currently Wearing</th>
    </tr>
  </tbody><tbody><tr>
  <th class="tablebody">
  <?php
                  $itemsq = mysqli_query($link, "SELECT * FROM wearing WHERE userid='".$_USER["id"]."'") or die(mysqli_error($link));
                  while($row = mysqli_fetch_assoc($itemsq)) {
                  $itemq = $link->query("SELECT * FROM catalog WHERE id='".$row['itemid']."'") or die(mysqli_error($link));
                  $item = mysqli_fetch_assoc($itemq);
                  $thumburl = $item['thumbnail'];
                  $iteml = $link->query("SELECT * FROM users WHERE id='".$item['creatorid']."'") or die(mysqli_error($link));
                  $user = mysqli_fetch_assoc($iteml);
                  $id = htmlspecialchars($row['assetid']);
                  $name = htmlspecialchars($item['name']);
                  $creator = htmlspecialchars($user['username']);
                  echo"<div class='clothe' style='font-size:10.85px; display:inline-block; *display:inline; margin:5px; display: inline-block; display: -moz-inline-stack; *display: inline; vertial-align:top;'>
                          <div id='".$name."' class='imgc' style='cursor:pointer;'><img class='img' src='".$thumburl."'>
                            <div class='fixed'><a href=\"/my/characterremove.php?id=".$item['id']."&wtype=".$querytype."\">[ remove ]</a></div>
                          </div>
                          <a class='name' href='/Catalog/item.php?id=".$id."'>".$name."</a><br>
                          Type: Hat<br>
                          Creator: <a href='/user/?id=".$item['creator']."'>".$creator."</a>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                  }
                                  ?></th>
                                  </tr></table>





<table cellspacing="0px" width="100%" style="margin-top: 0.8rem;">
    <tbody><tr>
        <th class="tablehead">Body Colors</th>
    </tr>
  </tbody><tbody><tr>
  <th class="tablebody">


  <form action="/api/savecolors.php" method="POST">
  <label for="head">Head:</label> <?=colorlist(head);?><br>
  <label for="larm">Left Arm:</label> <?=colorlist(larm);?><br>
  <label for="rarm">Right Arm:</label> <?=colorlist(rarm);?><br>
  <label for="torso">Torso:</label> <?=colorlist(torso);?><br>
  <label for="lleg">Left Leg:</label> <?=colorlist(lleg);?><br>
  <label for="rleg">Right Leg:</label> <?=colorlist(rleg);?><br>
  <input type="submit">
  </form>





  </th>
                                  </tr></table>









</div>
    <div id="right">
                    <table cellspacing="0px" width="100%">
                        <tbody>
                            <tr><th class="tablehead">My Character</th></tr>
                            <tr>
                                <th class="tablebody">
                                    <img height="220" class="margin" id="limg" src="/api/avatar/getthumb.php?id=<?php echo $_USER["id"]; ?>">
                                    <img class="margin" id="uimg" src="">
                                    <form action="/api/savepose.php" method="post">
<input type="submit" value="Normal" name="pose" class="Button" style="margin-bottom:5px;"> <input type="submit" value="Walking" name="pose" class="Button"> <input type="submit" value="Sitting" name="pose" class="Button"> <input type="submit" value="Overlord" name="pose" class="Button">
                                        <br>Something wrong with your avatar? Click <a href="/api/render.php?id=<?=$_USERID;?>">here</a> to fix the problem!
                                    </form>
                                </th>
                            </tr>
                        </tbody>
                    </table>
</div>


