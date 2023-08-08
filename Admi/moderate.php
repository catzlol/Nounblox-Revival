<?php
session_start();
$assetimg = "../asset/unavail.png";
$user = "";
$reason = "";
$bantype = "reminder";
if(!file_exists("../mods/" . $_SESSION['user_name'] . ".mod"))
{
	header("Location: http://androdome.com/ide/ojaosknjiudgyei3jkn");
}
else
{
	if(isset($_REQUEST['id']) && !isset($_REQUEST['accept']) && !isset($_REQUEST['delete']) && !isset($_REQUEST['preview']))
	{
		$user = $_REQUEST['id'];
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
			move_uploaded_file($_FILES['uploadFile'] ['tmp_name'], "./" . $_REQUEST['id'] . ".png");
			$assetimg = "./" . $_REQUEST['id'] . ".png";
			print "ok";
		}
	}
	else if(isset($_REQUEST['accept']))
	{
		$reason =  $_REQUEST['reason'];
		$bantype = $_REQUEST['type'];
		$asset->baninfo->modby = $_SESSION["user_name"];
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
				move_uploaded_file($_FILES['uploadFile'] ['tmp_name'], "./" . $_REQUEST['id'] . ".png");
				$asset->baninfo->image = "./" . $_REQUEST['id'] . ".png";
			}
		}
		else
		{
			if(file_exists("./" . $_REQUEST['id'] . ".png"))
				unlink("./" . $_REQUEST['id'] . ".png");
		}
		if($go)
		{
			$user = json_decode(file_get_contents("../passwd/" . $_REQUEST['id'] . ".json"));
			if(!array_key_exists("modhs", $user))
				$user->modhs = array();
			$asset->baninfo->time = time();
			$asset->baninfo->message = $reason;
			$dont = false;
			if($bantype === "blurb")
			{
				$_REQUEST['delblurb'] = true;
				$dont = true;
			}
			else if($bantype === "reminder")
			{
				$asset->baninfo->type = "Reminder";
				$asset->baninfo->endtime = time();
			}
			else if($bantype === "warning")
			{
				$asset->baninfo->type = "Warning";
				$asset->baninfo->endtime = time();
				$info->type = $asset->baninfo->type;
				$info->time = time();
				$info->rson = $reason;
				$info->mod = $_SESSION["user_name"];
				array_push($user->modhs, $info);
			}
			else if($bantype === "1day")
			{
				$asset->baninfo->type = "1 Day Ban";
				$asset->baninfo->endtime = time() + (1*24*60*60);
				$info->type = $asset->baninfo->type;
				$info->time = time();
				$info->rson = $reason;
				$info->mod = $_SESSION["user_name"];
				array_push($user->modhs, $info);
			}
			else if($bantype === "3day")
			{
				$asset->baninfo->type = "3 Day Ban";
				$asset->baninfo->endtime = time() + (3*24*60*60);
				$info->type = $asset->baninfo->type;
				$info->time = time();
				$info->rson = $reason;
				$info->mod = $_SESSION["user_name"];
				array_push($user->modhs, $info);
			}
			else if($bantype === "7day")
			{
				$asset->baninfo->type = "7 Day Ban";
				$asset->baninfo->endtime = time() + (7*24*60*60);
				$info->type = $asset->baninfo->type;
				$info->time = time();
				$info->rson = $reason;
				$info->mod = $_SESSION["user_name"];
				array_push($user->modhs, $info);
			}
			else if($bantype === "14day")
			{
				$asset->baninfo->type = "14 Day Ban";
				$asset->baninfo->endtime = time() + (14*24*60*60);
				$info->type = $asset->baninfo->type;
				$info->time = time();
				$info->rson = $reason;
				$info->mod = $_SESSION["user_name"];
				array_push($user->modhs, $info);
			}
			else if($bantype === "delete")
			{
				$asset->baninfo->type = "Account Deleted";
				$info->type = $asset->baninfo->type;
				$info->time = time();
				$info->rson = $reason;
				$info->mod = $_SESSION["user_name"];
				array_push($user->modhs, $info);
			}
			else if($bantype === "blockreg")
			{
				$asset->baninfo->type = "Account Deleted";
				$info->type = $asset->baninfo->type;
				$info->time = time();
				$info->rson = $reason;
				$info->mod = $_SESSION["user_name"];
				$asset->baninfo->noreg = "true";
				$user = json_decode(file_get_contents("../passwd/" . $_REQUEST['id'] . ".json"));
				file_put_contents("./ipban/".hash("sha512", $user->user->lastip), "");
				array_push($user->modhs, $info);
			}
			if(!$dont){
				file_put_contents("../passwd/" . $_REQUEST['id'] . ".json", json_encode($user));
				file_put_contents("./" . $_REQUEST['id'] . ".json", json_encode($asset, JSON_PRETTY_PRINT));
			}
			if(isset($_REQUEST['delblurb']))
			{
				$user = json_decode(file_get_contents("../passwd/" . $_REQUEST['id'] . ".json"));
				$user->profile->desc = "[ Content Deleted ] ";
				file_put_contents("../passwd/" . $_REQUEST['id'] . ".json", json_encode($user));
			}
			print "User moderated. <a href='http://androdome.com/ide/user?id=" . $_REQUEST['id'] . "'>Go to user page</a>";
		}
		
	}
	else if(isset($_REQUEST['delete']))
	{
		if(file_exists("./" . $_REQUEST['id'] . ".png"))
		{
			unlink("./" . $_REQUEST['id'] . ".png");
		}
		
	}
	else
	{
		print "Invalid Asset<br>";
	}
}
?>
<!DOCTYPE html>
<html>

	<head>
		<title>
			Moderate User
		</title>
		<script>
		</script>
	</head>
	<body>
		<center>
			<form method="post" action="<?php print $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
			<table width="500" border>
				<tr><th colspan="2">Moderating <input type="text" name="id" readonly value="<?PHP print $_REQUEST['id']; ?>"/></th></tr>
				<tr>
					<td>Description:<br>
					<textarea name="reason"><?php print $reason;?></textarea><br>
						<input type="checkbox" name="delblurb"/>Delete blurb
					</td><th rowspan="2"><img id="preview" src="<?php print $assetimg; ?>" /><br>
					<input id="select" type="file" name="uploadFile" <?php
					if(isset($_REQUEST['uploadFile']))
					print "value=" . $_REQUEST['uploadFile'];
					?>><input type="submit" name="preview" value="Preview"/></th>
				</tr>
				<tr>
					<th>
						<input type="radio" name="type" value="blurb" <?php if($bantype === "blurb") print "checked";?> />Only clear blurb<br>
						<input type="radio" name="type" value="reminder" <?php if($bantype === "reminder") print "checked";?> />Reminder<br>
						<input type="radio" name="type" value="warning" <?php if($bantype === "warning") print "checked";?> />Warning<br>
						<input type="radio" name="type" value="1day" <?php if($bantype === "1day") print "checked";?> />1 Day Ban<br>
						<input type="radio" name="type" value="3day" <?php if($bantype === "3day") print "checked";?> />3 Day Ban<br>
						<input type="radio" name="type" value="7day" <?php if($bantype === "7day") print "checked";?> />7 Day Ban<br>
						<input type="radio" name="type" value="14day" <?php if($bantype === "14day") print "checked";?> />14 Day Ban<br>
						<input type="radio" name="type" value="delete" <?php if($bantype === "delete") print "checked";?> />Account Deleted<br>
						<input type="radio" name="type" value="blockreg" <?php if($bantype === "blockreg") print "checked";?> />Block IP<br>
						<font size="2" color="red">Block IP results in permanent account deletion and banning from registration.</font>
					</th>
				</tr>
				<tr>
					<th colspan="2"><input type="submit" value="Moderate" name="accept"/> <input type="submit" value="Cancel" name="delete"/></th>
				</tr>
			<tr>
				<th colspan="2">
					<textarea readonly rows="10" width="100%" style="width: 100%;box-sizing: border-box; resize: none;"><?php
					$user = json_decode(file_get_contents("../passwd/" . $_REQUEST['id'] . ".json"));
					if(array_key_exists("modhs",$user))
					{
						for($i = count($user->modhs)-1; $i >= 0; $i--)
						{
							print "Type: " . $user->modhs[$i]->type . "\r\n";
							print "Moderator: " . $user->modhs[$i]->mod . "\r\n";
							if(trim($user->modhs[$i]->rson) !== "")
							print "Reason: " . $user->modhs[$i]->rson . "\r\n";
							print "Date: " . date("Y-m-d h:i:s A (T)",$user->modhs[$i]->time) . "\r\n\r\n";
						}
					}
					else
					{
						print "Looks like you are clean! Good job!";
					}
				?></textarea>
				</th>
			</tr>
			</table>
			</form>
			
			<?php
			
			
			
			
			if(isset($_POST['content']))
			{
				include("../../AbuseReport/getreports.php");
				popReport($_POST['report'], "../../AbuseReport/reports/reports.json");
				print "Content Reference:<br>";
				print "<textarea readonly name='content' cols='80' rows='10'>";
				print $_POST['content'];
				print "</textarea>";
			}
			?>
		</center>
	</body>
</html>