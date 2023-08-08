<?php
include($_SERVER["DOCUMENT_ROOT"]."/core/header.php");
include($_SERVER["DOCUMENT_ROOT"]."/core/nav.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/core/config.php");
$id = (int)addslashes($_GET["id"]);
if($isloggedin !== 'yes') {header('location: /guestplay.aspx?id='.$id); die();}
$gameq = mysqli_query($link, "SELECT * FROM games WHERE id='".$id."'") or die(mysqli_error($link));
$game = mysqli_fetch_assoc($gameq);

function generateRandomString($length = 50) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$newaccountcode = addslashes(generateRandomString());
mysqli_query($link, "UPDATE `users` SET `accountcode` = '".$newaccountcode."' WHERE `users`.`id` = ".$_USER['id']."; ") or die(mysqli_error($link));

$joinargs = '-script "wait(); dofile(\'http://nounblx.cf/client/2010/character.php?placeid='.$game['id'].'&accountcode='.$newaccountcode.'\') dofile(\'http://nounblx.cf/client/2010/play.php?placeid='.$game['id'].'&accountcode='.$newaccountcode.'\')"';
$joinargs = base64_encode($joinargs);
header('location: nounblocks:'.$joinargs);
?>

<h1>How to play a game</h1>
<h3>Step 1: Radmin VPN</h3>
<a href="http://radmin-vpn.com/"><p>Download Radmin VPN here</p></a>
<p>Join the Radmin VPN network:</p>
<p>Name: DAYBLOX</p>
<p>Pass: lol123</p>
<h3>Step 2: Download <?=$sitename ?> Client</h3>
<a href="/download/<?=$sitename ?>-Client.zip"><p>Download <?=$sitename ?> here</p></a>
<h3>Step 3: Join the action!</h3>
<p>Go to your game, you clicked Play on <a href="/place.aspx?id=<?php echo $game['id']; ?>"><?php echo $game['name']; ?></a> before.</p>
<p>Then copy the PlaceId that you can find on the URL</p>
<img src="/images/gameid.png">
<p>Then open !Join.bat on the <?=$sitename ?> Client, paste the PlaceId and your Account Code</p>
<p><strong>Whats an Account Code?</strong> An Account Code is random characters linked to your <?=$sitename ?> account,</p>
<p>Your Account Code is: <?php echo $_USER['accountcode']; ?></p>
<p>Paste your Account Code into !Join.bat</p>
<h3>Step 4: Have fun!</h3>
<h2>Tutorial writen by nolanwhy</h2>
<?php include($_SERVER["DOCUMENT_ROOT"]."/core/footer.php"); ?>