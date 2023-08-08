<?php
require ("core/config.php");
if (!$isloggedin) {
    header('Location: /login/');
}

$id = (int)$_GET['UserID'];
if(!$id) {header('HTTP/1.1 404 Not Found'); include("error.php"); exit;}

$sql = "SELECT * FROM users WHERE id = '".$id."' AND bantype = 'None';";
            $result = mysqli_query($link, $sql);
            $resultCheck = mysqli_num_rows($result);
              
            if ($resultCheck > 0) {
                $row = mysqli_fetch_assoc($result);
}else{
header('HTTP/1.1 404 Not Found'); include("error.php"); exit;
}

$title = $sitename.": ".htmlspecialchars($row['username'])."'s Friends";

require ("core/header.php");
require ("core/nav.php");

$resultsperpage = 30;

$check = mysqli_query($link, "SELECT * FROM friends WHERE `user_from` = '".$row['id']."' AND `arefriends`='1' OR `user_to` = '".$row['id']."' AND `arefriends`='1' AND id != '".$row['id']."'");
                    $usercount = mysqli_num_rows($check);

                    $numberofpages = ceil($usercount/$resultsperpage);

if(!isset($_GET['Page'])) {
                        $page = 1;
                    }else{
                        $page = (int)addslashes($_GET['Page']);
                    }










$embeddescription = htmlspecialchars($row['username'])." is a user on ".$sitename." with ".$usercount." friends.";
$embedimage = "/api/avatar/getthumb.php?id=".$row['id'];
include("core/discordembed.php");
?>

<div id="FriendsContainer">
	<div id="Friends">
		<h4><?=htmlspecialchars($row['username']);?>'s Friends (<?=$usercount;?>)</h4>
		<div id="ctl00_cphRoblox_rbxFriendsPane_Pager1_PanelPages" align="center">
			Pages:
<?php if($numberofpages > 0){?>
<?php if($page > 1 && $numberofpages != 1){$gage=(int)addslashes($_GET['Page'])-1;$mage=(int)addslashes($_GET['Page'])+1;?>
<a id="ctl00_cphRoblox_rbxFriendsPane_Pager1_LinkButtonPrevious" href="?UserID=<?=$row['id'];?>&Page=<?=$gage;?>">&lt;&lt; Previous</a>
<?}?>
<?php if($page < $numberofpages){?>
<a id="ctl00_cphRoblox_rbxFriendsPane_Pager1_LinkButtonNext" href="?UserID=<?=$row['id'];?>&Page=<?=$mage;?>">Next &gt;&gt;</a>	
<?}?>	
<?}?>

</div>

<div id="Friends">
  <?php if($friendcount > 0){?><h4><?php echo htmlspecialchars($row['username']); ?>'s Friends <a href="Friends.aspx?UserID=1">See all <?=$friendcount;?></a></h4><?}?>
    
  <table id="ctl00_cphRoblox_rbxFriendsPane_dlFriends" cellspacing="0" align="Center" border="0">
  <tr>

<?

                    
                    

                    $thispagefirstresult = ($page-1)*$resultsperpage;

$friendq = mysqli_query($link, "SELECT * FROM friends WHERE `user_from` = '".$row['id']."' AND `arefriends`='1' OR `user_to` = '".$row['id']."' AND `arefriends`='1' AND id != '".$row['id']."' LIMIT ".$thispagefirstresult.",".$resultsperpage) or die(mysqli_error($link));

$friendnew = mysqli_query($link, "SELECT * FROM friends WHERE `user_from` = '".$row['id']."' AND `arefriends`='1' OR `user_to` = '".$row['id']."' AND `arefriends`='1' AND id != '".$row['id']."' LIMIT ".$thispagefirstresult.",".$resultsperpage);

$friendcount = mysqli_num_rows($friendq);

            if ($friendcount < 1) {
              // echo "<div class='NoResults'>".htmlspecialchars($row['username'])." does not have any Friends.</div>";
            } else {
              echo "<div class=\"columns\">";
              $total = 0;
              $cinnamonroll = 0;
              
              while ($friend = mysqli_fetch_assoc($friendq)) {
                if ($total == $total) {


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

                if ($cinnamonroll >= 6) {
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

<?php include("core/footer.php"); ?>