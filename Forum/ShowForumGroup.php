<?php
include("../core/header.php");
include("../core/nav.php");

$topic = $_GET['ForumGroupID'] ?? 1;

$topic = intval($topic);

$groupium1 = mysqli_query($link,"SELECT * FROM forumgroups WHERE id  = '".$topic."'");
$groupium = mysqli_fetch_assoc($groupium1);

$threadsperpage = 20;
$total = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM topics WHERE category='$topic'"));
$pages = ceil($total / $threadsperpage);

$page = $_GET['page'] ?? 0;
$page = intval($page);

if ($page < 0) $page = 0;
if ($page > $pages - 1) $page = $pages - 1;

$offset = $page * $threadsperpage;

$fq = mysqli_query($conn, "SELECT * FROM topics WHERE category='$topic'") or die(mysqli_error($conn));


$embedtitle = htmlspecialchars($groupium['name'])." - ".$sitename." Forums";

include("../core/discordembed.php");

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
            <span>
              <table cellpadding="0" cellspacing="0" width="100%">
                <tbody><tr>
                  <td valign="top" align="left" width="1px">
                    <nobr>
                    </nobr>
                  </td>
                  <td class="popupMenuSink" valign="top" align="left" width="1px">
                    <nobr>
                      <a class="linkMenuSink" href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?=$groupium['id'];?>"><?=$groupium['name'];?></a>
                    </nobr>
                  </td>
                  <td class="popupMenuSink" valign="top" align="left" width="1px">
                    <nobr>
                    </nobr>
                  </td>
                  <td class="popupMenuSink" valign="top" align="left" width="1px">
                    <nobr>
                    </nobr>
                  </td>
                  <td valign="top" align="left" width="*">&nbsp;</td>
                </tr>
              </tbody></table>
              <span></span>
            </span>
            <p>
            </p><table cellpadding="2" cellspacing="1" border="0" width="100%" class="tableBorder">
              <tbody><tr>
                <th class="tableHeaderText" colspan="2" height="20">Forum</th>
                <th class="tableHeaderText" width="50" nowrap="nowrap">&nbsp;&nbsp;Threads&nbsp;&nbsp;</th>
                <th class="tableHeaderText" width="50" nowrap="nowrap">&nbsp;&nbsp;Posts&nbsp;&nbsp;</th>
                <th class="tableHeaderText" width="135" nowrap="nowrap">&nbsp;Last Post&nbsp;</th>
              </tr>
              <tr>
                <td class="forumHeaderBackgroundAlternate" colspan="5" height="20"><a class="forumTitle" href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?=$groupium['id'];?>"><?=$groupium['name'];?></a></td>
              </tr>






<? $cat1sql = mysqli_query($link,"SELECT * FROM topics WHERE category = '".$groupium['id']."' ORDER BY id ASC");
while($cat1 = mysqli_fetch_assoc($cat1sql)){ 

$catthreads = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM forum WHERE category='".$cat1['id']."' AND reply_to='0'"));
$catreplies = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM forum WHERE category='".$cat1['id']."'"));

$lp7q = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM forum WHERE category='".$cat1['id']."' ORDER BY id DESC LIMIT 1"));
$lp7a = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='{$lp7q['author']}'"));

?>

<tr>
  <td class="forumRow" align="center" valign="top" width="34" nowrap="nowrap"><img src="/forumsapi/skins/default/images/forum_status.gif" width="34" border="0"></td><td class="forumRow" width="80%"><a class="forumTitle" href="ShowForum.aspx?ForumID=<?=htmlentities($cat1['id']);?>"><?=htmlentities($cat1['name']);?></a><span class="normalTextSmall"><br><?=htmlentities($cat1['description']);?></span></td><td class="forumRowHighlight" align="center"><span class="normalTextSmaller"><?=$catthreads;?></span></td><td class="forumRowHighlight" align="center"><span class="normalTextSmaller"><?=$catreplies;?></span></td><td class="forumRowHighlight" align="center"><span class="normalTextSmaller"><span><b><center><?=forumtime($lp7q['time_posted']);?><br>by <a href="/Forum/User/UserProfile.aspx?UserName=<?=htmlentities($lp7a['username']);?>"><?=htmlentities($lp7a['username']);?></a></center><a href="#"><img border="0" src="/forumsapi/skins/default/images/icon_mini_topic.gif"></a></b></span></span></td>
</tr>

<?}?>

</tbody></table>
            <p>
              <span>
                </span></p><table cellpadding="0" cellspacing="0" width="100%">
                  <tbody><tr>
                    <td valign="top" align="left" width="1px">
<nobr>
                                    </nobr>
</td> <td class="popupMenuSink" valign="top" align="left" width="1px">
                      <nobr>
                        <a class="linkMenuSink" href="/Forum/Default.aspx"><?=$sitename;?> Forum</a>
                      </nobr>
                    </td>
                    <td class="popupMenuSink" valign="top" align="left" width="1px">
                      <nobr style="position: relative; bottom: 2px;">
                        <span class="normalTextSmallBold">&nbsp;&gt;</span>
                        <a class="linkMenuSink" href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?=$groupium['id'];?>"><?=$groupium['name'];?></a>
                      </nobr>
                    </td>
                    <td class="popupMenuSink" valign="top" align="left" width="1px">
                      <nobr>
                      </nobr>
                    </td>
                    <td class="popupMenuSink" valign="top" align="left" width="1px">
                      <nobr>
                      </nobr>
                    </td>
                    <td valign="top" align="left" width="*">&nbsp;</td>
                  </tr>
                </tbody></table>
                <span></span>
              
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


<?php
include("../core/footer.php");
?>