<?php
header("Content-type: text/plain");
include "../core/config.php";

if (!$isloggedin) {
  die("You are not logged in!");
}


$user_from = $_USER['id'];
$user_to = intval($_GET['id']);

if ($user_to < 1) {
  die ("Invalid ID.");
}

$_1 = mysqli_num_rows(mysqli_query($link, "SELECT * FROM friends WHERE user_from='$user_from' AND user_to='$user_to'"));
$_2 = mysqli_num_rows(mysqli_query($link, "SELECT * FROM friends WHERE user_from='$user_to' AND user_to='$user_from'"));
$_3 = mysqli_num_rows(mysqli_query($link, "SELECT * FROM friends WHERE user_from='$user_to' AND user_to='$user_from' AND arefriends='1'"));
$_4 = mysqli_num_rows(mysqli_query($link, "SELECT * FROM friends WHERE user_from='$user_from' AND user_to='$user_to' AND arefriends='1'"));

//die($_1." ".$_2." ".$_3." ".$_4);
if (($_1 != 0) || ($_3 != 0) || ($_4 != 0) || ($user_to == $user_from)) {
  //Friend request already sent or users are already friends: Go back to user page.
  //die("1");
  header("Location: /User.aspx?ID=".$user_to);

} else if ($_2 != 0) {
  //Other user already sent friend request: Accept request.
  //die("2");
  $arefriends = 1;
  $hash = md5($user_from.$user_to.$arefriends);
  $datum = new DateTime();
  $startTime = $datum->format('Y-m-d H:i:s');
  $query = mysqli_query($link, "UPDATE friends SET arefriends='1', hash='$hash', date=CURRENT_TIMESTAMP WHERE user_from='$user_to' AND user_to='$user_from'") or die(mysqli_query($link));
  //SendAutomatedMessageToId("Friend request accepted", $_USER['username'] . " has accepted your friend request.", $user_to);
  //header("Location: /user.aspx?id=".$user_to);
} else {
  //All checks completed
  //die("3");

  if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM users WHERE id='$user_to'")) == 0) {
    die("Invalid ID.");
  }
  $arefriends = 0;
  $hash = md5($user_from.$user_to.$arefriends);
  $query = mysqli_query($link, "INSERT INTO  `friends` (
`id` ,
`user_from` ,
`user_to` ,
`arefriends` ,
`hash`
)
VALUES (
NULL ,  '$user_from',  '$user_to',  '0',  '$hash'
);") or die(mysqli_error($link));
//SendAutomatedMessageToId("Friend request from {$_USER['username']}", $_USER['username'] . " has sent you a friend request.<br><a href=\"/api/AddFriend?id=$user_from\">Accept friend request</a>", $user_to);
}

if ($_GET['from_rq_page']) {
  header("Location: /my/home.aspx");
} else {
  header("Location: /User.aspx?ID=".$user_to);
}

// header("Location: " . $_SERVER["HTTP_REFERER"]);
?>