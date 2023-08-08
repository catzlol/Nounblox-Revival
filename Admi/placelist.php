<?php
session_start();
include("./includes/prestart.php");
?>

<html>
	<head>
	<link rel="stylesheet" type="text/css" href="topbar.css">
	<style>
	@media print
	{    
	    .no-print, .no-print *
	    {
	        display: none !important;
	    }
	    .print-full, .print-full *
	    {
			width: 100% !important;
			clear: both !important;
		}
	}
	</style>
	</head>

	<body bgcolor="#DDDDDD" style="margin: 0px; padding: 0px;font-family: 'Verdana';">
		<div style="background-color:#EEEEEE; border-right: outset 2px #EEEEEE; width: 15%; height: 100%; padding-left: 5px; padding-top: 5px; float: left;" class="no-print">
			<?php
				include("./includes/sidebar.php");
			?>
		</div>
		<div style="width: 84%; float: right; margin-top: 10px;" class="print-full" >
		<center><h2>Unmoderated Places</h2></center>
		<table border width="99%" bgcolor="#EEEEEE">
		<tr bgcolor="lightsteelblue"><th width="50%" >Place</th><th width="50%">PlaceCreator</th></tr>
			<?php
				include("../includes/sqldbcon.php");
				$sql = "SELECT * FROM places WHERE ModStatus = 'unmoderated'";
				$result = $GLOBALS['db']->query($sql);
				if($result)
				{
					while($row = $result->fetch_assoc()){
				    	echo "<tr><td><a href='../place?id=".$row['PlaceID']."'>".$row['PlaceName']."</a></td>";
				    	echo "<td><a href='../user?id=".$row['UserID']."'>".getUserFromId($row['UserID'])."</a></td></tr>";
					}
				}
			?>
		</table>
		</div>
	</body>
</html>