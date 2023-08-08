<?php header('Content-Type:text/plain');
require_once($_SERVER["DOCUMENT_ROOT"]."/core/config.php");
$fuckingAccountCodeFuckYouCarly = $_GET['accountcode'];
$usrq = mysqli_query($link, "SELECT * FROM users WHERE accountcode='".$_GET['accountcode']."'") or die(mysqli_error($link));
$user = mysqli_fetch_assoc($usrq);
$gameq = mysqli_query($link, "SELECT * FROM games WHERE id='".$_GET['placeid']."'") or die(mysqli_error($link));
$game = mysqli_fetch_assoc($gameq);

$ip = $game['ip'];
$port = $game['port'];
$username = $user['username'];
$userid = $user['id'];
$customerrorenabled = 'no';
$customerror = '';
if(empty($fuckingAccountCodeFuckYouCarly)){
    $ip = '0.0.0.0';
    // $port = "0";
    $username = "";
    // $userid = "";
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: Invalid Account Code.';
    // echo 'game:SetMessage("'.$customerror.'")'; die();
    //header("Location: /", true, 403);
}
if(!$user) {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: Invalid Account Code.';
}
if($user['bantype'] == 'Reminder') {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'You have a moderaton notice on your account.';
    //header("Location: /", true, 403);
} elseif($user['bantype'] == 'Warning') {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'You have a moderaton notice on your account.';
    //header("Location: /", true, 403);
} elseif($user['bantype'] == 'Ban') {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'You have a moderaton notice on your account.';
    //header("Location: /", true, 403);
}
if ($ipbansresultCheck > 0) {
    while ($ipbansrow = mysqli_fetch_assoc($ipbansresult)) {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: Your network has been blocked.';
    //header("Location: /", true, 403);
}
if(empty($customerror)){
mysqli_query($link, "INSERT INTO `gamesvisits` (`id`, `gameid`, `visitorid`) VALUES (NULL, '".$game['id']."', '".$user['id']."');") or die(mysqli_error($link));
}

}
?>
local server = "<?php echo $ip; ?>" 
local serverport = <?php echo $port; ?> 
local clientport = 0 
local playername = "<?php echo $username; ?>" 
game:SetMessage("<?php if($customerrorenabled == 'yes') {echo $customerror;} ?>") 
function dieerror(errmsg) 
game:SetMessage(errmsg) 
wait(math.huge) 
end 
local suc, err = pcall(function() 
client = game:GetService("NetworkClient") 
local player = game:GetService("Players"):CreateLocalPlayer(<?=$userid;?>) 
player:SetSuperSafeChat(false) 
pcall(function() game:GetService("Players"):SetChatStyle(Enum.ChatStyle.ClassicAndBubble) end) 
game:GetService("Visit") 
player.Name = playername
player.userId = <?=$userid;?>

game:ClearMessage() 
end) 
if not suc then 
dieerror(err) 
end 
function connected(url, replicator) 
local suc, err = pcall(function() 
local marker = replicator:SendMarker() 
end) 
if not suc then 
dieerror(err) 
end 
marker.Recieved:wait() 
local suc, err = pcall(function() 
game:ClearMessage() 
end) 
if not suc then 
dieerror(err) 
end 
end 
function rejected() 
dieerror("<?php if($customerrorenabled == 'yes') {echo $customerror;} else {echo 'Connection failed: Rejected by server.';} ?>") 
end 
function failed(peer, errcode, why) 
dieerror("<?php if($customerrorenabled == 'yes') {echo $customerror.'"';} else {echo 'Failed [".. peer.. "], ".. errcode.. ": ".. why';} ?>) 
end 
local suc, err = pcall(function() 
client.ConnectionAccepted:connect(connected) 
client.ConnectionRejected:connect(rejected) 
client.ConnectionFailed:connect(failed) 
client:Connect(server, serverport, clientport, 20) 
local funeeplayr = game.Players:FindFirstChild("<?php echo $username; ?>") 
funeeplayr.CharacterAppearance = "http://<?=$_SERVER['HTTP_HOST'];?>/api/charapp.php?id=<?php echo $userid; ?>" 
dofile('http://<?=$_SERVER['HTTP_HOST'];?>/client/2010/FixAssetLinks.php') 
end) 
if not suc then 
local x = Instance.new("Message") 
x.Text = err 
x.Parent = workspace 
wait(math.huge) 
end 
while true do 
wait(0.001) 
replicator:SendMarker() 
end 
