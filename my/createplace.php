<?php
include('../core/header.php');
if($isloggedin == 'no') {header('location: /login'); exit;}
?>
<?php require '../core/nav.php'; 

if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}

?>
<div id="Body">
	<form action="updategame.php" method="post" enctype="multipart/form-data">
	<div id="EditItemContainer">
		<h2>Configure Place</h2>
		
		<div id="ItemName">
			<span style="font-weight: bold;">Name:</span><br>
			<input name="name" type="text" value="<?php echo $_USER['username']; ?>'s Place" maxlength="35" class="TextBox">
			<span style="color:Red;visibility:hidden;">A Name is Required</span>
		</div>
		<div class="GameThumbnail" style="margin-left: 6.2rem;">
                  <span style="font-weight: bold;">Thumbnail:</span><br>
                  <input type="file" name="thumb" />
		</div>
		<div id="ItemDescription">
			<span style="font-weight: bold;">Description:</span><br>
			<textarea type="text" name="map" maxlength="200" rows="2" cols="20" class="TextBox" style="height:150px;width: 410px;padding: 5px;"></textarea>
		</div>
		<div id="Comments">
			<fieldset title="Max Players">
				<legend>Please Enter IP</legend>
				<div class="Suggestion">
					Enter IP for your game
				</div>
				<div class="EnableCommentsRow" style="padding: 10px 4px 10px 4px;text-align: right;width:auto;">
					<input type="text" name="ip" class="TextBox" min="1" max="20" value=<?php print $_SERVER['REMOTE_ADDR']; ?>>
				</div>
			</fieldset>
		</div>
		<div id="Comments">
			<fieldset title="Max Players">
				<legend>Enter Port</legend>
				<div class="Suggestion">
					Please enter port for your game
				</div>
				<div class="EnableCommentsRow" style="padding: 10px 4px 10px 4px;text-align: right;width:auto;">
					<input type="text" name="port" value="53640" class="TextBox" min="1" max="20">
				</div>
			</fieldset>
		</div>
		<div class="Buttons">
			<input name="updateall" tabindex="4" class="Button" type="submit" value="Create">&nbsp;
			<a id="Cancel" tabindex="5" class="Button" href="/my/home">Cancel</a>
		</div>
	</div>
</form>
</div>