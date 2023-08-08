<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/config.php");
$usrq = mysqli_query($link, "SELECT * FROM users WHERE accountcode='".$_GET['accountcode']."'") or die(mysqli_error($link));
$user = mysqli_fetch_assoc($usrq);
$gameq = mysqli_query($link, "SELECT * FROM games WHERE id='".$_GET['placeid']."'") or die(mysqli_error($link));
$game = mysqli_fetch_assoc($gameq);
?>
local hasLoaded = false
function character()
local player = game.Workspace:FindFirstChild("<?php echo $user['username']; ?>")
if player~=nil and hasLoaded == false then
wait(1)
player.Head.BrickColor = BrickColor.new("<?php echo $user['HeadColor']; ?>")
player.Torso.BrickColor = BrickColor.new("<?php echo $user['TorsoColor']; ?>")
player["Right Leg"].BrickColor = BrickColor.new("<?php echo $user['RightLegColor']; ?>")
player["Right Arm"].BrickColor = BrickColor.new("<?php echo $user['RightArmColor']; ?>")
player["Left Leg"].BrickColor = BrickColor.new("<?php echo $user['LeftLegColor']; ?>")
player["Left Arm"].BrickColor = BrickColor.new("<?php echo $user['LeftArmColor']; ?>")
player.Humanoid.Died:connect(function()
   if hasLoaded == true then
       wait(5)
       hasLoaded = false
   end
end)
hasLoaded = true
end
end
workspace.ChildAdded:connect(character) 