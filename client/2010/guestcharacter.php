<?php
$guestnum = $_GET["guestnum"];
if(!$guestnum) {die();}
require_once($_SERVER["DOCUMENT_ROOT"]."/core/config.php");
$gameq = mysqli_query($link, "SELECT * FROM games WHERE id='".$_GET['placeid']."'") or die(mysqli_error($link));
$game = mysqli_fetch_assoc($gameq);
?>
local hasLoaded = false 
function character() 
local player = game.Workspace:FindFirstChild("Guest <?php echo $guestnum; ?>") 
if player~=nil and hasLoaded == false then 
wait(1) 
player.Head.BrickColor = BrickColor.new("Institutional white") 
player.Torso.BrickColor = BrickColor.new("Dark stone grey") 
player["Right Leg"].BrickColor = BrickColor.new("Really black") 
player["Right Arm"].BrickColor = BrickColor.new("Really black") 
player["Left Leg"].BrickColor = BrickColor.new("Really black") 
player["Left Arm"].BrickColor = BrickColor.new("Really black") 
local Shirt = Instance.new("Shirt", player) 
Shirt.ShirtTemplate = "rbxasset://shirt//.png" 
local Pants = Instance.new("Pants", player) 
Pants.PantsTemplate = "rbxasset://pantss//.png" 
local TShirt = Instance.new("Decal") 
TShirt.Parent = player.Torso 
TShirt.Texture = "rbxasset://Tshirts//.png" 
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
