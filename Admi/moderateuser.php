<?php
session_start();
include("./includes/prestart.php");
include("../includes/sqldbcon.php");
if(!is_numeric($_REQUEST['user']))
{
	header("Location: ../Error.php?id=418");
	die();
}
$user = getUserDetailsAsObjHD($_REQUEST['user']);
if($user === null)
{
	header("Location: ../Error.php?id=418");
	die();
}
$bantype = "reminder";
$assetimg = "../profile/~default/unavail.png";
$reason = "";
$bantype = "reminder";
$error = "";
if(isset($_REQUEST['submit']))
{
	$userid = $_REQUEST['user'];
	$reason = $_REQUEST['reason'];
	$bantype = $_REQUEST['type'];
	if(empty(trim($_REQUEST['reason'])))
	{
		$error = "You must have a valid reason to moderate someone.<br>";
	}
	else
	{
		$go = true;
		if(file_exists($_FILES['uploadFile']['tmp_name']) || is_uploaded_file($_FILES['uploadFile']['tmp_name']))
		{
			list($width, $height, $type, $attr) = getimagesize($_FILES["uploadFile"]['tmp_name']);
			if($width > 1000 || $height > 1000)
			{
				print "File width or height must be smaller than 1000";
				$go = false;
			}
			else if(exif_imagetype($_FILES['uploadFile']['tmp_name']) !== IMAGETYPE_PNG)
			{
				print "File must type PNG";
				$go = false;
			}
			else
			{
				move_uploaded_file($_FILES['uploadFile'] ['tmp_name'], "../webimg/banimg/" . $_REQUEST['user'] . ".png");
				$asset->baninfo->image = "../webimg/banimg/" . $_REQUEST['user'] . ".png";
			}
		}
		else
		{
			if(file_exists("../webimg/banimg/" . $_REQUEST['user'] . ".png"))
				unlink("../webimg/banimg/" . $_REQUEST['user'] . ".png");
		}
		if($go)
		{
			$timereported = time();
			$timeexpires = NULL;
			$sql = "DELETE FROM bans WHERE UserId = " . $_REQUEST['user'];
			if(!$result = $GLOBALS['db']->query($sql)){
				$error = "There was an error when deleting the record: " . $GLOBALS['db']->error . "<br>";
			}
			$userip = $user['UserIPHash'];
			if($bantype === 'reminder')
			{
				$timeexpires = time();
			}
			else if($bantype === 'warning')
			{
				$timeexpires = time();
				setModLog($_REQUEST['user'], $_SESSION['id'], "Account Moderation", "Warning:<br>" . htmlspecialchars($reason, ENT_QUOTES));
			}
			else if($bantype === '1day')
			{
				$timeexpires = time() + 24 * 60 * 60;
				setModLog($_REQUEST['user'], $_SESSION['id'], "Account Moderation", "One Day:<br>" . htmlspecialchars($reason, ENT_QUOTES));
			}
			else if($bantype === '3day')
			{
				$timeexpires = time() + 3 * 24 * 60 * 60;
				setModLog($_REQUEST['user'], $_SESSION['id'], "Account Moderation", "Three Day:<br>" . htmlspecialchars($reason, ENT_QUOTES));
			}
			else if($bantype === '7day')
			{
				$timeexpires = time() + 7 * 24 * 60 * 60;
				setModLog($_REQUEST['user'], $_SESSION['id'], "Account Moderation", "Seven Day:<br>" . htmlspecialchars($reason, ENT_QUOTES));
			}
			else if($bantype === '14day')
			{
				$timeexpires = time() + 14 * 24 * 60 * 60;
				setModLog($_REQUEST['user'], $_SESSION['id'], "Account Moderation", "Fourteen Day:<br>" . htmlspecialchars($reason, ENT_QUOTES));
			}
			else if($bantype === 'delete')
				setModLog($_REQUEST['user'], $_SESSION['id'], "Account Moderation", "Account Deleted:<br>" . htmlspecialchars($reason, ENT_QUOTES));
			else if($bantype === 'ip')
				setModLog($_REQUEST['user'], $_SESSION['id'], "Account Moderation", "IP Ban:<br>" . htmlspecialchars($reason, ENT_QUOTES));
				
			if($timeexpires != NULL)
				$sql = "INSERT INTO bans VALUES('$userid', '$bantype', '".htmlspecialchars($reason, ENT_QUOTES)."', '".$_SESSION['id']."', '$timereported', '$timeexpires', '$userip')";
			else
				$sql = "INSERT INTO bans VALUES('$userid', '$bantype', '".htmlspecialchars($reason, ENT_QUOTES)."', '".$_SESSION['id']."', '$timereported', NULL, '$userip')";
			if(!$result = $GLOBALS['db']->query($sql)){
				$error .= "There was an error when banning the player: " . $GLOBALS['db']->error . " <br>";
			}
			else
			{
				$error = "Player has been banned.";
			}
		}
	}
}
else if(isset($_REQUEST["preview"]))
	{
		//move_uploaded_file ($_FILES['uploadFile'] ['tmp_name'], "./asset/" . $_REQUEST['asset'] . ".png");
		list($width, $height, $type, $attr) = getimagesize($_FILES["uploadFile"]['tmp_name']);
		$bantype = $_REQUEST['type'];
		$reason = $_REQUEST['reason'];
		if($width > 1000 || $height > 1000)
		{
			print "File width or height must be smaller than 1000";
		}
		else if(exif_imagetype($_FILES['uploadFile']['tmp_name']) !== IMAGETYPE_PNG)
		{
			print "File width must type PNG";
		}
		else
		{
			move_uploaded_file($_FILES['uploadFile'] ['tmp_name'], "../webimg/banimg/" . $_REQUEST['user'] . ".png");
			$assetimg = "../webimg/banimg/" . $_REQUEST['user'] . ".png";
		}
	}
?>

<html>
	<head>
	<link rel="stylesheet" type="text/css" href="topbar.css">
	<style>
	</style>
	</head>

	<body bgcolor="#DDDDDD" style="margin: 0px; padding: 0px; font-family: Verdana;">
		<div style="background-color:#EEEEEE; border-right: outset 2px #EEEEEE; width: 15%; height: 100%; padding-left: 5px; padding-top: 5px; float: left;">
			<?php
				include("./includes/sidebar.php");
			?>
		</div>
		<div style="width: 84%; float: right;">
			<center>
			<br />
			<form method="post" enctype="multipart/form-data">
			<?php print $error; ?>
				<table border bgcolor="#EEEEEE" width="70%">
					<tr bgcolor="lightsteelblue" >
						<th colspan="2">
							Moderating user 
							<?php print $user['UserName']; ?>
							, ID: 
							<input type="text" readonly name="user" value="<?php print $_REQUEST['user']?>"/>
						</th>
					</tr>
						<tr>
						<td style='width: 50%;'>Description:<br>
						<textarea style="width: 100%" rows="8" name="reason"><?php print $reason;?></textarea><br>
						</td><th rowspan="2" width="50%"><img id="preview" src="<?php print $assetimg; ?>" /><br>
						<input id="select" type="file" name="uploadFile" <?php
						if(isset($_REQUEST['uploadFile']))
						print "value=" . $_REQUEST['uploadFile'];
						?>><input type="submit" name="preview" value="Preview"/></th>
					</tr>
					<tr>
						<th>
							<input type="radio" name="type" value="reminder" <?php if($bantype === "reminder") print "checked";?> />Reminder<br>
							<input type="radio" name="type" value="warning" <?php if($bantype === "warning") print "checked";?> />Warning<br>
							<input type="radio" name="type" value="1day" <?php if($bantype === "1day") print "checked";?> />1 Day Ban<br>
							<input type="radio" name="type" value="3day" <?php if($bantype === "3day") print "checked";?> />3 Day Ban<br>
							<input type="radio" name="type" value="7day" <?php if($bantype === "7day") print "checked";?> />7 Day Ban<br>
							<input type="radio" name="type" value="14day" <?php if($bantype === "14day") print "checked";?> />14 Day Ban<br>
							<input type="radio" name="type" value="delete" <?php if($bantype === "delete") print "checked";?> />Account Deleted<br>
							<input type="radio" name="type" value="ip" <?php if($bantype === "ip") print "checked";?> />Block IP<br>
							<font size="2" color="red">Block IP results in permanent account deletion and banning from site access.</font>
						</th>
					</tr>
					<tr>
						<th colspan="2"><input type="submit" value="Moderate" name="submit"/> <input type="submit" value="Cancel" name="cancel"/></th>
					</tr>
				</table>
				</form>
			</center>
		</div>
	</body>
</html>