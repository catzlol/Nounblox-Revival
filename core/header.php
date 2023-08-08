<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/config.php");
ob_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$date=date("Y-m-d");
?>
<?php if($_USER['BC'] == 'BC') {    ?>
        <?php if($_USER['BCExpire'] == $date) {
            $removebc = str_replace("'","\'",'None');
            $sql = "UPDATE `users` SET `BC` = '".$removebc."' WHERE `users`.`id` = ".$_USER["id"].";";
            mysqli_query($link, $sql);
        } ?>  
        <?php if($_USER['BCExpire'] < $date) {
            $removebc = str_replace("'","\'",'None');
            $sql = "UPDATE `users` SET `BC` = '".$removebc."' WHERE `users`.`id` = ".$_USER["id"].";";
            mysqli_query($link, $sql);
        } ?>  
<?php } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="www-roblox-com">
  <head>
<title><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<link id="ctl00_Imports" rel="stylesheet" type="text/css" href="/AllCSSnew.css"/><link id="ctl00_Favicon" rel="Shortcut Icon" type="image/ico" href="/favicon.ico"/><meta name="author" content="<?=$sitename?> Corporation"/><meta name="keywords" content="game, video game, building game, construction game, online game, LEGO game, LEGO, MMO, MMORPG, virtual world, avatar chat"/><meta name="robots" content="all"/></head>
  <body>
      <div id="Container">
<div id="AdvertisingLeaderboard">
     <script type="text/javascript"><!--
  <h1>oops </h1>
      google_ad_client = "pub-2247123265392502";
      google_ad_width = 728;
      google_ad_height = 90;
      google_ad_format = "728x90_as";
      google_ad_type = "text_image";
      google_ad_channel = "";
      //-->
    </script>
    <script type="text/javascript" src="pagead/show_ads.js"></script>
</div>
        <div id="Header">
          <div id="Banner">
            <div id="Options">
              <div id="Authentication">
              <?php if($isloggedin == 'no') {echo '<a href="/Login/Default.aspx">Login</a>';} ?>
              <?php if($isloggedin == 'yes') {echo 'Logged in as '.$_USER['username'].'&nbsp;<strong>|</strong>&nbsp;<a href="/logout.aspx">Logout</a>';} ?>
              </div>
              <div id="Settings">
              <?php if($isloggedin == 'yes') {echo 'Age ';if($_USER['age'] == 1){?>< 13<?}else{?>13+<?} echo', Chat Mode: ';if($_USER['chatMode'] == 1){?>Safe<?}else{?>Filter<?} } ?>
              </div>
            
            </div>
            <div id="Logo"><a id="ctl00_rbxImage_Logo" title="<?=$sitename?>" href="/" style="display:inline-block;cursor:pointer;"><img src="/images/logo-1.png" border="0" id="img" alt="<?=$sitename?>" style="height: 67px;" blankurl="http://t2.roblox.com:80/blank-267x70.gif"/></a>
            </div>
            <div id="Alerts"><table style="width:100%;height:100%"><tr><td valign="middle">
              <?php if($isloggedin == 'yes') {
                echo '                <table style="width:123%;height:101%">
                <tbody><tr>
                  <td valign="middle">
          
                    <div>
                      <div id="AlertSpace">
                        <div>
'; 

if($unreadmsg != 1){ $msgplural = "s"; }

if($unreadmsg > 0){ echo'
<div id="MessageAlert">
                  <a class="TicketsAlertIcon"><img src="/images/Message.gif" style="border-width:0px;"></a>&nbsp;
                  <a href="/my/inbox" class="TicketsAlertCaption">'.$unreadmsg.' new message'.$msgplural.'</a>
                </div>
'; }

if($_USER['robux'] > 0){ echo'
                          <div id="RobuxAlert">
                            <a class="TicketsAlertIcon"><img src="/images/Robux.png" style="border-width:0px;"></a>&nbsp;
                            <a href="/Upgrades/Robux.aspx" class="TicketsAlertCaption">'.$_USER['robux'].' '.$robuxname.'</a>
                          </div>
'; }

if($_USER['tix'] > 0){ echo'
                          <div id="TicketsAlert">
                            <a class="TicketsAlertIcon"><img src="/images/Tickets.png" style="border-width:0px;"></a>&nbsp;
                            <a href="/Upgrades/Robux.aspx" class="TicketsAlertCaption">'.$_USER['tix'].' '.$tixname.'</a>
                          </div>';
}

echo'
                  </div>
                      </div>
                    </div>
                  </td>
                      </tr>
                    </tbody></table>';
              }else{ ?>

<div id="Alerts"><table style="width:100%;height:100%"><tbody><tr><td valign="middle">
            <a id="ctl00_rbxAlerts_SignupAndPlayHyperLink" class="SignUpAndPlay" href="/Login/NewAge.aspx"><img src="/images/SignupBannerBlue.png" alt="Sign-up and Play!" border="0"></a>              </td></tr></tbody></table></div>

<?}?>
</td></tr></table></div>
          </div>