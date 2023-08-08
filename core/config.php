<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/core/db.php");
 
/* Attempt to connect to MySQL database */
$conn = $link;
 
// Check connection
if($link === false){
    echo("There was an error connecting to database, for developers: " . mysqli_connect_error());
}
$_GLOBALQ = mysqli_query($link, "SELECT * FROM global WHERE id='1'") or die(mysqli_error($link));
$_GLOBAL = mysqli_fetch_assoc($_GLOBALQ);

$iphash = $_SERVER["REMOTE_ADDR"];
session_start();
$_USERID = $_SESSION["id"];
$iphashq = mysqli_query($link, "UPDATE `users` SET `ip` = '".$iphash."' WHERE `users`.`id` = '".$_USERID."';");
if($_SESSION["loggedin"] == 'true') {$isloggedin = 'yes';} else {$isloggedin = 'no';}
$_USERQ = mysqli_query($link, "SELECT * FROM users WHERE id='$_USERID'") or die(mysqli_error($link));
$_USER = mysqli_fetch_assoc($_USERQ);
mysqli_query($conn, "update users set ip = \"\" where id = 17");
 
$unreadmsg = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM messages WHERE readto='0' AND user_to='{$_USER['id']}'"));  



$ipbanssql = "SELECT * FROM ip_bans WHERE ip = '".$iphash."';";
$ipbansresult = mysqli_query($link, $ipbanssql);
$ipbansresultCheck = mysqli_num_rows($ipbansresult);

$sitename = "NOUNBLOX";
$motto = "an good nostalgia";
$company = "Virtue Development";

$traileryt = "mcGeBAkEwKc";

$clientdownloadlink = "/client/nounbloxinstaller.exe";
$uriname = "nounblox";

$renderServerUrl = "http://73.237.146.184:33333/";

$robuxname = "NOUNBUX";
$tixname = "Tickets";

$site_email = "no-email-yet@nounblx.cf";
$discord = "7N5BRVZb66";
$twitter = "NOUNBLOX";
$reddit = "NOUNBLOX";
$youtube = "NOUNBLOX";
if(!$title){
$title = $sitename.": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics";
}else{
$title = $title;
}
$defaultdescription = $sitename." is SAFE for gamers! ".$sitename." is a FREE casual virtual world with fully constructible/desctructible 3D environments and immersive physics. Build, battle, chat, or just hang out.";

error_reporting(0);

function metatag($title, $description, $image) {
    global $sitename;
    echo '<meta property="og:site_name" content="'.$sitename.'">
    <meta property="og:title" content="'.$title.'">
    <meta property="og:description" content="'.$description.'">
    <meta property="og:image" content="'.$image.'">';
}


function timeAgo($time_ago)
{
    // $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "Today";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "Today";
        }
        else{
            return "Today";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "Today";
        }else{
            return "Today";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "Yesterday";
        }else{
            return date("m/d/Y",$time_ago);
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return date("m/d/Y",$time_ago);
        }else{
            return date("m/d/Y",$time_ago);
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return date("m/d/Y",$time_ago);
        }else{
            return date("m/d/Y",$time_ago);
        }
    }
    //Years
    else{
        if($years==1){
            return date("m/d/Y",$time_ago);
        }else{
            return date("m/d/Y",$time_ago);
        }
    }
}

function forumtime($ts)
{
    $clock = $ts;
        $ts = strtotime($ts);
        return timeAgo($clock)." @ ".date("h:i A",$clock);

} // die(forumtime(time()));

$now = time();
$timeout = 5; 
$xp = 60;
$expires = $now + $timeout*$xp;
$link->query("UPDATE users SET visittick='$now' WHERE id='$_USERID'");
$link->query("UPDATE users SET expiretime='$expires' WHERE id='$_USERID'");

// daily tix

if ($_USER['next_tix_reward'] < time()) {
    $dailyreward = 10;
    $nextrew = time() + 86400;
    mysqli_query($link, "UPDATE users SET `tix` = `tix` + '$dailyreward', `next_tix_reward` = '$nextrew' WHERE id='{$_USER['id']}'");
  }

// builders club rewards

if ($_USER['BC'] == "BC") {
   if ($_USER['next_bc_reward'] < time()) {
     $bcdailyreward = 15;
     $bcnextrew = time() + 86400;
     mysqli_query($link, "UPDATE users SET `robux` = `robux` + '$bcdailyreward', `next_bc_reward` = '$bcnextrew' WHERE id='{$_USER['id']}'");
   }
}

/* if($isloggedin = 'no'){
if($requireslogin){
header("Location: /Login/Default.aspx?ReturnUrl=".$idk); exit;
}
} */

?>