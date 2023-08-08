<?php
require ("../core/header.php");
require ("../core/nav.php"); // error_reporting(E_ALL);
if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}






if($_GET['RecipientID'] || $_GET['replyto']){

$uid = $_GET['RecipientID'] ?? 0;
$uid = intval($uid);

$replyto = $_GET['replyto'] ?? 0;
$replyto = intval($replyto);

$userq = mysqli_query($conn, "SELECT * FROM users WHERE id='$uid'") or die(mysqli_error($conn));


if (!$_GET['replyto']) {

if ((mysqli_num_rows($userq) < 1) || ($uid == $_USER['id'])) {
  die("<script>document.location = \"/Browse.aspx\"</script>");
}

}

$user = mysqli_fetch_assoc($userq);

$reply = false;

if ($replyto != 0) {
  $mq = mysqli_query($conn, "SELECT * FROM messages WHERE user_to='{$_USER['id']}' AND id='$replyto'") or die(mysqli_error($conn));

  if (mysqli_num_rows($mq) != 0) {
    $reply = true;
    $reply_msg = mysqli_fetch_assoc($mq);


    $userq = mysqli_query($conn, "SELECT * FROM users WHERE id='".$reply_msg['user_from']."'") or die(mysqli_error($conn));

    $user = mysqli_fetch_assoc($userq);

    $uid = $user['id'];

    $lolok = "RE: ".htmlspecialchars($reply_msg['subject']);

    $append = "


------------------------------
On ".date("m/d/Y", $reply_msg['datesent'])." at ".date("g:i A", $reply_msg['datesent']).", ".htmlspecialchars($user['username'])." wrote:
".htmlspecialchars($reply_msg['content'])."";

  }
}

?>
<script>
  function SubmitForm(token) {
    document.getElementById("msgform").submit();
  }
</script>
 <div id="Body">
                <div class="MessageContainer">
  <div id="MessagePane" >
      <?php
              if (isset($_POST['subject'])) {
                $subject = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['subject']));
                $message = mysqli_real_escape_string($conn, $_POST['message']);


                /* while (FilterString($subject) != "OK") {
                  $profanity = FilterString($subject);
                  $repl = str_repeat("*", strlen($profanity));
                  $subject = str_replace($profanity, $repl, $subject);
                }

                while (FilterString($message) != "OK") {
                  $profanity = FilterString($message);
                  $repl = str_repeat("*", strlen($profanity));
                  $message = str_replace($profanity, $repl, $message);
                } */

                $currenttimelol = time();

$stmt = "INSERT
INTO
`messages`
(`id`, `user_from`, `user_to`, `subject`, `content`, `datesent`)
VALUES (
  NULL,
  '". $_USER['id'] . "',
  '$uid',
  '$subject',
  '$message',
  '$currenttimelol')";
                //echo ($stmt);
                $q = mysqli_query($conn, $stmt) or die(mysqli_error($conn));
                  // echo "Message sent!";
if($replyto != 0){
                  die("<script>document.location = \"/my/inbox\"</script>");
}else{
die("<script>document.location = \"/User.aspx?ID=$uid\"</script>");
}
              }
            ?>
  <form method="post" id='msgform'>
    <h3>Your Message</h3>
    <div id="MessageEditorContainer">  
      <div class="MessageEditor">
        <table width="100%" style="font-size: 12px;">
          <tbody><tr valign="top">
            <td style="width:12em">
              <div id="From">
                <span class="Label">
                <span id="MsgFrom">From:</span></span> <span class="Field">
                <span id="MsgAuthor"><?php echo $_USER['username']; ?></span></span>
              </div>
              <div id="To">
                <span class="Label">
                <span id="MsgTo">Send To:</span></span> <span class="Field">
                <span id="MsgRecipient"><?php echo $user['username']; ?></span></span>
              </div>
              
            </td>
            <td style="padding:0 24px 6px 12px">
              <div id="Subject">
                <div class="Label">
                  <label id="MsgSubjectText">Subject:</label>
                </div>
                <div class="Field">
                  <input name="subject" type="text" id="MsgSubject" class="TextBox" style="width:100%;" value="<?=$lolok;?>">
                </div>
              </div>
              <div class="Body">
                <div class="Label">
                  <label id="MsgBodyTitle">Message:</label></div>
                <textarea name="message" rows="2" cols="20" id="MsgBody" class="MultilineTextBox" style="width:100%;"><?=$append;?></textarea>
              </div>
<p style="color:red;"><b>Remember, <?=$sitename;?> staff will never ask you for your <br>password.<br>
People who ask for your password are trying to steal <br>your account.
</b></p>
            </td>
          </tr>
        </tbody></table>
      </div>
      <div style="clear:both"></div>
    </div>
    <div class="Buttons">                
      <input name="sd" data-callback='SubmitForm' value="Send" id="Send" class="Button" type="submit">
          </div>
  </form></div>
  <div style="clear: both;"></div>
  
</div>
            </div>

<?}?>





<?php if($_GET['MessageID']){

$msql = mysqli_query($conn, "SELECT * FROM messages WHERE `id` = '".(int)$_GET['MessageID']."'");

$msg = mysqli_fetch_array($msql);

$userq = mysqli_query($conn, "SELECT * FROM users WHERE id='".$msg['user_from']."'") or die(mysqli_error($conn));

$user = mysqli_fetch_assoc($userq);





if($msg['user_to'] != $_USER['id'] && $_USER['USER_PERMISSIONS'] !== 'Administrator'){ // to do: allow senders to see their message
header("Location: /my/inbox"); exit; die();
}else{
if($msg['user_to'] == $_USER['id']){
$yeet = mysqli_query($conn, "UPDATE messages SET `readto` = '1' WHERE `id` = '".$msg['id']."'");









if($_POST['delete']){
$yeet = mysqli_query($conn, "UPDATE messages SET `readto` = '1' WHERE `id` = '".(int)$_POST['read']."'");
header("Location: /my/inbox");
}



}
}

?>

<div id="Body">
					
	<div class="MessageContainer">

        <div id="MessagePane">
			<div id="ctl00_cphRoblox_pPrivateMessage">
	
				<div id="ctl00_cphRoblox_pPrivateMessageReader">
		
					<h3>Private Message</h3>
					<div class="MessageReaderContainer">
					    

<div id="Message">
    <table width="100%">
        <tr valign="top">
            <td style="width: 10em">
                <div id="DateSent"><?=date("n/j/Y g:i:s A",$msg['datesent']);?></div>
                <div id="Author">
                    
                    <a id="ctl00_cphRoblox_rbxMessageReader_Avatar" disabled="disabled" title="<?=htmlspecialchars($user['username']);?>" onclick="return false" style="display:inline-block;height:64px;width:64px;"><img src="/api/avatar/getthumb.php?id=<?=$user['id'];?>" border="0" id="img" alt="<?=htmlspecialchars($user['username']);?>" height="64px"/></a><br />
                    <a id="ctl00_cphRoblox_rbxMessageReader_AuthorHyperLink" title="Visit <?=htmlspecialchars($user['username']);?>'s Home Page" href="/User.aspx?ID=<?=$user['id'];?>"><?=htmlspecialchars($user['username']);?></a>
                </div>
                <div id="Subject">
                    <?=htmlspecialchars($msg['subject']);?><br />
                    <br />
                    <div id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_AbuseReportPanel" class="ReportAbusePanel">
			
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_ReportAbuseIconHyperLink" href="../AbuseReport/Message.aspx?ID=2274781&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fMy%2fPrivateMessage.aspx%3fMessageID%3d2274781"><img src="/images/abuse.gif" alt="Report Abuse" style="border-width:0px;" /></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_ReportAbuseTextHyperLink" href="../AbuseReport/Message.aspx?ID=2274781&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fMy%2fPrivateMessage.aspx%3fMessageID%3d2274781">Report Abuse</a></span>

		</div>
                </div>
            </td>
            <td style="padding: 0 10px 0 10px">
                <div class="Body">
                    <div id="ctl00_cphRoblox_rbxMessageReader_pBody" class="MultilineTextBox" style="height:250px;overflow-y:scroll;width:455px;">
			
                        <?=nl2br(htmlspecialchars($msg['content']));?>
                    
		</div>
                </div>
                
            </td>
        </tr>
    </table>
</div>
					    <div style="clear:both"></div>
<script>
        function yea() {
            window.location.replace("/my/inbox");
        }
    </script>
					</div><form action="" method="POST" id="formok">
					<div class="Buttons">
						<a id="ctl00_cphRoblox_lbCancel" class="Button" href="/my/inbox">Cancel</a>
						<a id="ctl00_cphRoblox_lbDelete" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbDelete','')" onclick="yea();" name="delete">Delete</a>
						<a id="ctl00_cphRoblox_lbReply" class="Button" href="/my/PrivateMessage.aspx?replyto=<?=$msg['id'];?>">Reply</a>
					</form></div>
					<div style="clear:both"></div>
				
	</div>
				
			
</div>
			
		</div>
		<div style="clear: both;"></div>
	</div>

				</div>

<?}?>





<?php
require ("../core/footer.php");
?>