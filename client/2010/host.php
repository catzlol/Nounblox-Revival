<?php header('Content-Type:text/plain'); ?>
Port = <?php if(isset($_GET['port'])) {echo (int)$_GET['port'];} else {echo 53640;} ?> 
Server =  game:GetService("NetworkServer") 
HostService = game:GetService("RunService")Server:Start(Port,20) 

-- death commands
function trackchat(player)
    local wordlist = {";ec", "!!!reset"}
    player.Chatted:connect(function(msg)
        for index = 1, #wordlist do
            if string.lower(msg) == wordlist[index] then
                player.Character:breakJoints()  
            end
        end
    end)
end

game:GetService("RunService"):Run() 
print("Server started!") 
dofile('http://<?=$_SERVER['HTTP_HOST'];?>/client/2010/FixAssetLinks.php')
game:Load('http://<?=$_SERVER['HTTP_HOST'];?>/client/2010/creditstomuggy.rbxm')
game:FindFirstChild("Health-GUI").Parent = game.StarterGui
function onJoined(NewPlayer) 
trackchat(NewPlayer)
print("New player found: "..NewPlayer.Name.."") 
dofile('http://<?=$_SERVER['HTTP_HOST'];?>/client/2010/addplayer.php')
NewPlayer:LoadCharacter(true) 
while wait() do 
if NewPlayer.Character.Humanoid.Health == 0 then 
wait(5) 
NewPlayer:LoadCharacter(true)
elseif NewPlayer.Character.Parent  == nil then 
wait(5) 
NewPlayer:LoadCharacter(true) 
end 
end 
end 
game.Players.PlayerAdded:connect(onJoined) 
