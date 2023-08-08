<?php
include("../core/config.php");

$topic = $_GET['ForumID'] ?? 1;

$topic = intval($topic);

$topicsql = mysqli_query($link,"SELECT * FROM topics WHERE id  = '".$topic."'");

$exists = mysqli_num_rows($topicsql);

if($exists == 0){
header("Location: /Forum/Msgs/default.aspx?MessageId=6"); exit;
// header('HTTP/1.1 404 Not Found'); include("../error.php"); exit;
}

include("../core/header.php");

include("../core/nav.php");

$topicscheisse = mysqli_fetch_assoc($topicsql);

$groupium1 = mysqli_query($link,"SELECT * FROM forumgroups WHERE id  = '".$topicscheisse['category']."'");
$groupium = mysqli_fetch_assoc($groupium1);



$embedtitle = htmlspecialchars($topicscheisse['name'])." - ".$sitename." Forums";

$embeddescription = htmlspecialchars($topicscheisse['description']);

include("../core/discordembed.php");






$threadsperpage = 20;
$total = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM forum WHERE category='$topic' AND reply_to='0' ORDER BY is_pinned DESC, bump DESC"));
$pages = ceil($total / $threadsperpage);

$page = $_GET['page'] ?? 0;
$page = intval($page);

if ($page < 0) $page = 0;
if ($page > $pages - 1) $page = $pages - 1;

$offset = $page * $threadsperpage;

$fq = mysqli_query($conn, "SELECT * FROM forum WHERE category='$topic' AND reply_to='0' ORDER BY is_pinned DESC, bump DESC") or die(mysqli_error($conn));
?>
 <div id="Body">
     <style>
/*****************************************************
General Anchor
*****************************************************/
a.linkSmallBold, a.linkMenuSink
{
    font-weight: bold;
}

a.linkSmall, a.LinkSmallBold, a.linkMenuSink
{
    color: navy;
    font-size: 10px;
}


a.linkSmallBold:visited, a.linkMenuSink:visited
{
    color: #013DA4;
}

a.linkSmallBold:Hover, a.linkMenuSink:Hover
{
    color: #DD6900;
}


/*****************************************************
Text and Anchor to display when a user is online
*****************************************************/
.userOnlineLinkBold, a.userOnlineLinkBold, a.userOnlineLinkBold:Visited, a.userOnlineLinkBold:Hover, a.userOnlineLinkBold:Link
{
    font-weight: bold;
    color: #0055E7;
}

.moderatorOnlineLinkBold, a.moderatorOnlineLinkBold, a.moderatorOnlineLinkBold:Visited, a.moderatorOnlineLinkBold:Hover, a.moderatorOnlineLinkBold:Link
{
    font-weight: bold;
    color: darkblue;
}

.adminOnlineLinkBold, a.adminOnlineLinkBold, a.adminOnlineLinkBold:Visited, a.adminOnlineLinkBold:Hover, a.adminOnlineLinkBold:Link
{
    font-weight: bold;
    color: black;
}

/*****************************************************
Text and anchors used in the navigation menu
*****************************************************/
.menuTitle
{
    font-weight: bold;
    font-size: 20px;
    font: normal 8pt/normal Verdana, sans-serif;
    FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    color: navy;
}

.menuText
{
    font-size: 0.9em;
    font-weight: bold;
    font: normal 8pt/normal Verdana, sans-serif;
    color: #FFFFFF;
}

a.menuTextLink:visited, a.menuTextLink:link
{
    font-size: 0.9em;
    text-decoration: none; 
    font: normal 8pt/normal Verdana, sans-serif;
    color: #013DA4;
}

a.menuTextLink:Hover
{
    color: #000000;
}


/*****************************************************
Text and anchors used in the search
*****************************************************/
.searchPager
{
    font-size : 0.9em;
    font-weight: bold;
}

.searchItem
{
    background-color: #DDEEFF; 
}

.searchAlternatingItem
{
    background-color: #FFFFFF;
}


/*****************************************************
Default separator style for PostList
*****************************************************/
td.flatViewSpacing
{
    height: 2px;
    background-color: #80B7FF;
}

/*****************************************************
Table Header and cell definitions
*****************************************************/
th
{
    background-image: url(/forumsapi/skins/default/images/forumHeaderBackground.gif);
    background-color: #4455aa
}

td.forumHeaderBackgroundAlternate
{
    background-image: url(/forumsapi/skins/default/images/forumHeaderBackgroundAlternate.gif);
    background-color: #EBEDF6;
}

/*****************************************************
Body
*****************************************************/
body 
{
    FONT-SIZE: 8pt;
    font: normal 8pt/normal Verdana, sans-serif;
    scrollbar-face-color: #DEE3E7;
    scrollbar-highlight-color: #FFFFFF;
    scrollbar-shadow-color: #DEE3E7;
    scrollbar-3dlight-color: #D1D7DC;
    scrollbar-arrow-color:  #006699;
    scrollbar-track-color: #EFEFEF;
    scrollbar-darkshadow-color: #98AAB1;
}


/*****************************************************
Validation Text
*****************************************************/
.validationWarningSmall
{
    color: Red;
    font-size : 0.9em;
}

/*****************************************************
General Text
*****************************************************/
.normalTextSmall 
{ 
    font-size : 12px;
}

.normalTextSmallBold
{ 
    font-size : 12px;
    font-weight: bold;
}

.normalTextSmaller
{
    font-size: 10px;
}

.normalTextSmall, .normalTextSmallBold, .normalTextSmaller
{ 
    FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
}

/*****************************************************
Text used on tables with a background
*****************************************************/
.tableHeaderText
{
    color: white;
    font-size: 10px;
    font-weight:bold;
    font: normal 8pt/normal Verdana, sans-serif;
}

/*****************************************************
Border used around tables
*****************************************************/
.tableBorder
{
    border: 1px #013DA4 solid; 
    background-color: #FFFFFF;
}

/*****************************************************
Main forum colors
*****************************************************/
td.forumRow
{
    background-color: #DDEEFF;
}


td.forumAlternate
{
    background-color: #DAE7FD;
}

/*****************************************************
Background color and text used in threaded view
*****************************************************/
td.threadTitle
{
    background-color: #D4D9EC;
}

.threadDetailTextSmall
{
    color: #0055E7;
    font-size: 0.9em;
}

.threadDetailTextSmallBold
{
    color: #0055E7;
    font-size: 0.9em;
    font-weight: bold;
    font: normal 8pt/normal Verdana, sans-serif;
}

td.forumRowHighlight
{
    background-color: #D4D9EC;
}

/*****************************************************
Text and links used in ForumGroupRepeater and ForumRepeater
*****************************************************/
.forumTitle
{
    font-size: 1.0px;
    font-weight: bold;
    font: normal 8pt/normal Verdana, sans-serif;
    color: #013DA4;
}


a.forumTitle:visited, a.forumTitle:link
{
    font-size: 1.0em;
    font-weight: bold;
    color: #013DA4;
}

a.forumTitle:hover
{
    color: #DD6900;
}

.forumName
{
    font-weight: bold;
    FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    font-size: 16px; 
    text-decoration: none; 
    color: navy;
}

a.forumName:hover
{
    color: #DD6900;
    text-decoration: underline;
}


/*****************************************************
Form Elements
*****************************************************/
select
{   FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    font-size: 0.9em;
    font-weight: bold;
    background-color: #DAE7FD;
    border-color: Black;
}

textarea
{
    font-size: 0.9em;
    FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    background-color: White;
    border-color: Black;
}

/*****************************************************
Menu Controls
*****************************************************/
A.linkMenuSink
{
    font-size: 0.9em;
    FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    position: relative;
}

TD.popupMenuSink
{
    position: relative;
}

DIV.popupMenu
{
    border: 1px solid blue;
}

DIV.popupTitle
{
  FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    color: white;
    font-weight: bold;
    background-color: #4455AA;
}

DIV.popupItem
{
    font-size: 1.0em;
    font-weight: bold;
  FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    background-color: #DDEEFF;
}
</style>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr><td></td></tr>
                        <tr valign="bottom">
                            <td>
                                <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                        <tr valign="top">
                                            <td>&nbsp; &nbsp; &nbsp;</td>
                                            
                                            <td width="95%" class="CenterColumn">



<table width="100%" cellspacing="1" cellpadding="0">
	<tbody><tr>
		<td align="right" valign="middle">
			<a id="ctl00_cphRoblox_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink" href="/Forum/Default.aspx"><img src="/forumsapi/skins/default/images/icon_mini_home.gif" border="0">Home &nbsp;</a>
			<a id="ctl00_cphRoblox_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx"><img src="/forumsapi/skins/default/images/icon_mini_search.gif" border="0">Search &nbsp;</a>
			
			
      <?php if(!$_USER){?> 
      <a id="ctl00_cphRoblox_NavigationMenu2_ctl00_RegisterMenu" class="menuTextLink" href="/Forum/User/CreateUser.aspx"><img src="/forumsapi/skins/default/images/icon_mini_register.gif" border="0">Register &nbsp;</a>
      <?}else{?>
      <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_ProfileMenu" class="menuTextLink" href="/Forum/User/EditUserProfile.aspx"><img src="/forumsapi/skins/default/images/icon_mini_profile.gif" border="0">Profile &nbsp;</a>

      <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_MyForumsMenu" class="menuTextLink" href="/Forum/User/MyForums.aspx"><img src="/forumsapi/skins/default/images/icon_mini_myforums.gif" border="0">MyForums &nbsp;</a>
<?}?>			
			
			
			
		</td>
	</tr>
</tbody></table>



<tr>
		<td colspan="2" align="left"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1" name="Whereami1">
<table cellpadding="0" cellspacing="0" width="100%">
    <tbody><tr>
                                  <td width="1px" valign="top" align="left">
                                    <nobr>
                                    </nobr>
                                  </td>
                                  <td class="popupMenuSink" width="1px" valign="top" align="left">
                                  </td>
                                  <td class="popupMenuSink" width="1px" valign="top" align="left">
                                    <nobr>
                                      <span class="normalTextSmallBold">&shy;</span>
                                      <a class="linkMenuSink" href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?=$groupium['id'];?>"><?=$groupium['name'];?></a>
                                    </nobr>
                                  </td>
                                  <td class="popupMenuSink" width="1px" valign="top" align="left">
                                    <nobr>
                                      <span class="normalTextSmallBold">&nbsp;&gt;</span>
                                      <a class="linkMenuSink" href="/Forum/ShowForum.aspx?ForumID=<?=$topicscheisse['id'];?>"><?=$topicscheisse['name'];?></a>
                                    </nobr>
                                  </td>
                                  <td width="*" valign="top" align="left">&nbsp;</td>
                                </tr>
</tbody></table>

<span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1_ctl00_MenuScript"></span></span></td>
	</tr>






                                                
                                                <span></span>
                                                <span>
                                                    <table cellpadding="0" width="100%">
                                                        <tbody>
                                                            <tr></tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                            <tr>
                                                                <td valign="bottom" align="left">
                                                                    <a href="AddPost.aspx?ForumID=<?php echo $topic ?>">
                                                                        <img src="/forumsapi/skins/default/images/newtopic.gif" border="0">
                                                                    </a>
                                                                </td>
                                                                <td align="right">
                                                                    <span class="normalTextSmallBold">Search this forum: </span>
                                                                    <input name="ForumSearch" type="text">
                                                                    <input type="submit" name="ForumSearchBtn" value=" Go ">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td valign="top" colspan="2">
                                                                    <table class="tableBorder" cellspacing="1" cellpadding="3" border="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
    <th class="tableHeaderText" align="left" colspan="2" height="25">&nbsp;Thread&nbsp;</th><th class="tableHeaderText" align="center" nowrap="nowrap">&nbsp;Started By&nbsp;</th><th class="tableHeaderText" align="center">&nbsp;Replies&nbsp;</th><th class="tableHeaderText" align="center">&nbsp;Views&nbsp;</th><th class="tableHeaderText" align="center" nowrap="nowrap">&nbsp;Last Post&nbsp;</th>
  </tr>
      <tr>
      <?php
                while ($post = mysqli_fetch_assoc($fq)) {
                  $author = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='{$post['author']}'"));
                  $replies = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM forum WHERE reply_to='{$post['id']}'"));
                  if ($replies > 0) {
                    $lastreply = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM forum WHERE reply_to='{$post['id']}' ORDER BY id DESC LIMIT 1"));
                    $lrtimeago = forumtime($lastreply['time_posted']);
                    $lrauthor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='{$lastreply['author']}'"));
                    $lrstring = "<b>".$lrtimeago."</b> <br> by <a href=\"/Forum/User/UserProfile.aspx?UserName={$lrauthor['username']}\">{$lrauthor['username']}</a>";
                  if($post['is_pinned'] > 0){
                    $lrstring = "<b>Pinned Post</b> <br> by <a href=\"/Forum/User/UserProfile.aspx?UserName={$lrauthor['username']}\">{$lrauthor['username']}</a>";
}

} else {
                    $replies = "-"; 
                    $lrstring = "<b>".forumtime($post['time_posted'])."</b> <br> by <a href=\"/Forum/User/UserProfile.aspx?UserName={$author['username']}\">{$author['username']}</a>";
if($post['is_pinned'] > 0){
                    $lrstring = "<b>Pinned Post</b> <br> by <a href=\"/Forum/User/UserProfile.aspx?UserName={$author['username']}\">{$author['username']}</a>";
}
                  }

$icon = "topic_notread.gif";

if($post['is_pinned'] > 0){
if($post['is_locked'] > 0){
                    $icon = "topic-pinned&locked_notread.gif";
}
}

if($post['is_pinned'] > 0){
if($post['is_locked'] <= 0){
                    $icon = "topic-pinned_notread.gif";
}
}

if($post['is_pinned'] <= 0){
if($post['is_locked'] > 0){
                    $icon = "topic-locked_notread.gif";
}
}



if ($post['views'] > 0) { $views = $post['views']; }else{ $views = "-"; }

                  echo "<tr>
                    <td class=\"forumRow\" align=\"center\" valign=\"middle\" width=\"25\"><img src=\"/forumsapi/skins/default/images/".$icon."\" ></td>
                    <td class=\"forumRow\" height=\"25\"><a class=\"linkSmallBold\" href=\"ShowPost.aspx?PostID={$post['id']}\">".htmlspecialchars($post['title'])."</a></td>
                    <td class=\"forumRowHighlight\">&nbsp;{$author['username']}</td>
                    <td class=\"forumRowHighlight\" align=\"center\">$replies</td>
                    <td class=\"forumRowHighlight\" align=\"center\">$views</td>
                    <td class=\"forumRowHighlight\"><center>$lrstring</center></td>
                  </tr>";
                }
                ?>

  </tr>


</tr></th></td></table></tr></th></td></table></tr></th></td></table>
<?php
include("../core/footer.php");
?>