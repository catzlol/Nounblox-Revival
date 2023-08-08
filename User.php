<?php
require_once 'core/config.php';
if($_GET['ID']){
if(!$_GET['username']){
$id = (int)$_GET['ID']; $idorname = "id";
}
}else{
if(!$_GET['ID']){
if($_GET['username']){
$id = mysqli_real_escape_string($link,$_GET['username']); $idorname = "username";
}
}
}
if(!$id) {header('HTTP/1.1 404 Not Found'); include("error.php"); exit;}
?>

            <?php
            $sql = "SELECT * FROM users WHERE ".$idorname." = '".$id."' AND bantype = 'None';";
            $result = mysqli_query($link, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck == 0){header('HTTP/1.1 404 Not Found'); include("error.php"); exit;}
              
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

if($idorname == "username"){
header("Location: /User.aspx?ID=".$row['id']);
}

$title = htmlspecialchars($row['username'])."'s ".$sitename." Home Page";

include 'core/header.php';
include 'core/nav.php';


$wrroebucks = $row['robux'];
$ticks = $row['tix'];


$blurbington = nl2br(htmlentities($row['blurb']));

$wow1 = str_replace("{robux}", $wrroebucks, $blurbington);

$newblurb = str_replace("{tix}", $ticks, $wow1);


$embedimage = "/api/avatar/getthumb.php?id=".$row['id'];
$embeddescription = htmlspecialchars($row['username'])." is having the time of their life playing ".$sitename.", a 2009 ROBLOX revival. Join us today! \n\n".mb_strimwidth(htmlspecialchars($newblurb), 0, 253, "...");

include "core/discordembed.php";


                  $visitq = mysqli_query($link, "SELECT * FROM `gamesvisits` WHERE gameid = '".$row['id']."'");
                  $visits = mysqli_num_rows($visitq);

if($_USER){ 
  if($_USER['id'] != $id){
    mysqli_query($link, "INSERT INTO `profileviews`(`profile`) VALUES ('$id')") or die(mysqli_error($conn));
  }
}

$page_views = mysqli_num_rows(mysqli_query($link, "SELECT * FROM profileviews WHERE profile='$id'"));

$lastweekprofileviews = mysqli_num_rows(mysqli_query($link, "select * from profileviews where profile='$id' and date between date_sub(now(),INTERVAL 1 WEEK) and now();"));

                  
                  ?>
                <br>
  <div id="UserContainer">
    <div id="LeftBank">
      <div id="ProfilePane">
        
<table width="100%" bgcolor="lightsteelblue" cellpadding="6" cellspacing="0">
    <tr>
        <td>
            <span id="ctl00_cphRoblox_rbxUserPane_lUserName" class="Title"><?php echo $row['username']; ?></span><br/>
            <? if($row['expiretime'] < $now){?><span id="ctl00_cphRoblox_rbxUserPane_lUserOnlineStatus" class="UserOfflineMessage">[ Offline ]</span><?}else{?><span id="ctl00_cphRoblox_rbxUserPane_lUserOnlineStatus" class="UserOnlineMessage">[ Online ]</span><?}?>
        </td>
    </tr>
    <tr>
        <td>
            <span id="ctl00_cphRoblox_rbxUserPane_lUserRobloxURL"><?php echo $row['username']; ?>'s <?=$sitename ?>:</span><br/>
            <a id="ctl00_cphRoblox_rbxUserPane_hlUserRobloxURL" href="/User.aspx?ID=<?php echo $row['id']; ?>">https://<?=$_SERVER['SERVER_NAME'];?>/User.aspx?ID=<?php echo $row['id']; ?></a><br/>
            <br/>
            <table width="100%">
                <tr>
                    <td>
                        <a id="ctl00_cphRoblox_rbxUserPane_AvatarImage" disabled="disabled" title="<?php echo $row['username']; ?>" onclick="return false" style="display:inline-block;"><img src="/api/avatar/getthumb.php?id=<?php echo $row['id']; ?>" height="200" border="0" alt="Avatar" blankurl="http://t0-cf.roblox.com/blank-150x200.gif"/></a><br/>
                        
                    </td>
                    <td>
                        
                        

<p></p>
<p></p>
<div class="ReportAbusePanel">
																	</div>
							</div>
<? if($_USER){ if($_USER['id'] != $id){ ?>
							<p><a href="/my/PrivateMessage.aspx?RecipientID=<?=$row['id'];?>">Send Message</a></p>
                                                        <p><a href="/api/AddFriend.php?id=<?php echo $row['id'] ?>">Send Friend Request</a></p>
<?}}?>
<p><span id="ctl00_cphRoblox_rbxUserPane_rbxPublicUser_lBlurb" style="word-break: break-word;"><?php echo $newblurb; ?></span></p>
                    </td>
                </tr>
<tr><td>
<a href="/report/?id=<?=$row['id'];?>&amp;type=3"><span class="AbuseIcon"><img src="/images/abuse.gif" alt="Report Abuse" border="0"></span>
									<span class="AbuseButton">Report Abuse</span></a>
</tr></td>
            </table>
        </td>
    </tr>
</table>


      </div>
      <div id="UserPageLargeRectangleAd">
          

<div id="RobloxLargeRectangleAd">
    
           <script type="text/javascript">
               GA_googleFillSlot("Roblox_MyRoblox_Middle_300x250");
            </script>
          
</div>
      </div>
      <div id="UserBadgesPane">
        

<div id="UserBadges">
  <h4><a id="ctl00_cphRoblox_rbxUserBadgesPane_hlHeader" href="/Badges.aspx">Badges</a></h4>
  <table id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges" cellspacing="0" align="Center" border="0">
  <tr>
    <td>
      <?php if($row['USER_PERMISSIONS'] == 'Administrator') {    ?> 
      <div class="Badge">
                <div class="BadgeImage">
                  <img src="/images/Badges/Administrator-75x75.png" title="This badge identifies an account as belonging to a <?=$sitename;?> administrator. Only official <?=$sitename;?> administrators will possess this badge. If someone claims to be an admin, but does not have this badge, they are potentially trying to mislead you. If this happens, please report abuse and we will delete the imposter's account." alt="Administrator-75x75"><br>
                  <div class="BadgeLabel"><a href="/Badges">Administrator</a>
                </div>
              </div>
      <?php } ?>
      <?php if($row['BC'] == 'BC') {    ?>
              <td><td><div class="Badge">
                <div class="BadgeImage">
                  <img src="/images/Badges/BuildersClub-75x75.png" title="This badge is given to builders club members on the site. To get this badge you must need to boost our server." alt="BuildersClub-75x75"><br>
                  <div class="BadgeLabel"><a href="/Badges">Builders Club</a>
                </div>
              </div>
      <?php } ?>
    </td><td></td><td></td><td></td>
  </tr>
</table>

<?php

$friendnew = mysqli_query($link, "SELECT * FROM friends WHERE `user_from` = '".$row['id']."' AND `arefriends`='1' OR `user_to` = '".$row['id']."' AND `arefriends`='1' AND id != '".$row['id']."'");

$friendcount = mysqli_num_rows($friendnew);


$okthiscould = mysqli_query($link, "SELECT * FROM friends WHERE `user_from` = '".$row['id']."' AND `arefriends`='1' and date between date_sub(now(),INTERVAL 1 WEEK) and now() OR `user_to` = '".$row['id']."' AND `arefriends`='1' AND id != '".$row['id']."' and date between date_sub(now(),INTERVAL 1 WEEK) and now();");

$friendslastweek = mysqli_num_rows($okthiscould);




$forumnew = mysqli_query($link, "SELECT * FROM forum WHERE `author` = '".$row['id']."'");

$forumcount = mysqli_num_rows($forumnew);


$helplol = mysqli_query($link, "select * from forum where `author` = '".$row['id']."' and FROM_UNIXTIME(time_posted) between date_sub(now(),INTERVAL 1 WEEK) and now();");

$forumlastweek = mysqli_num_rows($helplol);

?>
  
</div>
      </div>
      <div id="UserStatisticsPane" style="margin-bottom: 10px;">
			<div id="UserStatistics">
				<div id="StatisticsPanel" style="transition: height 0.5s ease-out; overflow: hidden; height: 200px;">
					<h4>Statistics</h4>			
					<div style="margin: 10px 10px 150px 10px;" id="Results">
						<div class="Statistic">
							<div class="Label"><acronym title="The number of this user's friends.">Friends</acronym>:</div>
							<div class="Value"><span><?=$friendcount;?> (<?=$friendslastweek;?> last week)</span></div>
						</div>
												<div class="Statistic">
							<div class="Label"><acronym title="The number of posts this user has made to the <?=$sitename;?> forum.">Forum Posts</acronym>:</div>
							<div class="Value"><span><?=$forumcount;?> (<?=$forumlastweek;?> last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's profile has been viewed.">Profile Views</acronym>:</div>
							<div class="Value"><span><?=$page_views;?> (<?=$lastweekprofileviews;?> last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's place has been visited.">Place Visits</acronym>:</div>
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's models have been viewed.">Model Views</acronym>:</div>
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's character has destroyed another user's character in-game.">Knockouts</acronym>:</div>
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's character has been destroyed in-game.">Wipeouts</acronym>:</div>
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>

    </div>
    <div id="RightBank">
      <div id="UserPlacesPane">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="/ajax.js" type="text/javascript"></script>
<script src="/ajaxcommon.js" type="text/javascript"></script>
<script src="/ajaxtimer.js" type="text/javascript"></script>
<script src="/ajaxanimations.js" type="text/javascript"></script>
<script src="/ajaxextenderbase.js" type="text/javascript"></script>
<script src="/accordian.js" type="text/javascript"></script>

<script>
Sys.Application.add_init(function() {
    $create(Sys.Extended.UI.AccordionBehavior, {"ClientStateFieldID":"AccordionExtender_ClientState","FramesPerSecond":40,"HeaderCssClass":"AccordionHeader","id":"ShowcasePlacesAccordion_AccordionExtender"}, null, null, $get("ShowcasePlacesAccordion")); 
}); 
</script>
        
<div id="UserPlaces">
    <h4 class="thingg">Showcase</h4>
    <div id="ShowcasePlacesAccordion" style="height: auto; overflow: auto;">
					<input type="hidden" name="AccordionExtender_ClientState" id="AccordionExtender_ClientState" value="0">
										
<?php
$usersQuery = "SELECT * FROM games WHERE creator_id = '".$row['id']."' ORDER BY id DESC LIMIT 10";
$usersResult=mysqli_query($link,$usersQuery); $lolcount = 1;
$thejlol = mysqli_num_rows($usersResult);
if($thejlol == 0){
?>
<style>.thingg{display:none!important;}</style>
<div id="UserPlacesPane" style="border: 0px!important;">
			 <p style="padding:10px">This person doesn't have any <?=$sitename;?> places.</p> 		</div>
<?}
while($rowUser = mysqli_fetch_array($usersResult)){ ?>
<div class="AccordionHeader"><?=htmlentities($rowUser['name']);?></div>
<div style="height: 0px; overflow: hidden; display: none;"><div style="display: block; height: auto; overflow: hidden;">
<div class="Place" style="background:white;">
<div class="PlayStatus">
								<span id="BetaTestersOnly" style="display:none;"><img src="/web/20210220003229im_/https://goodblox.xyz/resources/tinybeta.png" style="border-width:0px;">&nbsp;Beta testers only</span>
								<span id="FriendsOnlyLocked" style="display:none;"><img src="/web/20210220003229im_/https://goodblox.xyz/resources/unlocked.png" style="border-width:0px;">&nbsp;Friends-only: You have access</span>
								<span id="FriendsOnlyUnlocked" style="display:none;"><img src="/web/20210220003229im_/https://goodblox.xyz/resources/locked.png" style="border-width:0px;">&nbsp;Friends-only</span>
								<span id="Public" style="display:inline;"><img src="/images/public.png" style="border-width:0px;">&nbsp;Public</span>
</div>
<br>
<?php
if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$launcherlink = "/Login/Default.aspx?ReturnUrl=".$yourl;
}else{
$launcherlink = $uriname."://?placeid=".$rowUser['id']."&accountcode=".$_USER['accountcode'];
}
?>
<div class="PlayOptions">
																<a href="<?=$launcherlink;?>"><img id="MultiplayerVisitButton" class="ImageButton" src="/images/Play.png" alt="Visit Online"></a>
          													</div>
<div class="Statistics">
<span>Visited 0 times (0 last week)</span>
</div>
<div class="Thumbnail">
<a disabled="disabled" title="<?=htmlentities($rowUser['name']);?>" href="/Place.aspx?id=<?=$rowUser['id'];?>" style="display:inline-block;">
<img src="/thumbs/index.php?id=<?=$rowUser['id'];?>" id="img" alt="<?=htmlentities($rowUser['name']);?>" border="0" style="height: 230px; width: 421px;">
</a>
</div>
														<div>
<div class="Description">
<span><?=htmlentities($rowUser['description']);?></span>
</div>
</div>
													</div>
</div></div>
<? $lolcount++; }?>

									</div>      
      
    

      
    
  
 </div>
      </div>
      <div id="FriendsPane" style="background:white;">
        

<div id="Friends">
  <?php if($friendcount > 0){?><h4><?php echo $row['username']; ?>'s Friends <a href="/Friends.aspx?UserID=<?=$row['id'];?>">See all <?=$friendcount;?></a></h4><?}?>
    
  <table id="ctl00_cphRoblox_rbxFriendsPane_dlFriends" cellspacing="0" align="Center" border="0">
  <tr>

<?

    $resultsperpage = 6;
                    $check = mysqli_query($link, "SELECT * FROM friends WHERE `user_from` = '".$row['id']."' AND `arefriends`='1' OR `user_to` = '".$row['id']."' AND `arefriends`='1' AND id != '".$row['id']."'");
                    $usercount = mysqli_num_rows($check);

                    $numberofpages = ceil($usercount/$resultsperpage);

                    $page = 1;

                    $thispagefirstresult = ($page-1)*$resultsperpage;

$friendq = mysqli_query($link, "SELECT * FROM friends WHERE `user_from` = '".$row['id']."' AND `arefriends`='1' OR `user_to` = '".$row['id']."' AND `arefriends`='1' AND id != '".$row['id']."' LIMIT ".$thispagefirstresult.",".$resultsperpage) or die(mysqli_error($link));

$friendnew = mysqli_query($link, "SELECT * FROM friends WHERE `user_from` = '".$row['id']."' AND `arefriends`='1' OR `user_to` = '".$row['id']."' AND `arefriends`='1' AND id != '".$row['id']."'");

$friendcount = mysqli_num_rows($friendnew);

            if ($friendcount < 1) {
              echo "<div class='NoResults'>".htmlspecialchars($row['username'])." does not have any Friends.</div>";
            } else {
              echo "<div class=\"columns\">";
              $total = 0;
              $cinnamonroll = 0;
              
              while ($friend = mysqli_fetch_assoc($friendq)) {
                if ($total <= 5) {


                $friendid = 0;

                if ($friend['user_from'] == $row['id']) {
                  $friendid = $friend['user_to'];
                } else {
                  $friendid = $friend['user_from'];
                }

                $friend_online = mysqli_query($link, "SELECT * FROM users WHERE id='$friendid'") or die(mysqli_error($link));
                
                $finfo = mysqli_fetch_assoc($friend_online);

                $usrlol = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM users WHERE id='$friendid' LIMIT ".$thispagefirstresult.",".$resultsperpage));
                
if($usrlol['expiretime'] > $now){ $theyare = "nline"; } else { $theyare = "ffline"; $lastyyy = " (last seen at 12/12/2007 4:56:27 PM)";  }


?>



<td>
      <div class="Friend">
        <div class="Avatar"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl00_hlAvatar" title="<?=$usrlol['username'];?>" href="/User.aspx?ID=<?=$usrlol['id'];?>" style="display:inline-block;cursor:pointer;"><img src="/api/avatar/getthumb.php?id=<?=$usrlol['id'];?>" border="0" alt="<?=$usrlol['username'];?>" blankurl="http://t6-cf.roblox.com/blank-100x100.gif" height="100"/></a></div>
        <div class="Summary">
          <span class="OnlineStatus"><img id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl00_iOnlineStatus" src="/images/OnlineStatusIndicator_IsO<?=$theyare;?>.gif" alt="<?=$usrlol['username'];?> is o<?=$theyare;?><?=$lastyyy;?>." border="0"/></span>
          <span class="Name"><a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl00_hlFriend" href="/User.aspx?ID=<?=$usrlol['id'];?>"><?=$usrlol['username'];?></a></span>
        </div>
      </div>
    </td>




<?
                $total++;
                $cinnamonroll++;

                if ($cinnamonroll >= 3) {
                  echo "</tr></div><tr><div class=\"columns\">";
                  $cinnamonroll = 0;
                }
              }}
              echo "</div>";
            }
            ?></tr></tbody></table>

<style>
fix {
    display: table-cell;
    vertical-align: inherit;
}
</style>



  </tr>
</table>
  
</div>
      </div>
      <div id="FavoritesPane" style="margin-top: 10px; margin-bottom: 10px;">
			<div id="Favorites">
				<h4>Favorites</h4>
				<div id="FavoritesContent">This user does not have any favorites for this type</div>
				<div class="PanelFooter">
					Category:&nbsp;
					<select id="FavCategories">
						<option value="7">Heads</option>
						<option value="8">Faces</option>
						<option value="2">T-Shirts</option>
						<option value="5">Shirts</option>
						<option value="6">Pants</option>
						<option value="1">Hats</option>
						<option value="4">Decals</option>
						<option value="3">Models</option>
						<option selected="selected" value="0">Places</option>
					</select>
				</div>
			</div>
		</div>



    </div>


<br>


<div id="UserAssetsPane">
		<div id="ctl00_cphRoblox_rbxUserAssetsPane_upUserAssetsPane">
			<div id="UserAssets">
				<h4>Stuff</h4>
				<div id="AssetsMenu">
					<div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl00_AssetCategorySelectorPanel" class="AssetsMenuItem">
						<a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl00_AssetCategorySelector" class="AssetsMenuButton" href="javascript:__doPostBack('ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl00$AssetCategorySelector','')">Heads</a>
					</div>
					<div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelectorPanel" class="AssetsMenuItem">
						<a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelector" class="AssetsMenuButton" href="javascript:__doPostBack('ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl01$AssetCategorySelector','')">Faces</a>
					</div>
					<div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl02_AssetCategorySelectorPanel" class="AssetsMenuItem_Selected">
						<a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl02_AssetCategorySelector" class="AssetsMenuButton_Selected" href="javascript:__doPostBack('ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl02$AssetCategorySelector','')">Hats</a>
					</div>
					<div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl03_AssetCategorySelectorPanel" class="AssetsMenuItem">
						<a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl03_AssetCategorySelector" class="AssetsMenuButton" href="javascript:__doPostBack('ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl03$AssetCategorySelector','')">T-Shirts</a>
					</div>
					<div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl04_AssetCategorySelectorPanel" class="AssetsMenuItem">
						<a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl04_AssetCategorySelector" class="AssetsMenuButton" href="javascript:__doPostBack('ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl04$AssetCategorySelector','')">Shirts</a>
					</div>
					<div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl05_AssetCategorySelectorPanel" class="AssetsMenuItem">
						<a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl05_AssetCategorySelector" class="AssetsMenuButton" href="javascript:__doPostBack('ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl05$AssetCategorySelector','')">Pants</a>
					</div>
					<div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl06_AssetCategorySelectorPanel" class="AssetsMenuItem">
						<a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl06_AssetCategorySelector" class="AssetsMenuButton" href="javascript:__doPostBack('ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl06$AssetCategorySelector','')">Decals</a>
					</div>
					<div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl07_AssetCategorySelectorPanel" class="AssetsMenuItem">
						<a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl07_AssetCategorySelector" class="AssetsMenuButton" href="javascript:__doPostBack('ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl07$AssetCategorySelector','')">Models</a>
					</div>
					<div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl08_AssetCategorySelectorPanel" class="AssetsMenuItem">
						<a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl08_AssetCategorySelector" class="AssetsMenuButton" href="javascript:__doPostBack('ctl00$cphRoblox$rbxUserAssetsPane$AssetCategoryRepeater$ctl08$AssetCategorySelector','')">Places</a>
					</div>
				</div>
				<div id="AssetsContent">
					<!--table id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList" cellspacing="0" border="0">
						<tr>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl00_AssetThumbnailHyperLink" title="ROBLOX Visor" href="/Item.aspx?ID=7135977" style="display:inline-block;cursor:pointer;"><img src="http://t3-cf.roblox.com/dcff311a57ce48ec441db98f9bf4a272" border="0" alt="ROBLOX Visor" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl00_AssetNameHyperLink" href="Item.aspx?ID=7135977">ROBLOX Visor</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl00_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
										<div class="AssetPrice"><span class="PriceInTickets">Tx: 9</span></div>
									</div>
								</div>
							</td>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl01_AssetThumbnailHyperLink" title="Golden Top Hat of Bling Bling" href="/Item.aspx?ID=6552812" style="display:inline-block;cursor:pointer;"><img src="http://t7-cf.roblox.com/7e82a4f964238777a99ef72365a1d872" border="0" alt="Golden Top Hat of Bling Bling" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl01_AssetNameHyperLink" href="Item.aspx?ID=6552812">Golden Top Hat of Bling Bling</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl01_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
									</div>
								</div>
							</td>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl02_AssetThumbnailHyperLink" title="Racing Helmet" href="/Item.aspx?ID=6379764" style="display:inline-block;cursor:pointer;"><img src="http://t5-cf.roblox.com/0376f169ae5260df0e4d0c2192f4b089" border="0" alt="Racing Helmet" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl02_AssetNameHyperLink" href="Item.aspx?ID=6379764">Racing Helmet</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl02_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
									</div>
								</div>
							</td>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl03_AssetThumbnailHyperLink" title="Ninja Mask of Light" href="/Item.aspx?ID=5808672" style="display:inline-block;cursor:pointer;"><img src="http://t1-cf.roblox.com/e378b0cd20be35adbd182894b7a7f357" border="0" alt="Ninja Mask of Light" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl03_AssetNameHyperLink" href="Item.aspx?ID=5808672">Ninja Mask of Light</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl03_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
										<div class="AssetPrice"><span class="PriceInRobux">R$: 12</span></div>
									</div>
								</div>
							</td>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl04_AssetThumbnailHyperLink" title="Opened Royal Gift of Kings" href="/Item.aspx?ID=6203087" style="display:inline-block;cursor:pointer;"><img src="http://t1-cf.roblox.com/949f947ac3f65b18da89c49b05a68c80" border="0" alt="Opened Royal Gift of Kings" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl04_AssetNameHyperLink" href="Item.aspx?ID=6203087">Opened Royal Gift of Kings</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl04_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl05_AssetThumbnailHyperLink" title="Opened Crimson Gift of Good Citizenship" href="/Item.aspx?ID=6020380" style="display:inline-block;cursor:pointer;"><img src="http://t4-cf.roblox.com/7a09c1421ce62db47adb2991e26b480e" border="0" alt="Opened Crimson Gift of Good Citizenship" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl05_AssetNameHyperLink" href="Item.aspx?ID=6020380">Opened Crimson Gift of Good Citizenship</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl05_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
									</div>
								</div>
							</td>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl06_AssetThumbnailHyperLink" title="The Riddling Skull" href="/Item.aspx?ID=4765718" style="display:inline-block;cursor:pointer;"><img src="http://t4-cf.roblox.com/53e9e32f4c5c54adca87c36cbc2eb16e" border="0" alt="The Riddling Skull" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl06_AssetNameHyperLink" href="Item.aspx?ID=4765718">The Riddling Skull</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl06_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
									</div>
								</div>
							</td>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl07_AssetThumbnailHyperLink" title="Red Baseball Cap" href="/Item.aspx?ID=1028606" style="display:inline-block;cursor:pointer;"><img src="http://t7-cf.roblox.com/03c9da61378ab70fe0d7854f9e559add" border="0" alt="Red Baseball Cap" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl07_AssetNameHyperLink" href="Item.aspx?ID=1028606">Red Baseball Cap</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl07_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
										<div class="AssetPrice"><span class="PriceInRobux">R$: 7</span></div>
									</div>
								</div>
							</td>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl08_AssetThumbnailHyperLink" title="Bighead" href="/Item.aspx?ID=1048037" style="display:inline-block;cursor:pointer;"><img src="http://t1-cf.roblox.com/bbcbaccf78eb2d5c904d4eee0cb0b319" border="0" alt="Bighead" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl08_AssetNameHyperLink" href="Item.aspx?ID=1048037">Bighead</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl08_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
										<div class="AssetPrice"><span class="PriceInRobux">R$: 70</span></div>
									</div>
								</div>
							</td>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl09_AssetThumbnailHyperLink" title="Emerald Eye" href="/Item.aspx?ID=1185264" style="display:inline-block;cursor:pointer;"><img src="http://t5-cf.roblox.com/c2ff11ed4a83876692b18277cdfb77f4" border="0" alt="Emerald Eye" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl09_AssetNameHyperLink" href="Item.aspx?ID=1185264">Emerald Eye</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl09_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl10_AssetThumbnailHyperLink" title="PhD Hat" href="/Item.aspx?ID=2062347" style="display:inline-block;cursor:pointer;"><img src="http://t2-cf.roblox.com/8b8800b29f6a85e932805e047b597f65" border="0" alt="PhD Hat" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl10_AssetNameHyperLink" href="Item.aspx?ID=2062347">PhD Hat</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl10_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
									</div>
								</div>
							</td>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl11_AssetThumbnailHyperLink" title="Helmet" href="/Item.aspx?ID=1045407" style="display:inline-block;cursor:pointer;"><img src="http://t0-cf.roblox.com/ae683370b15d7d684b8dec0aa57a343f" border="0" alt="Helmet" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl11_AssetNameHyperLink" href="Item.aspx?ID=1045407">Helmet</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl11_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
										<div class="AssetPrice"><span class="PriceInRobux">R$: 93</span></div>
									</div>
								</div>
							</td>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl12_AssetThumbnailHyperLink" title="Thunderstorm Hat" href="/Item.aspx?ID=1098279" style="display:inline-block;cursor:pointer;"><img src="http://t2-cf.roblox.com/23625ddc5b678753ceb7b29cec16ea7b" border="0" alt="Thunderstorm Hat" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl12_AssetNameHyperLink" href="Item.aspx?ID=1098279">Thunderstorm Hat</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl12_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
										<div class="AssetPrice"><span class="PriceInRobux">R$: 86</span></div>
									</div>
								</div>
							</td>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl13_AssetThumbnailHyperLink" title="Football Helmet" href="/Item.aspx?ID=1590045" style="display:inline-block;cursor:pointer;"><img src="http://t2-cf.roblox.com/c4eb0a3d7df48e0a5cab326318ed23db" border="0" alt="Football Helmet" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl13_AssetNameHyperLink" href="Item.aspx?ID=1590045">Football Helmet</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl13_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
										<div class="AssetPrice"><span class="PriceInTickets">Tx: 102</span></div>
									</div>
								</div>
							</td>
							<td class="Asset" valign="top">
								<div style="padding:5px">
									<div class="AssetThumbnail">
										<a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl14_AssetThumbnailHyperLink" title="Ninja Mask of Shadows" href="/Item.aspx?ID=1309911" style="display:inline-block;cursor:pointer;"><img src="http://t4-cf.roblox.com/e9c8a9934aae4ec782fa142303bb3487" border="0" alt="Ninja Mask of Shadows" blankUrl="http://t6-cf.roblox.com/blank-110x110.gif" /></a>
									</div>
									<div class="AssetDetails">
										<div class="AssetName"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl14_AssetNameHyperLink" href="Item.aspx?ID=1309911">Ninja Mask of Shadows</a></div>
										<div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl14_AssetCreatorHyperLink" href="User.aspx?ID=1">ROBLOX</a></span></div>
										<div class="AssetPrice"><span class="PriceInRobux">R$: 12</span></div>
									</div>
								</div>
							</td>
						</tr>
					</table>
					<div id="ctl00_cphRoblox_rbxUserAssetsPane_FooterPagerPanel" class="FooterPager">
						<span id="ctl00_cphRoblox_rbxUserAssetsPane_FooterPagerLabel">Page 1 of 3</span>
						<a id="ctl00_cphRoblox_rbxUserAssetsPane_FooterPageSelector_Next" href="javascript:__doPostBack('ctl00$cphRoblox$rbxUserAssetsPane$FooterPageSelector_Next','')">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
					</div-->
					<div class="NoResults">This feature currently does not exist. Sorry for any inconvenience!</div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
	</div>






      <div style="clear:both;"></div>
    </div>
  
</div>

    </div>
  </div>
  

        </div>
<?php }} ?>

<? include 'core/footer.php'; ?>
