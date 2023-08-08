<?php
require ("../core/header.php");
require ("../core/nav.php"); // error_reporting(E_ALL);
if (!$isloggedin) {
  header("Location: /Login/");
}
$uid = $_GET['id'] ?? 0;
$uid = intval($uid);

$replyto = $_GET['replyto'] ?? 0;
$replyto = intval($replyto);

$userq = mysqli_query($conn, "SELECT * FROM users WHERE id='$uid'") or die(mysqli_error($conn));

if ((mysqli_num_rows($userq) < 1) || ($uid == $_USER['id'])) {
  die("<script>document.location = \"/users/\"</script>");
}

$user = mysqli_fetch_assoc($userq);

$reply = false;

if ($replyto != 0) {
  $mq = mysqli_query($conn, "SELECT * FROM messages WHERE user_from='$uid' AND user_to='{$_USER['id']}' AND id='$replyto'") or die(mysqli_error($conn));

  if (mysqli_num_rows($mq) != 0) {
    $reply = true;
    $reply_msg = mysqli_fetch_assoc($mq);
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
                $message = nl2br(htmlspecialchars(mysqli_real_escape_string($conn, $_POST['message'])));


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
                  echo "Message sent!";
                  die("<script>document.location = \"/user.aspx?id=$uid\"</script>");
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
                  <input name="subject" type="text" id="MsgSubject" class="TextBox" style="width:100%;">
                </div>
              </div>
              <div class="Body">
                <div class="Label">
                  <label id="MsgBodyTitle">Message:</label></div>
                <textarea name="message" rows="2" cols="20" id="MsgBody" class="MultilineTextBox" style="width:100%;"></textarea>
              </div> 
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
<?php
require ("core/footer.php");
?>