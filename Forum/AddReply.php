<?php
include ("../core/config.php");

$id = $_GET['ForumPost'] ?? 0;

$id = intval($id);

if($_POST['Cancel']){

header("Location: /Forum/ShowPost.aspx?PostID=".$id); exit;

}

$fq = mysqli_query($conn, "SELECT * FROM forum WHERE id='$id'") or die(mysqli_error($conn));

if (mysqli_num_rows($fq) < 1) {
  header('HTTP/1.1 404 Not Found'); include("../error.php"); exit;
}

include("../core/header.php");

include("../core/nav.php");

if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}

$fpost = mysqli_fetch_assoc($fq);

if ($fpost['reply_to'] != 0) {
  header("Location: /Forum/Default.aspx"); die(); exit;}

if($fpost['is_locked'] > 0){
header("Location: /Forum/ShowPost.aspx?PostID=".$id); die(); exit;
}

if(isset($_POST['Cancel'])){
header("Location: /Forum/ShowPost.aspx?PostID=".$id); die(); exit;
}

$fr = mysqli_query($conn, "SELECT * FROM forum WHERE reply_to='$id'") or die(mysqli_error($conn));
$fauthor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='{$fpost['author']}'"));

$ftimeago = ("@{$fpost['time_posted']}");

$fauthorpostcount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM forum WHERE author='{$fauthor['id']}'"));

if ($isloggedin) {
  if (isset($_POST['content'])) {
    if ($is_limited_account) {
     echo"<center>Your account has to be at least three days old to post on the forums.</center>";
    }else{if($_USER['forumreplyflood'] + 15 > time()){header("Location: /Forum/Msgs/default.aspx?MessageId=17&PostID=".$id); exit;}
else {
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $rn = time();
    $topique = $fpost['category'];
    $q = mysqli_query($conn, "INSERT INTO `forum`
                (`id`, `author`, `reply_to`, `title`, `content`, `time_posted`, `category`) VALUES
                (NULL, {$_USER['id']}, '$id', 'reaction to post', '$content', '$rn', '$topique')");
                // setcookie("replycooldown", "true", time() + 15, "/"); // 30 = 30 Seconds
                mysqli_query($link,"update users set forumreplyflood = '".time()."' where id = '".$_USER['id']."'");

    // $q = mysqli_query($conn, "INSERT INTO `forum`
    //   (`id`, `author`, `reply_to`, `title`, `content`, `time_posted`, `category`) VALUES
    //   (NULL, '{$_USER['id']}', '$id', 'reaction to post','$content','$rn','{$fpost['category']}')") or die(mysqli_error($conn));

$sauce = mysqli_query($conn, "UPDATE forum SET bump = '".time()."' WHERE id='$id'") or die(mysqli_error($conn));

      header("Location: /Forum/ShowPost.aspx?PostID=".$id); die(); exit;
}
  }
  }
}

$fmembership = "";

if ($fauthor['membership_type'] == "LEVEL_1") {
  $fmembership = "<br>&nbsp;<img src=\"/images/baron_icon.png\" title=\"This user has purchased the Baron Membership.\" height=\"28\" width=\"28\">";
} else if ($fauthor['membership_type'] == "LEVEL_2") {
  $fmembership = "<br>&nbsp;<img src=\"/images/duke_icon.png\" title=\"This user has purchased the Duke Membership.\" height=\"28\" width=\"28\">";
} else if ($fauthor['membership_type'] == "LEVEL_3") {
  $fmembership = "<br>&nbsp;<img src=\"/images/king_icon.png\" title=\"This user has purchased the King Membership.\" height=\"28\" width=\"28\">";
}
$fadm = "";
if ($fauthor['permission_level'] != "DEFAULT") {
  $fadm = "&nbsp;<img src=\"/images/icon.png\" title=\"This user is a $sitename Administrator.\" height=\"28\" width=\"28\">";
}

$fpostedatsss = new DateTime("@{$fpost['time_posted']}");
$fpostedat =  $fpostedatsss->format('d F Y G:i');


$fisonline = "Offline";

if ($fauthor['lastseen'] + 300 > time()) {
  $fisonline = "Online";
}
while ($post = mysqli_fetch_assoc($fr)) {

              $author = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='{$post['author']}'"));
              $timeago = ("@{$post['time_posted']}");
              $authorpostcount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM forum WHERE author='{$author['id']}'"));

              $membership = "";

              if ($author['membership_type'] == "LEVEL_1") {
                $membership = "<br>&nbsp;<img src=\"/images/baron_icon.png\" title=\"This user has purchased the Baron Membership.\" height=\"28\" width=\"28\">";
              } else if ($author['membership_type'] == "LEVEL_2") {
                $membership = "<br>&nbsp;<img src=\"/images/duke_icon.png\" title=\"This user has purchased the Duke Membership.\" height=\"28\" width=\"28\">";
              } else if ($author['membership_type'] == "LEVEL_3") {
                $membership = "<br>&nbsp;<img src=\"/images/king_icon.png\" title=\"This user has purchased the King Membership.\" height=\"28\" width=\"28\">";
              } else if ($author['membership_type'] == "PRO") {
                $membership = "<br>&nbsp;<img src=\"/images/pro.png\" title=\"This user has purchased a Pro Membership.\" height=\"28\" width=\"28\">";
              }
              //$adm = "";
              //if ($author['permission_level'] != "DEFAULT") {
                //$adm = "<tr><td><img src=\"content/users_moderator.gif\" alt=\"Forum Moderator\" border=\"0\"></td></tr>";
              //}

              if ($author['lastseen'] + 300 > time()) {
                $bababababba = "Online";
              } else {
                $bababababba = "Offline";
              }


              $post['content'] = nl2br($post['content']);
              }
      ?>
      
      <tr>
        <!--<td><span class="normalTextSmaller"><b>Joined:</b>--> <?php
                //$dt = new DateTime("@{$fauthor['time_joined']}");
                //echo $dt->format('d F Y');
?>
<div id="Body">
                <form method="post">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr><td></td></tr>
                            <tr valign="bottom">
                                <td>
                                    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr valign="top">
                                                <td>&nbsp;&nbsp;&nbsp;</td>
                                                <td width="95%" class="CenterColumn">
                                                    <br>
                                                    <span></span>
                                                    <span>
                                                        <table cellpadding="0" width="100%">
                                                            <tbody>
                                                                <tr></tr>
                                                                <tr><td>&nbsp;</td></tr>
                                                                <tr>
                                                                    <td valign="top" colspan="2">
                                                                        <table class="tableBorder" cellspacing="1" cellpadding="3" width="100%" align="left">
                                                                            <tbody>
                                                                                <tr>
                                                            <th class="tableHeaderText" align="left" height="25">&nbsp;Post a New Message</th>
                                                          </tr>
                                                          <tr>
                            <td class="forumRow">
                              <table cellspacing="1" cellpadding="3">
                                <tbody>
                                  <tr>
                                    <td colspan="2"><span class="normalTextSmall">The message you are replying to: </span></td>
                                  </tr>
                                  <tr>
                                    <td valign="top" nowrap="" align="right"><span class="normalTextSmallBold">Posted By: </span></td>
                                    <td valign="top" align="left">
                                      <a id="ReplyPostedBy" class="normalTextSmall" href="/User.aspx?ID=<?=$fauthor['id'];?>"><?php echo $fauthor['username'] ?></a>
                                      <a id="ReplyPostedByDate" class="normalTextSmall"><?php echo $fpostedat ?></a>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td valign="top" align="right"><span class="normalTextSmallBold">Subject: </span></td>
                                    <td valign="top" align="left"><a id="ReplySubject" class="normalTextSmall" href="ShowPost.aspx?PostID=<?=$fpost['id'];?>"><?php echo htmlspecialchars($fpost['title']); ?></a></td>
                                  </tr>
                                  <tr>
                                    <td valign="top" align="right"><span class="normalTextSmallBold">Message: </span></td>
                                    <td valign="top" align="left"><span class="normalTextSmall"><label id="ReplyBody"><?php echo nl2br(htmlspecialchars($fpost['content'])); ?></label>
                                      </span>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td class="forumAlternate">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="forumRow">
                              <table cellspacing="1" cellpadding="3">
                                <tbody>
                                  <tr>
                                    <td valign="top" nowrap="" align="right"><span class="normalTextSmallBold">Author: </span></td>
                                    <td valign="top" align="left" colspan="2"><span class="normalTextSmall"><span id="PostAuthor"><?php echo $_USER['username'] ?></span>
                                      </span>
                                    </td>
                                  </tr>
                                                                    <tr>
                                    <td valign="top" nowrap="" align="right"><span class="normalTextSmallBold">Message: </span>
                                    </td>
                                    <td valign="top" align="left">
                                      <textarea name="content" id="content" cols="72" rows="2" style="height: 200px;"></textarea>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td valign="top" align="right" colspan="2">
                                      <input type="submit" name="Cancel" id="Cancel" value=" Cancel ">
                                    </td>
                                  </tr>
                                  <tr>
                                    <td valign="top" align="right" colspan="2">            <input onclick='PostForum(1)' id="finish" type="submit" value=" Post ">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                                                                                                        </tbody>
                                                                  </table>
                                                              </td>
                                                          </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </span>
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;</td>
                                                <td>&nbsp;&nbsp;&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <?php
include ("core/footer.php");
?>
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
    background-image: url(content/forumHeaderBackground.gif);
    background-color: #4455aa
}

td.forumHeaderBackgroundAlternate
{
    background-image: url(content/forumHeaderBackgroundAlternate.gif);
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
    font-size : 11px;
}

.normalTextSmallBold
{ 
    font-size : 11px;
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



</div></div></div></div></div></div></div></div></div></div></div></div>

<? include("../core/footer.php"); ?>