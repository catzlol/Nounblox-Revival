<?php
require ("../../core/header.php");
require ("../../core/nav.php");

if($_USER['USER_PERMISSIONS'] !== 'Administrator') {header('location: /Forum/Msgs/default.aspx?MessageId=1');}

?>

<link rel="stylesheet" href="/forumsapi/skins/default/style/default.css" type="text/css">
<div id="Body">

<?php
$id = $_GET['PostID'] ?? 0;

$id = intval($id);



                    $resultsperpage = 25;
                    $check = mysqli_query($conn, "SELECT * FROM forum WHERE reply_to='$id'");
                    $usercount = mysqli_num_rows($check);

                    $numberofpages = ceil($usercount/$resultsperpage);

                    if(!isset($_GET['PageIndex'])) {
                        $page = 1;
                    }else{
                        $page = intval($_GET['PageIndex']);
                    }

                    $thispagefirstresult = ($page-1)*$resultsperpage;
                    
$fr = mysqli_query($conn, "SELECT * FROM forum WHERE reply_to='$id'") or die(mysqli_error($conn));

if(mysqli_num_rows($fr) > 0){$hasreplies = "Yes";}else{$hasreplies = "No";}

$fq = mysqli_query($conn, "SELECT * FROM forum WHERE id='$id'") or die(mysqli_error($conn));

if (mysqli_num_rows($fq) < 1) {
  header("Location: /Forum/Msgs/default.aspx?MessageId=6"); die(); exit;
}

$fpost = mysqli_fetch_assoc($fq);


$forumgroup = $fpost['category'];


if($_POST['Cancel']){

if ($fpost['reply_to'] != 0) {
  $letsgetthis = mysqli_query($link,"SELECT * FROM forum WHERE id  = '".$fpost['reply_to']."'");
  $letsgo = mysqli_fetch_assoc($letsgetthis);
  $whereamiid = $fpost['reply_to']."#".$fpost['id'];
  $goto = "/Forum/ShowPost.aspx?PostID=".$whereamiid;
}else{
  $whereamiid = $fpost['id'];
  $goto = "/Forum/ShowPost.aspx?PostID=".$whereamiid;
}

header("Location: ".$goto);
}



if($_POST['Delete']){
if($_POST['DeleteReason'] != ""){
if($_USER['USER_PERMISSIONS'] == 'Administrator') {
$delete = mysqli_query($conn, "DELETE FROM forum WHERE id='$id'") or die(mysqli_error($conn));





if ($fpost['reply_to'] != 0) {
  $letsgetthis = mysqli_query($link,"SELECT * FROM forum WHERE id  = '".$fpost['reply_to']."'");
  $letsgo = mysqli_fetch_assoc($letsgetthis);
  $whereamiid = $letsgo['id'];
  $goto = "/Forum/ShowPost.aspx?PostID=".$whereamiid;
}else{
  if($hasreplies == "Yes"){
  $delete = mysqli_query($conn, "DELETE FROM forum WHERE reply_to='$id'") or die(mysqli_error($conn));
  }
  $whereamiid = $fpost['id'];
  $goto = "/Forum/ShowForum.aspx?ForumID=".$forumgroup;
}

header("Location: ".$goto);
}
}
}




if ($fpost['reply_to'] != 0) {
  // header("Location: /Forum/Msgs/default.aspx?MessageId=6"); die(); exit;
}

$topicsql = mysqli_query($link,"SELECT * FROM topics WHERE id  = '".$fpost['category']."'");
$topicscheisse = mysqli_fetch_assoc($topicsql);

$groupium1 = mysqli_query($link,"SELECT * FROM forumgroups WHERE id  = '".$topicscheisse['category']."'");
$groupium = mysqli_fetch_assoc($groupium1);

   ?>
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
                                  <td class="popupMenuSink" width="1px" valign="top" align="left">
                                    <nobr>
                                      <span class="normalTextSmallBold">&nbsp;&gt;</span>
<?php
if ($fpost['reply_to'] != 0) {
  $letsgetthis = mysqli_query($link,"SELECT * FROM forum WHERE id  = '".$fpost['reply_to']."'");
  $letsgo = mysqli_fetch_assoc($letsgetthis);
  $whereamiid = $letsgo['id'];
  $whereamititle = htmlspecialchars($letsgo['title']);
  $hash = "#".$fpost['id'];
  $specification = "(Reply)";
}else{
$whereamiid = $fpost['id'];
$whereamititle = htmlspecialchars($fpost['title']);
}
?>
                                      <a class="linkMenuSink" href="/Forum/ShowPost.aspx?PostID=<?=$whereamiid;?><?=$hash;?>"><?=$whereamititle;?> <?=$specification;?></a>
                                    </nobr>
                                  </td>
                                  <td width="*" valign="top" align="left">&nbsp;</td>
                                </tr>
</tbody></table>

<span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1_ctl00_MenuScript"></span></span></td>
	</tr>

</td></tr></tbody></table>

<form action="" method="POST">
<p>
<center>
<table Class="tableBorder" CellPadding="3" Cellspacing="1">
  <tr>
    <th class="tableHeaderText" align="left" height="25">
      &nbsp;Delete Post/Thread
    </th>
  </tr>
  <tr>
    <td class="forumRow">
      <table cellSpacing="1" cellPadding="3">
        <tr>
          <td vAlign="top" nowrap align="left"><span class="normalTextSmall">Please provide a reason for why this post is being deleted. Note, this is a final action - the post/thread cannot be recovered.</span></td>
        </tr>
        <tr>
          <td align="left" colspan="2">
            <table>
              <tr> 
                <td align="right">
                  <span class="normalTextSmallBold">Has replies: </span>
                </td>
                <td align="left">
                  <?=$hasreplies;?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td vAlign="top" colspan="2" nowrap align="left"><span class="normalTextSmallBold"><asp:CheckBox Checked="true" id="SendUserEmail" runat="server" text=" Send user email (thread owner only) why post was deleted"/></span></td>
        </tr>
        <tr>
          <td align="left">
            <table>
              <tr>
                <td vAlign="top" colspan="2" nowrap align="right"><span class="normalTextSmallBold">Reason: </span></td>
                <td vAlign="top" align="left"><textarea id="DeleteReason" name="DeleteReason" rows="8" cols="90"></textarea>
<br><text class="validationWarningSmall"><?php if($_POST['Delete']){ if($_POST['DeleteReason'] == ""){?>You must supply a reason.<?}}?>&nbsp;</text>
</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
                                    <td valign="top" align="right" colspan="2">
                                      <input type="submit" name="Cancel" id="Cancel" value=" Cancel "> &nbsp; <input type="submit" name="Delete" value=" Delete ">
                                    </td>
                                  </tr>
      </table>
    </td>
  </tr>
</table>
</center>
</form>

</div>

<?php
require ("../../core/footer.php");
?>