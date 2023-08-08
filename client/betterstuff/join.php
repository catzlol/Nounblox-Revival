<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/config.php");
header("Content-Type: text/plain");
if(!empty($_GET['placeid']) AND !empty($_GET['accountcode']))
{
    // $ip = $_GET['ip'];
    // $port = $_GET['port'];
    $usrq = mysqli_query($link, "SELECT * FROM users WHERE accountcode='".$_GET['accountcode']."'") or die(mysqli_error($link));
$user = mysqli_fetch_assoc($usrq);
$gameq = mysqli_query($link, "SELECT * FROM games WHERE id='".$_GET['placeid']."'") or die(mysqli_error($link));
$game = mysqli_fetch_assoc($gameq);
mysqli_query($link, "INSERT INTO `gamesvisits` (`id`, `gameid`, `visitorid`) VALUES (NULL, '".$game['id']."', '".$user['id']."');") or die(mysqli_error($link));
$ip = $game['ip'];
$port = $game['port'];
$name = $user['username'];
$playerid = $user['id'];
$customerrorenabled = 'no';
$customerror = '';
if(!$user) {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: Invalid Account Code.';
}
if($user['bantype'] == 'Reminder') {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: Reminder on your account.';
    //header("Location: /", true, 403);
} elseif($user['bantype'] == 'Warning') {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: Warning on your account.';
    //header("Location: /", true, 403);
} elseif($user['bantype'] == 'Ban') {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: Account Banned.';
    //header("Location: /", true, 403);
}
if ($ipbansresultCheck > 0) {
    while ($ipbansrow = mysqli_fetch_assoc($ipbansresult)) {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: IP Banned.';
    //header("Location: /", true, 403);
}

}

?>
game:SetMessage("<?php if($customerrorenabled == 'yes') {echo $customerror;} ?>")
<?
    $data = ' 
-- functions --------------------------
function onPlayerAdded(player)
	-- override
end
-- arguments ---------------------------------------
local threadSleepTime = ...
if threadSleepTime==nil then
	threadSleepTime = 15
end
local test = true
print("! Joining place -1 at localhost")
game:GetService("ChangeHistoryService"):SetEnabled(false)
game:GetService("ContentProvider"):SetThreadPool(16)
game:GetService("InsertService"):SetBaseCategoryUrl("nounblx.cf/Game/Tools/InsertAsset.php?nsets=10&type=base")
game:GetService("InsertService"):SetUserCategoryUrl("nounblx.cf/Game/Tools/InsertAsset.php?nsets=20&type=user&userid=%d")
game:GetService("InsertService"):SetCollectionUrl("nounblx.cf/Game/Tools/InsertAsset.php?sid=%d")
game:GetService("InsertService"):SetAssetUrl("nounblx.cf/Asset/?id=%d")
game:GetService("InsertService"):SetAssetVersionUrl("nounblx.cf/Asset/?assetversionid=%d")
-- game:GetService("InsertService"):SetTrustLevel(0)
game:GetService("InsertService"):SetAdvancedResults(true)
-- Bubble chat.  This is all-encapsulated to allow us to turn it off with a config setting
pcall(function() game:GetService("Players"):SetChatStyle(Enum.ChatStyle.ClassicAndBubble) end)
local waitingForCharacter = false
pcall( function()
	if settings().Network.MtuOverride == 0 then
		settings().Network.MtuOverride = 1400
	end
end)
-- globals -----------------------------------------
client = game:GetService("NetworkClient")
visit = game:GetService("Visit")
-- functions ---------------------------------------
function setMessage(message)
	-- todo: animated "..."
	if not false then
		game:SetMessage(message)
	else
		-- hack, good enought for now
		game:SetMessage("Teleporting ...")
	end
end
function showErrorWindow(message)
	game:SetMessage(message)
end
function reportError(err)
	print("***ERROR*** " .. err)
	if not test then visit:SetUploadUrl("") end
	client:Disconnect()
	wait(4)
	showErrorWindow("Error: " .. err)
end
-- called when the client connection closes
function onDisconnection(peer, lostConnection)
	if lostConnection then
		showErrorWindow("You have lost the connection to the game")
	else
		showErrorWindow("This game has shut down")
	end
end
function requestCharacter(replicator)
	
	-- prepare code for when the Character appears
	local connection
	connection = player.Changed:connect(function (property)
		if property=="Character" then
			game:ClearMessage()
			waitingForCharacter = false
			
			connection:disconnect()
		end
	end)
	
	setMessage("Requesting character")
	local success, err = pcall(function()	
		replicator:RequestCharacter()
		setMessage("Waiting for character")
		waitingForCharacter = true
	end)
	if not success then
		reportError(err)
		return
	end
end
-- called when the client connection is established
function onConnectionAccepted(url, replicator)
	local waitingForMarker = true
	
	local success, err = pcall(function()	
		if not test then 
		    visit:SetPing("", 300) 
		end
		
		if not false then
			game:SetMessageBrickCount()
		else
			setMessage("Teleporting ...")
		end
		replicator.Disconnection:connect(onDisconnection)
		
		-- Wait for a marker to return before creating the Player
		local marker = replicator:SendMarker()
		
		marker.Received:connect(function()
			waitingForMarker = false
			requestCharacter(replicator)
		end)
	end)
	
	if not success then
		reportError(err)
		return
	end
	
	-- TODO: report marker progress
	
	while waitingForMarker do
		workspace:ZoomToExtents()
		wait(0.5)
	end
end
-- called when the client connection fails
function onConnectionFailed(_, error)
	showErrorWindow("Failed to connect to the Game. (ID=" .. error .. ")")
end
-- called when the client connection is rejected
function onConnectionRejected()
	connectionFailed:disconnect()
	showErrorWindow("This game is not available. Please try another")
end
idled = false
function onPlayerIdled(time)
	if time > 20*60 then
		showErrorWindow(string.format("You were disconnected for being idle %d minutes", time/60))
		client:Disconnect()	
		if not idled then
			idled = true
		end
	end
end
-- main ------------------------------------------------------------
pcall(function() settings().Diagnostics:LegacyScriptMode() end)
local success, err = pcall(function()	
	game:SetRemoteBuildMode(true)
	
	setMessage("Connecting to Server")
	client.ConnectionAccepted:connect(onConnectionAccepted)
	client.ConnectionRejected:connect(onConnectionRejected)
	connectionFailed = client.ConnectionFailed:connect(onConnectionFailed)
	client.Ticket = ""
	
	playerConnectSucces, player = pcall(function() return client:PlayerConnect('.$playerid.', "'.$ip.'", '.$port.', 0, threadSleepTime) end)
	if not playerConnectSucces then
		--Old player connection scheme
		player = game:GetService("Players"):CreateLocalPlayer('.$playerid.')
		client:Connect("'.$ip.'", '.$port.', 0, threadSleepTime)
	end
	player:SetSuperSafeChat(false)
	pcall(function() player:SetMembershipType(Enum.MembershipType.None) end)
	pcall(function() player:SetAccountAge(300) end)
	player.Idled:connect(onPlayerIdled)
	
	-- Overriden
	onPlayerAdded(player)
	
	pcall(function() player.Name = [========['.$name.']========] end)	
	if not test then visit:SetUploadUrl("") end
end)
if not success then
	reportError(err)
end
if not test then
	-- TODO: Async get?
	loadfile("")("", -1, 0)
end
pcall(function() game:SetScreenshotInfo("") end)
pcall(function() game:SetVideoInfo("") end)
-- use single quotes here because the video info string may have unescaped double quotes';

// exit
exit($data);
}