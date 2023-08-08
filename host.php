<?php
include($_SERVER["DOCUMENT_ROOT"]."/core/header.php");
include($_SERVER["DOCUMENT_ROOT"]."/core/nav.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/core/config.php");
$id = $_GET["id"];
$gameq = mysqli_query($link, "SELECT * FROM games WHERE id='".$id."'") or die(mysqli_error($link));
$game = mysqli_fetch_assoc($gameq);
$creatorq = mysqli_query($link, "SELECT * FROM users WHERE id='".$game['creator_id']."'") or die(mysqli_error($link));
$creator = mysqli_fetch_assoc($creatorq);
if($creator['id'] !== $_USER['id']) {
    die("<h1>You do not own this place.</h1>");
    exit;
}

if(!isset($_POST["maplocation"])) { ?>
    <h1>Hello fellow user! You now need to put the map location:</h1>
    <p>Set the map location folder to like C:\mlgbloxmaps\</p>
    <p style="color: red;">IF ITS LIKE C:\mlgbloxmaps THEN ADD \ AT THE END<br>IF ITS C:/mlgbloxmaps THEN ADD / AT THE END</p>
    <p>And set the map name to like barbecue.rbxl</p>
    <p>Don't worry, this is a safe form. The client will be looking on your PC, not the site.</p>
    <form action="" method="POST">
        <input type="text" name="maplocationfolder" placeholder="C:\mlgbloxmaps\" value="<?php echo $_USER["defaultmaplocationfolder"]; ?>"><br>
        <input type="text" name="maplocation" placeholder="barbecue.rbxl" value="<?php echo $game["defaultmapfilename"]; ?>"><br>
        <input type="submit" name="submit" value="Submit">
    </form>
<?php
    die();
} else {
    $mapfilename = addslashes($_POST["maplocation"]);
    $maplocationfolder = addslashes($_POST["maplocationfolder"]);
    $maplocation = $maplocationfolder.$mapfilename;
    mysqli_query($link, "UPDATE users SET defaultmaplocationfolder = '$maplocationfolder' WHERE id = '".$_USER['id']."'");
    mysqli_query($link, "UPDATE games SET defaultmapfilename = '$mapfilename' WHERE id = '".$game['id']."'");
    $contains = ' ';
    if (strpos($maplocation, $contains) !== false) {
        $maplocation = '"'.$maplocation.'"';
    }
}
$joinargs = $maplocation.' -script  "wait(); dofile(\'http://krnlblx.tk/client/2010/server.php?game='.$game['id'].'\') dofile(\'http://krnlblx.tk/client/2010/FixAssetLinks.php\')"';
$b64joinargs = base64_encode($joinargs);
header('location: kernelblox:'.$b64joinargs);
?>