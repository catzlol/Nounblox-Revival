<?php
require_once '../../core/config.php';
$id = mysqli_real_escape_string($link,$_GET['UserName']);
if(!$id) {header('HTTP/1.1 404 Not Found'); include("error.php"); exit;}
?>

            <?php
            $sql = "SELECT * FROM users WHERE username = '".$id."' AND bantype = 'None';";
            $result = mysqli_query($link, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck == 0){
header("Location: /Forum/Msgs/default.aspx?MessageId=14"); exit;
// header('HTTP/1.1 404 Not Found'); include("../../error.php"); exit;
}
              
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

include '../../core/header.php';
include '../../core/nav.php';

$joindate = date("n-j-Y g:i A",strtotime($row['join_date']));
$lastseen = date("n-j-Y g:i A",$row['visittick']);

$forumnew = mysqli_query($link, "SELECT * FROM forum WHERE `author` = '".$row['id']."'");
$forumcount = mysqli_num_rows($forumnew);

$totalforumssql = mysqli_query($link, "SELECT * FROM forum");
$totalforums = mysqli_num_rows($totalforumssql);

$percentage = round(($forumcount*100)/$totalforums,2);



$embedtitle = htmlspecialchars($row['username'])."'s Forum Profile - ".$sitename." Forums";

$embeddescription = htmlspecialchars($row['username'])." is a forumer who has contributed ".$forumcount." out of ".$totalforums." total posts.";

$embedimage = "/api/avatar/getthumb.php?id=".$row['id'];

include("../../core/discordembed.php");

?>
<link rel="stylesheet" href="/forumsapi/skins/default/style/default.css" type="text/css">
<div id="Body">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr>
    <td>
    </td>
  </tr>
  <tr valign="bottom">
    <td>
      <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody><tr valign="top">
          <!-- left column -->
          <td>&nbsp; &nbsp; &nbsp;</td>
          <!-- center column -->
          <td width="95%" class="CenterColumn">
            &nbsp;
            <br>
            <span>
              <table width="100%" cellspacing="1" cellpadding="0">
                <tbody><tr>
                  <td align="right" valign="middle">
                    <a class="menuTextLink" href="/Forum/Default.aspx"><img src="/forumsapi/skins/default/images/icon_mini_home.gif" border="0">Home &nbsp;</a>
                    <a class="menuTextLink" href="/Forum/Search/default.aspx"><img src="/forumsapi/skins/default/images/icon_mini_search.gif" border="0">Search &nbsp;</a>
      <?php if(!$_USER){?> 
      <a id="ctl00_cphRoblox_NavigationMenu2_ctl00_RegisterMenu" class="menuTextLink" href="/Forum/User/CreateUser.aspx"><img src="/forumsapi/skins/default/images/icon_mini_register.gif" border="0">Register &nbsp;</a>
      <?}else{?>
      <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_ProfileMenu" class="menuTextLink" href="/Forum/User/EditUserProfile.aspx"><img src="/forumsapi/skins/default/images/icon_mini_profile.gif" border="0">Profile &nbsp;</a>

      <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_MyForumsMenu" class="menuTextLink" href="/Forum/User/MyForums.aspx"><img src="/forumsapi/skins/default/images/icon_mini_myforums.gif" border="0">MyForums &nbsp;</a>
<?}?>
                                      </td>
                </tr>
              </tbody></table>
            </span>
            <p>
              <span name="Userinfo1">
                </span></p><table cellspacing="1" cellpadding="0" width="100%" class="tableBorder">
                  <tbody><tr>
                    <th height="25" class="tableHeaderText" align="left" colspan="2">
                      &nbsp; Viewing User Profile for:
                      <span><?=htmlspecialchars($row['username']);?></span>
                    </th>
                  </tr>
                  <tr>
                    <td height="20" class="forumHeaderBackgroundAlternate">
                      <span class="forumTitle">
                      &nbsp;About
                      </span>
                    </td>
                    <td class="forumHeaderBackgroundAlternate">
                      <span class="forumTitle">
                      &nbsp;Contact
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="forumRow" width="50%">
                      <table cellpadding="4">
                        <tbody><tr>
                          <td valign="top" align="right">
                            <span class="normalTextSmallBold">
                            Joined:
                            </span>
                          </td>
                          <td valign="top" align="left">
                            <span class="normalTextSmall">
                            <span><?=$joindate;?></span>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" align="right">
                            <span class="normalTextSmallBold">
                            Last Login:
                            </span>
                          </td>
                          <td valign="top" align="left">
                            <span class="normalTextSmall">
                            <span><?=$lastseen;?></span>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" align="right">
                            <span class="normalTextSmallBold">
                            Website:
                            </span>
                          </td>
                          <td valign="top" align="left">
                            <span class="normalTextSmall">
                            <a target="_blank"></a>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" align="right">
                            <span class="normalTextSmallBold">
                            Location:
                            </span>
                          </td>
                          <td valign="top" align="left">
                            <span class="normalTextSmall">
                            <span>Unavailable to anonymous users.</span>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" align="right">
                            <span class="normalTextSmallBold">
                            Occupation:
                            </span>
                          </td>
                          <td valign="top" align="left">
                            <span class="normalTextSmall">
                            <span>Unavailable to anonymous users.</span>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" align="right">
                            <span class="normalTextSmallBold">
                            Interests:
                            </span>
                          </td>
                          <td valign="top" align="left">
                            <span class="normalTextSmall">
                            <span>Unavailable to anonymous users.</span>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" align="right">
                            <span class="normalTextSmallBold">
                            Signature:
                            </span>
                          </td>
                          <td valign="top" align="left">
                            <span class="normalTextSmall">
                            <span></span>
                            </span>
                          </td>
                        </tr>
                      </tbody></table>
                    </td>
                    <td valign="top" class="forumRow" width="50%">
                      <table cellpadding="4">
                        <tbody><tr>
                          <td valign="top" align="right">
                            <span>
                            Email:
                            </span>
                          </td>
                          <td valign="top" align="left">
                            <span class="normalTextSmall">
                            <a target="_blank">Unavailable to anonymous users.</a>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" align="right">
                            <span class="normalTextSmallBold">
                            MSN IM:
                            </span>
                          </td>
                          <td valign="top" align="left">
                            <span class="normalTextSmall">
                            <span>Unavailable to anonymous users.</span>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" align="right">
                            <span class="normalTextSmallBold">
                            AIM:
                            </span>
                          </td>
                          <td valign="top" align="left">
                            <span class="normalTextSmall">
                            <span>Unavailable to anonymous users.</span>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" align="right">
                            <span class="normalTextSmallBold">
                            Yahoo IM:
                            </span>
                          </td>
                          <td valign="top" align="left">
                            <span class="normalTextSmall">
                            <span>Unavailable to anonymous users.</span>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" align="right">
                            <span class="normalTextSmallBold">
                            ICQ:
                            </span>
                          </td>
                          <td valign="top" align="left">
                            <span class="normalTextSmall">
                            <span>Unavailable to anonymous users.</span>
                            </span>
                          </td>
                        </tr>
                      </tbody></table>
                    </td>
                  </tr>
                  <tr>
                    <td height="20" class="forumHeaderBackgroundAlternate" colspan="2">
                      <span class="forumTitle">
                      &nbsp;Post Statistics
                      </span>
                    </td>
                  </tr>
                <tr>
                  <td class="forumRow" valign="top" colspan="2">
                    <table width="100%" cellpadding="4">
                      <tbody><tr>
                        <td valign="top" align="left">
                          <span class="normalTextSmallBold">
                          <span><?=htmlspecialchars($row['username']);?> has contributed to <?=$forumcount;?> out of <?=$totalforums;?> total posts (<?=$percentage;?>% of total).</span>
                          </span>
                        </td>
                      </tr>
                      <tr>
                        <td valign="top" align="left">
                          <span class="normalTextSmallBold">
                          Most Recent Posts:
                          </span>
                        </td>
                      </tr>
<style>
.forumThing
    background-color: #dae7fd;
}
</style>
<?php
$postssql = "SELECT * FROM forum WHERE author = '".$row['id']."' ORDER BY id DESC LIMIT 10;";
            $postresult = mysqli_query($link, $postssql);
            $postchecc = mysqli_num_rows($postresult);              
            if ($postchecc > 0) {
                $alt = false; $wow = 0; while ($postrow = mysqli_fetch_assoc($postresult)) { $alt = !$alt; $wow++;
if($postrow['reply_to'] > 0){$linkthing = $postrow['reply_to']."#".$postrow['id'];

$repsql = "SELECT * FROM forum WHERE reply_to = '".$postrow['reply_to']."'";
            $represult = mysqli_query($link, $repsql);             
            $replies = mysqli_num_rows($represult);

$opsql = "SELECT * FROM forum WHERE id = '".$postrow['reply_to']."'";
            $opresult = mysqli_query($link, $opsql);             
            $oprow = mysqli_fetch_assoc($opresult);

$posttitle = "Re: ".htmlspecialchars($oprow['title']);

}else{$linkthing = $postrow['id'];

$repsql = "SELECT * FROM forum WHERE reply_to = '".$postrow['id']."'";
            $represult = mysqli_query($link, $repsql);             
            $replies = mysqli_num_rows($represult);

$posttitle = htmlspecialchars($postrow['title']);

}
?>

<?php if($wow > 1){?><tr> <td> <hr size="1"> </td> </tr><?}?>

<tr>
		<td>
                <table width="100%" cellpadding="0" cellspacing="0">
                  <tbody><tr>
                    <td class="<?=$alt ? 'forumAlternate' : '';?>">
                      <a class="linkSmallBold" href="/Forum/ShowPost.aspx?PostID=<?=$linkthing;?>"><?=$posttitle;?></a>
                      <span class="normalTextSmall"><i><?=date("n/j/Y g:i:s A",$postrow['time_posted']);?></i></span>
                      &nbsp;
                      <span class="normalTextSmall">(Total replies: <?=$replies;?>)</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="<?=$alt ? 'forumAlternate' : '';?>"><span class="normalTextSmall"><?=htmlspecialchars($postrow['content']);?></span></td>
                  </tr>
                </tbody></table>
              </td>
	</tr>

</tr></tr></tr></tr>
<?}}?>
                                                      </tbody></table>
                          <p>
                            <a class="linkSmallBold" href="/Forum/Search/default.aspx?SearchFor=1&amp;SearchText=<?=htmlspecialchars($row['username']);?>">Search for more...</a>
                          </p>
                        </td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
              </tbody></table>
              <p>
              </p>
              
            <p></p>
          </td>
          <td class="CenterColumn">&nbsp;&nbsp;&nbsp;</td>
          <!-- right margin -->
          <td class="RightColumn">&nbsp;&nbsp;&nbsp;</td>
        </tr>
      </tbody></table>
    </td>
  </tr>
</tbody></table>
</div>
<?}}?>
<? include("../../core/footer.php"); ?>