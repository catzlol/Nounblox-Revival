<?php require_once $_SERVER["DOCUMENT_ROOT"].'/core/config.php';
if($isloggedin !== "yes") {
	header('location: /');
}

if($_USERID == "32"){
die("Error rendering."); // temporary thing until i add some render blacklist
}

if($_USERID == "0"){
die("Error rendering."); // temporary thing until i add some render blacklist
}

$id = (int)$_USERID;

$userq = mysqli_query($link, "SELECT * FROM users WHERE id='".$id."'") or die(mysqli_error($link));

$user = mysqli_fetch_assoc($userq);


$torsoColor = "";
$rightLegColor = "";
$leftLegColor = "";
$rightArmColor = "";
$leftArmColor = "";
$headColor = "";
$tShirt = "";
$pants = "";
$shirt = "";
$face = "";

$face = '"rbxasset://textures/face.png"';
$shirt = '""';
$pants = '""';
$tShirt = '""';
$headColor = '"'.$user['HeadColor'].'"';
$leftArmColor = '"'.$user['LeftArmColor'].'"';
$rightArmColor = '"'.$user['RightArmColor'].'"';
$leftLegColor = '"'.$user['LeftLegColor'].'"';
$rightLegColor = '"'.$user['RightLegColor'].'"';
$torsoColor = '"'.$user['TorsoColor'].'"';

$test = $_GET["shirt"];

$test = '""';

if ($test == '""') {
	$studs = "rbxasset://studs.png";
}
else {
	$studs = "";
}



if($user["pose"] == "Sitting"){
$posescript = 'player.Character.Torso["Right Shoulder"].CurrentAngle = math.rad(90)
player.Character.Torso["Left Shoulder"].CurrentAngle = math.rad(-90)
player.Character.Torso["Right Hip"].CurrentAngle = math.rad(90)
player.Character.Torso["Left Hip"].CurrentAngle = math.rad(-90)
';
}

if($user["pose"] == "Walking"){
$posescript = 'player.Character.Torso["Right Shoulder"].CurrentAngle = math.rad(-20)
player.Character.Torso["Left Shoulder"].CurrentAngle = math.rad(-20)
player.Character.Torso["Right Hip"].CurrentAngle = math.rad(17)
player.Character.Torso["Left Hip"].CurrentAngle = math.rad(17)
';
}

if($user["pose"] == "Overlord"){
$posescript = "player.Character.Torso['Left Shoulder'].C0=CFrame.new(-1, 0.5, 0, -4.37113883e-08, 0, -1, 0, 0.99999994, 0, 1, 0, -4.37113883e-08);
player.Character.Torso['Left Shoulder'].C1=CFrame.new(0.49999997, 0.49999997, 4.47034836e-08, 0.163175777, -0.229498923, -0.959533036, -0.33284384, 0.90274477, -0.272519022, 0.928756475, 0.363843203, 0.0709187835);
player.Character.Torso['Right Shoulder'].C0=CFrame.new(1, 0.5, 0, -4.37113883e-08, 0, 1, -0, 0.99999994, 0, -1, 0, -4.37113883e-08);
player.Character.Torso['Right Shoulder'].C1=CFrame.new(-0.5, 0.5, 0, 0.163175479, 0.229498848, 0.959533155, 0.332843512, 0.902745068, -0.272518843, -0.928756654, 0.363842756, 0.0709186569);
";
}

//The XML string that you want to send.

$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:SOAP-ENC=\"http://schemas.xmlsoap.org/soap/encoding/\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:ns2=\"http://roblox.com/RCCServiceSoap\" xmlns:ns1=\"http://roblox.com/\" xmlns:ns3=\"http://roblox.com/RCCServiceSoap12\">
    <SOAP-ENV:Body>
        <ns1:OpenJob>
            <ns1:job>
                <ns1:id>3</ns1:id>
                <ns1:expirationInSeconds>1</ns1:expirationInSeconds>
                <ns1:category>1</ns1:category>
                <ns1:cores>321</ns1:cores>
            </ns1:job>
            <ns1:script>
                <ns1:name>Script</ns1:name>
                <ns1:script>
							-- print($face)
							player = game:GetService(\"Players\"):CreateLocalPlayer(0)
							player:LoadCharacter(0)
							player.Character.Head.face.Texture = $face
							studs = Instance.new(\"Shirt\", player.Character)
							studs.ShirtTemplate = \"$studs\"
							shirt = Instance.new(\"Shirt\", player.Character)
							shirt.ShirtTemplate = $shirt
							tShirt = Instance.new(\"ShirtGraphic\", player.Character)
							tShirt.Graphic = $tShirt
							pants = Instance.new(\"Pants\", player.Character)
							pants.PantsTemplate = $pants
							bodyColors = Instance.new(\"BodyColors\", player.Character)
							-- print($headColor)
							bodyColors.HeadColor = BrickColor.new($headColor)
							bodyColors.LeftArmColor = BrickColor.new($leftArmColor)
							bodyColors.RightArmColor = BrickColor.new($rightArmColor)
							bodyColors.LeftLegColor = BrickColor.new($leftLegColor)
							bodyColors.RightLegColor = BrickColor.new($rightLegColor)
							bodyColors.TorsoColor = BrickColor.new($torsoColor)
							-- print($torsoColor)
                                                        
local char = player.Character or player.CharacterAdded:Wait()

".$posescript."

local all = char:GetChildren()
for i,v in pairs(all) do
if v:IsA(\"BasePart\") then
v.Material = \"SmoothPlastic\"
end
end
                                                        print(\"User ".$id." has been rendered\")
							return game:GetService(\"ThumbnailGenerator\"):Click(\"PNG\", 2160, 2160, true)
				</ns1:script>
            </ns1:script>
        </ns1:OpenJob>
    </SOAP-ENV:Body>
</SOAP-ENV:Envelope>";


//The URL that you want to send your XML to.
$url = $renderServerUrl;

//Initiate cURL
$curl = curl_init($url);

//Set the Content-Type to text/xml.
curl_setopt ($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));

//Set CURLOPT_POST to true to send a POST request.
curl_setopt($curl, CURLOPT_POST, true);

//Attach the XML string to the body of our request.
curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);

//Tell cURL that we want the response to be returned as
//a string instead of being dumped to the output.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//Execute the POST request and send our XML.
$result = curl_exec($curl);

//Do some basic error checking.
if(curl_errno($curl)){
    throw new Exception(curl_error($curl));
}

//Close the cURL handle.
curl_close($curl);

$funnybase  = $result;
$luashit = array('LUA_TTABLE', "LUA_TSTRING");

$data = str_replace($luashit, "", $funnybase);

//echo $data;
$almost = strstr($data, '<ns1:value>');
$luashit = array('<ns1:value>', "</ns1:value></ns1:OpenJobResult><ns1:OpenJobResult><ns1:type></ns1:type><ns1:table></ns1:table></ns1:OpenJobResult></ns1:OpenJobResponse></SOAP-ENV:Body></SOAP-ENV:Envelope>");

$yeah = str_replace($luashit, "", $almost);
//echo $yeah;

$decoded = base64_decode($yeah);
file_put_contents("yeah.png",$decoded);

$im = imagecreatefrompng("yeah.png");

// header('Content-Type: image/png');

$updatethumb = mysqli_query($link, "UPDATE users SET thumb = '".$yeah."' WHERE id='".$id."'") or die(mysqli_error($link));

// die("<img src='data:image/png;base64, ".$yeah."'>");


if(isset($_GET['returnUrl'])) {
	$previous = $_GET["returnUrl"];
} else {
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}else{
		$previous = "/api/avatar/getthumb.php?id=".$id;
	}
}

header("Location: " . $previous); die(); exit;

//imagepng($im);
//imagedestroy($im);

?>
