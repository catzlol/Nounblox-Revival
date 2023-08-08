<?php
require ("core/config.php");

$id = (int) addslashes($_GET['id']);
if(!$id){header('HTTP/1.1 404 Not Found'); include("error.php"); exit;}
$gameitem = mysqli_query($link, "SELECT * FROM games WHERE id='$id'") or die(mysqli_error($link));
$game = mysqli_fetch_assoc($gameitem);
if(!$game) {header('HTTP/1.1 404 Not Found'); include("error.php"); exit;}
$creatorq = mysqli_query($link, "SELECT * FROM users WHERE id='".$game['creator_id']."'");
$creator = mysqli_fetch_assoc($creatorq);

$title = htmlspecialchars($game['name'])." by ".htmlspecialchars($creator['username'])." - ".$sitename." Places";

require ("core/header.php");
require ("core/nav.php");

$embedimage = "/thumbs/index.php?id=".$game['id'];

if($game['description'] != ""){
$embeddescription = htmlspecialchars($game['description']);
}

include "core/discordembed.php";
?>
<title>
  <?=$title?>
</title>
<div id="Body">
<script>
  var sid;
  var token;
  var sid2;
  var activeTab = 1;
  function showTab(num) 
    {
    $("#tab" + activeTab).removeClass("Active");
    $("#tabb" + activeTab).hide();
    activeTab = num;
    $("#tab" + num).addClass("Active");
    $("#tabb" + num).show();
  }
  function JoinGame(serverid = 0) 
    {
    $("#joiningGameDiag").show();
    $.post("", {placeId:1, serverId:serverid}, function(data) {
      if(isNaN(data) == false) 
            {
        sid = data;
        setTimeout(function() { checkifProgressChanged(); }, 1500);
      }
            else if (data.startsWith("")) 
            {
        $("#Requesting").html("The server is ready. Joining the game... ");
        token = data;
        setTimeout(function() { closeModal(); }, 2000);
      } 
            else 
            {
        $("#Spinner").hide();
        $("#Requesting").html(data);
      }
    });
  }
  function JoinGame2(serverid = 0) 
    {
    $("#joiningGameDiag").show();
    $.post("", {placeId:1, serverId:serverid}, function(data) {
      if(isNaN(data) == false) 
            {
        sid = data;
        setTimeout(function() { checkifProgressChanged(); }, 1500);
      }
            else if (data.startsWith("")) 
            {
        $("#Requesting").html("Put the place ID, and then your <a href='/my/accountcode.php'>Account Code</a>.<br>If nothing popped up, make sure you have the URI installed.");
        $("#Spinner").hide();
        token = data;
      } 
            else 
            {
        $("#Spinner").hide();
        $("#Requesting").html(data);
      }
    });
  }
  function HostGame(serverid = 0) 
    {
    $("#joiningGameDiag").show();
    $.post("", {placeId:1, serverId:serverid}, function(data) {
      if(isNaN(data) == false) 
            {
        sid = data;
        setTimeout(function() { checkifProgressChanged(); }, 1500);
      }
            else if (data.startsWith("")) 
            {
        $("#Requesting").html("The server is starting. Hosting the game... ");
        token = data;
        location.href= "/host.aspx?id=<?php echo $game['id']; ?>";
        setTimeout(function() { closeModal(); }, 2000);
      } 
            else 
            {
        $("#Spinner").hide();
        $("#Requesting").html(data);
      }
    });
  }
  function checkifProgressChanged() 
    {
    $.getJSON("" + sid, function(result) {
      $("#Requesting").html(result.msg);
      if(result.token == null) 
            {
        if(result.check == true) 
                {
          setTimeout(function() { checkifProgressChanged() }, 750);
        } 
                else 
                {
          $("#Spinner").hide();
        }
      } 
            else 
            {
        token = result.token;
        location.href="" + token;
        setTimeout(function() { closeModal(); }, 2000);
      }
    });
  }
  function joinServer() 
    {
    $.getJSON("" + sid2, function(result) 
        {
      $("#Requesting").html(result.msg);
      if(result.token != null) 
            {
        token = result.token;
        location.href="" + token;
        setTimeout(function() { closeModal(); }, 2000);
      }
    });
  }
  function closeModal() 
    {
    $("#joiningGameDiag").hide();
    $("#Spinner").show();
    $("#Requesting").html("Loading...");
  }
    </script>
<style>
  #ItemContainer #Thumbnail_Place {
  height: 230px;
  width: 420px;
  }
  .PlayGames {
  background-color: #ccc;
  border: dashed 1px Green;
  clear: left;
  color: Green;
  float: left;
  margin-top: 10px;
  padding: 10px 5px;
  text-align: center;
  width: 410px;
  }
  #ItemContainer #Actions, #ItemContainer #Actions_Place {
  background-color: #fff;
  border-bottom: dashed 1px #555;
  border-left: dashed 1px #555;
  border-right: dashed 1px #555;
  clear: left;
  float: left;
  padding: 5px;
  text-align: center;
  min-width: 0;
  position: relative;
  }
</style>
<div id="joiningGameDiag" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(100,100,100,0.25);">
  <div class="modalPopup" style="width: 27em; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
    <div style="margin: 1.5em">
<div id="Spinner" style="float:left;margin:0 1em 1em 0">
        <img src="/images/ProgressIndicator2.gif" style="border-width:0px;">
      </div>
      <div id="Requesting" style="display: inline">
        Loading...
      </div>
      <div style="text-align: center; margin-top: 1em">
        <input id="Cancel" onclick="closeModal()" type="button" class="Button" value="Cancel">
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<style>
#ItemContainer {
    background-color: #eee;
    border: solid 1px #555;
    color: #555;
    margin: 0 auto;
    width: 620px;
}
#Item {
    font-family: Verdana, Sans-Serif;
    padding: 10px;
}
</style>
<div id="ItemContainer" style="width:725px; margin:unset;float:left;padding-bottom:7px;">
  <h2><?php echo htmlentities($game['name']); ?></h2>
  <div id="Item">
    <div id="Summary" style="width:251px;">
      <h3><?=$sitename?> Place</h3>
      <div id="Creator" class="Creator">
        <div class="Avatar">
<img src="/api/avatar/getthumb.php?id=<?php echo $game['creator_id']; ?>" height="110">
          <a title="<?php echo $creator['username']; ?>" href="/User.aspx?ID=<?php echo $game['creator_id']; ?>" style="display:inline-block;cursor:pointer;"></a>
        </div>
        Creator: <a href="/User.aspx?ID=<?php echo $game['creator_id']; ?>"><?php echo $creator['username']; ?></a>
      </div>
      <div id="LastUpdate">Updated: <?php echo $game['datecreated']; ?></div>
      <div id="Favorited">Favorited: 0 times</div>
      <div class="Visited">Visited: 0 times</div>
            <?php if($game['description'] != ""){?><div>
        <div id="DescriptionLabel">Description:</div>
        <div id="Description" style="width:auto;"><?php echo nl2br(htmlentities($game['description'])); ?></div>
      </div><?}?>
            <div id="ReportAbuse">
        <div class="ReportAbusePanel">
          <center>
              <br>
            <span class="AbuseIcon"><a><img src="/images/abuse.gif" alt="Report Abuse" border="0"></a></span>
            <span class="AbuseButton"><a>Report Abuse</a></span>
                      </center>
        </div>
      </div>
    </div>
    <div id="Details">
      <div id="Thumbnail_Place">
        <a title="<?php echo htmlentities($game['name']); ?>
" style="display:inline-block;cursor:pointer;"><img src="/thumbs/index.php?id=<?=$game['id'];?>" width="420" height="230" border="0" alt="<?php echo $game['name']; ?>" onerror="this.onerror=null;this.src='/thumbs/default/game.png';"></a>
      </div>
      <div id="Actions_Place" style="width: 408px;">
<a href="#">Favorite</a>
              </div>
            <div class="PlayGames">
        <div style="text-align: center; margin: 1em 5px;">
                    <span style="display:inline;"><img src="/images/public.png" style="border-width:0px;">&nbsp;Public</span>
                    <img src="/images/CopyLocked.png" style="border-width:0px;"> Copy Protection: CopyLocked
                  </div>
        <div>
          <div style="display: inline; width: 10px; ">
            <a href="/Install/Default.aspx"><p style="color: grey;">Don't have the client ?!</p></a>
                      <div style="display: inline; width: 10px; ">
            <a href="/client/uri.reg"><p style="color: grey;">Install the URI</p></a>
                        <?php
if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$launcherlink = "/Login/Default.aspx?ReturnUrl=".$yourl;
}else{
$launcherlink = $uriname."://?placeid=".$game['id']."&accountcode=".$_USER['accountcode'];
}
?>
            <?php echo "<a onclick='JoinGame();' href='".$launcherlink."'><img src='/images/Play.png' alt='Visit Online'></a>"; ?>
<!--<input type="image" class="ImageButton" src="/images/Play.png" alt="Visit Online" onclick="JoinGame2()"></a>!-->
<!--<br><input type="image" class="ImageButton" src="/images/Host.png" alt="Host game" onclick="HostGame()">-->
          </div>
        </div>
         
      </div>
      <div style="clear: both;"></div>
    </div>
  </div>
</div>

</div></div></div></div></div></div></div>

<div style="clear: both;"></div>
      <?php require ("core/footer.php"); ?>