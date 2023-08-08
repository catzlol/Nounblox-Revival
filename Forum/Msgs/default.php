<?php
// messages from wayback machine archives
// could POSSIBLY store in the database instead...


$idd = htmlspecialchars($_GET['MessageId']);

if($idd == 1){
$mtitle= "Error: You are Unable to Administer";
$mbody = "In order to perform <i>any</i> administration duties on this Web site, your user account must be marked as having administrator rights.  Unfortunately, your account does not have such rights.<p>If you believe you've reached this message in error, please notify the Web site administrator.</p>";
}

if($idd == 6){
$mtitle = "Error: Unknown forum";
$mbody = "The forum you requested does not exist.";
}

if($idd == 9){ // Note: Unused?
$mtitle = "Error: Post Does Not Exist";
$mbody = "The post you attempted to view does not exist. Most likely, the message you are trying to view has been deleted by one of the site's administrators.";
}

if($idd == 14){
$mtitle = "Error: User Does Not Exist";
$mbody = "The user you attempted to view does not exist.";
}

if($idd == 17){
$mtitle = "Error: You Are Posting Too Fast";
$mbody = "Sorry, the flood check has blocked your post. Please press back and try again in a few seconds.";
}

?>



<?php
require ("../../core/header.php");
require ("../../core/nav.php");
require ("../../core/discordembed.php");
?>
<link rel="stylesheet" href="/forumsapi/skins/default/style/default.css" type="text/css">
<div id="Body">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody>
    <tr valign="bottom">
      <td>
        <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
          <tbody>
            <tr valign="top">
              <!-- left column -->
              <td>&nbsp; &nbsp; &nbsp;</td>
              <!-- center column -->
              <td width="95%" class="CenterColumn">
                <p>
                  <span>
                  </span>
                </p>
                <table width="100%">
                  <tbody>
                    <tr>
                      <td align="center">
                        <table cellspacing="1" cellpadding="0" width="50%" class="tableBorder">
                          <tbody>
                            <tr>
                              <th align="left">
                                &nbsp;<span class="tableHeaderText"><?=$mtitle;?></span>
                              </th>
                            </tr>
                            <tr>
                              <td class="forumRow">
                                <table cellpadding="3" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      <td>
                                        &nbsp;
                                      </td>
                                      <td>
                                        <span class="normalTextSmall"><?=$mbody;?></span>
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
                    <tr>
                      <td align="center">
                        <br>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <p></p>
              </td>
              <td class="CenterColumn">&nbsp;&nbsp;&nbsp;</td>
              <!-- right margin -->
              <td class="RightColumn">&nbsp;&nbsp;&nbsp;</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>
				</div>
<? include("../../core/footer.php"); ?>