<?php
include 'core/header.php';
include 'core/nav.php';
require_once 'core/config.php';
$id = (int)$_GET['id'];
if(!$id) {header('location: /catalog.aspx');}
?>
<?php
$sql = "SELECT * FROM catalog WHERE id = '".$id."';";
$result = mysqli_query($link, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
while ($row = mysqli_fetch_assoc($result)) {
if($row['type'] == "hat") $type = "Hat";
if($row['type'] == "hair") $type = "Hair";
if($row['type'] == "shirt") $type = "Shirt";
if($row['type'] == "pants") $type = "Pants";
if($row['type'] == "gear") $type = "Gear";
if($row['type'] == "tshirt") $type = "T-Shirt";
if($row['type'] == "face") $type = "Face";
if($row['type'] == "package") $type = "Package";
metatag($row['name'], $row['description'], $row['thumbnail']);

$creatorq = mysqli_query($link, "SELECT * FROM users WHERE id='".$row['creatorid']."'") or die(mysqli_error($link));
$creator = mysqli_fetch_assoc($creatorq);

$owneditemsq = mysqli_query($link, "SELECT * FROM owned_items WHERE itemid='".$row['id']."' AND ownerid='".$_USER['id']."'") or die(mysqli_error($link));
$owneditems = mysqli_fetch_assoc($owneditemsq);
if($owneditems) {$owned = 'yes';} else {$owned = 'no';}
?>
<style>
    #Item {
    font-family: Verdana, Sans-Serif;
    padding: 10px;
}
#ItemContainer {
    background-color: #eee;
    border: solid 1px #555;
    color: #555;
    margin: 0 auto;
    width: 620px;
}
#Actions {
    background-color: #fff;
    border-bottom: dashed 1px #555;
    border-left: dashed 1px #555;
    border-right: dashed 1px #555;
    clear: left;
    float: left;
    padding: 5px;
    text-align: center;
    min-width: 0;
    position: relative;
}
.PlayGames {
  background-color: #ccc;
  border: dashed 1px Green;
  color: Green;
  float: right;
  margin-top: 10px;
  padding: 10px 5px;
  text-align: right;
  width: 325px;
  }
}
    </style>
  <div id="ItemContainer" style="float:left;width: 720px;">
  <h2><?php echo $row['name'] ; ?></h2>
  <div id="Item">
    <div id="Thumbnail">
      <a title="<?php echo $row['name']; ?>" style="display:inline-block;height:250px;width:250px;"><img src="<?php echo $row['thumbnail']; ?>" border="0" id="img" alt="<?php echo $row['name']; ?>" style="display:inline-block;height:250px;width:250px;"></a>
    </div>
    <div id="Summary">
      <h3><?=$sitename ?> <?=$type ?></h3>
            <div id="RobuxPurchase">
              <?php if($owned == 'no') { ?>
        <div id="PriceInRobux"><?php if($row['buywith'] == 'tix') {echo $tixname;} else {echo $robuxname;} ?>: <?php echo $row['price']; ?></div>
<div id='BuyWithRobux'>
          <a href="buyitem.aspx?id=<?php echo $row["id"]; ?>" class='Button'>Buy with <?php if($row['buywith'] == 'tix') {echo $tixname;} else {echo $robuxname;} ?></a>
        </div> <?php } else { ?>
          <div id="PriceInRobux">You already own this item!</div>
          <?php } ?>
      </div>      <br><br>
            <div id="Creator"><br><a href="/user/?id=<?php echo $creator['id']; ?>"><iframe src="/api/avatar/getthumb.php?id=<?php echo $creator['id']; ?>" frameborder="0" scrolling="no" width="100" height="110"></iframe></a><br><span style="color:#555;">Creator: </span><a href="/user.php?id=<?php echo $creator['id']; ?>"><?php echo $creator['username']; ?></a></div>
      <div id="LastUpdate">Updated: </div>
      <div id="Favourites">Favorited: 0 times</div>
            <div>
        <div id="DescriptionLabel">Description:</div>
        <div id="Description"><?php echo $row['description']; ?></div>
      </div>
            <p>
        </p><div class="ReportAbusePanel">
          <span class="AbuseIcon"><a><img src="/images/abuse.gif" alt="Report Abuse" style="border-width:0px;"></a></span>
          <span class="AbuseButton"><a>Report Abuse</a></span>
        </div>
      <p></p>
    </div>
    <div id="Actions" style="width:240px;">
                      <a href="#">Favorite</a>
                              </div><div style="clear: both;"></div>
    <?php if($owned == 'yes') {
          ?>
      
            <div class="PlayGames">
        <div style="text-align: center; margin: 1em 5px;">
                  <a>Sell Item</a>
       </div>
      </div>
      
      
          <?php }
          ?>

  </div>
</div>
<div style="clear:both;"></div>
<div id='itemPurchaseFade' style='position: fixed; z-index: 1; left: 0px; top: 0px; width: 100%; height: 100%; overflow: auto; background-color: rgba(100, 100, 100, 0.25); display: none;'>
  <div id='itemPurchase' class='anim' style='max-width: 325px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);'>
    <div style='background-color: #FFFFE0; border:3px solid gray; box-shadow: black 5px 5px;'><div id='VerifyPurchaseTix' style='margin: 1.5em; display:none;'>
        <h3>Insufficient Funds</h3>
        <p>You need more <?php if($row['buywith'] == 'tix') {echo $tixname;} else {echo $roxuxname;} ?> to purchase this item.</p>
        <p><input type='submit' name='oof' value='Cancel' onclick='$(&#39;#itemPurchaseFade&#39;).hide();' class='MediumButton' style='width:100%;'></p>
      </div>            <div id='PurchaseMessage' style='margin: 1.5em; display: none;'>
                Thanks for buying this.
      </div>
        
    </div>          </div>
</div>

<?php }} ?>