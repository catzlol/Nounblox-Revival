<?php require_once $_SERVER["DOCUMENT_ROOT"].'/core/config.php';

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

game:Load('rbxasset://test2.rbxl')

local parts = game.Workspace:GetChildren()
local materials = {}

function changeToSmoothPlastic()
	for index, instance in next, parts do
		local yes,errorr = pcall(function()
			if instance:IsA(\"MeshPart\") or instance:IsA(\"BasePart\") or instance:IsA(\"Part\") then
				table.insert(materials,{part = instance, material = instance.Material})
				instance.Material = Enum.Material.SmoothPlastic
			end
		end)
	end
end

-- To make everything smooth plastic
changeToSmoothPlastic()

print(\"User ".$id." has been rendered\")
							
return game:GetService(\"ThumbnailGenerator\"):Click(\"PNG\", 2160, 2160, false)
				              </ns1:script>
            </ns1:script>
        </ns1:OpenJob>
    </SOAP-ENV:Body>
</SOAP-ENV:Envelope>";


//The URL that you want to send your XML to.
$url = "http://24.176.90.134:33333/";

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

header('Content-Type: image/png');

// $updatethumb = mysqli_query($link, "UPDATE users SET thumb = '".$yeah."' WHERE id='".$id."'") or die(mysqli_error($link));

// die("<img src='data:image/png;base64, ".$yeah."'>");



imagepng($im);
imagedestroy($im);

?>
