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
		<center><h2>Moderation Logs</h2></center>
		<table border width="99%" bgcolor="#EEEEEE">
		<tr bgcolor="lightsteelblue"><th width="14%" >Time</th><th width="18%">User</th><th width="18%">Moderator</th><th>Comment</th><th>Extra Info</th></tr>
			<?php
				include("../includes/sqldbcon.php");
				$logs = getModLogs();
				for($i = 0; $i < count($logs); $i++)
				{
					print "<tr>";
					print "<td>".nl2br(date("d/m/y\nh:i:sA (T)",$logs[$i]['Time']))."</td><td><a href='../user?id=".$logs[$i]['User']."'>".getUserFromId($logs[$i]['User'])."</a></td><td><a href='../user?id=".$logs[$i]['Moderator']."'>".getUserFromId($logs[$i]['Moderator'])."</a></td><td>".$logs[$i]['Comment']."</td><td>".$logs[$i]['Extinfo']."</td>";
					print "</tr>";
				}
				if(count($logs) < 1)
				{
					print "<tr><td colspan='5'><center>Seems like there is no history!</center></td></tr>";
				}
			?>
		</table>
		</div>
	</body>
</html>