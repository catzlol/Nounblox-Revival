<?php
require ("../core/header.php");
require ("../core/nav.php");

error_reporting(E_ALL);

$msg = mysqli_query($link, "SELECT * FROM friends WHERE user_to='{$_USER['id']}' AND arefriends='0' ORDER BY id DESC") or die(mysqli_error($connect));
$achievements = mysqli_query($link, "SELECT * FROM owned_achievements WHERE user_id='{$_USER['id']}'") or die(mysqli_error($connect));

if (!isset($_GET['id'])) {
    die("<script>document.location = \"/user.aspx?id={$_USER['id']}\"</script>");
}
$id = intval($_GET['id']);


$userq = mysqli_query($link, "SELECT * FROM users WHERE id='$id'") or die(mysqli_error($link));

if (mysqli_num_rows($userq) < 1) {
  //User doesn't exist.
  die("<script>document.location = \"/Users/\"</script>");
}

$user = mysqli_fetch_assoc($userq);

$ippv = md5($_SERVER['REMOTE_ADDR']);

/*
  PLAYER STATS
*/
// $joindate = new DateTime($user['time_joined']);
$joindate = "1";
$joindate = date("d/m/Y",$joindate);

$onlinetext = ($user['expiretime'] < $now) ? "<span class=\"UserOfflineMessage\">[ Offline ]</span>" : "<span class=\"UserOnlineMessage\">[ Online: Website ]</span>";


                    $resultsperpage = 3;
                    $check = mysqli_query($link, "SELECT * FROM users");
                    $usercount = mysqli_num_rows($check);

                    $numberofpages = ceil($usercount/$resultsperpage);

                    if(!isset($_GET['page'])) {
                        $page = 1;
                    }else{
                        $page = $_GET['page'];
                    }

                    $thispagefirstresult = ($page-1)*$resultsperpage;

$friendq = mysqli_query($link, "SELECT * FROM friends WHERE (`user_from` = {$user['id']} AND `arefriends`='1') OR  (`user_to` = {$user['id']} AND `arefriends`='1') LIMIT ".$thispagefirstresult.",".$resultsperpage) or die(mysqli_error($link));

$friendnew = mysqli_query($link, "SELECT * FROM friends WHERE (`user_from` = {$user['id']} AND `arefriends`='1') OR  (`user_to` = {$user['id']} AND `arefriends`='1')") or die(mysqli_error($link));

$friendcount = mysqli_num_rows($friendnew);

$arefriends = false;

if ($isloggedin) {
  if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM friends WHERE user_to='{$_USER['id']}' AND user_from='{$user['id']}' AND arefriends='1'")) > 0) {
    $arefriends = true;
  }
  if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM friends WHERE user_to='{$user['id']}' AND user_from='{$_USER['id']}' AND arefriends='1'")) > 0) {
    $arefriends = true;
  }
}
if ($user['is_banned'] == 1) {
    header("Location: /error/");
}

/*
<div class="column is-one-third">
  <div class="box">
    <img src="https://via.placeholder.com/150"><br>
    <center><span style="font-size: 12px;">Crew Member</span></center>
  </div>
</div>
*/
?>
<div id="Body">
<div id="FriendsContainer">
	<div id="Friend">
		<style>
		body {
    font: normal 8pt/normal 'Comic Sans MS',Verdana,sans-serif;
    margin-top: 0;
    text-transform: none;
    text-decoration: none;
}
		h4 {
    font-size: 10pt;
    font-weight: bold;
    line-height: 1em;
    margin-bottom: 5px;
    margin-top: 5px;
}
</style>
				<h4>Username's friends (0)</h4>
		<div align="center">
		    							</div>
		<table cellspacing="0" border="0" align="Center">
			<tbody>
				<tr>
<td><div class="Friend">
<div class="Avatar">
<a title="Username" href="/user/?id=1" style="display:inline-block;max-height:100px;max-width:100px;cursor:pointer;">
<img height="100" width="100" src="http://nounblx.cf/api/avatar/getthumb.php?id=62">
</a>
</div>
<div class="Summary">
<span class="OnlineStatus">
<img src="/images/OnlineStatusIndicator_IsOffline.gif" alt="Username" style="border-width:0px;"></span>
<span class="Name"><a href="/user/?id=0">Username</a></span>
</div>
</div></td></tr>															                                        </div>
															                                    </div></td></tr><tr>																			                			    </tr>
			</tbody>
		</table>
	</div>
</div>
<? include("../core/footer.php"); ?>