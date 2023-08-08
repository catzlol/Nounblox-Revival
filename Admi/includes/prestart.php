<?php $url = "Admi";

include($_SERVER['DOCUMENT_ROOT']."/core/config.php");

	if($_USER['USER_PERMISSIONS'] == "Administrator"){
		$_MODERATOR = true;
	}else{
		header("Location: /ide/Error.php?id=404");
		die();
	}


$check = mysqli_query($conn, "SELECT * FROM users");                    
$usercount = mysqli_num_rows($check);

$experiencecheck = mysqli_query($conn, "SELECT * FROM games");                    
$experiencecount = mysqli_num_rows($experiencecheck);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="https://www.facebook.com/2008/fbml" class="adminStyle">
	<head>
		<meta https-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
		<title><?=$sitename;?> | Administration</title>
		<link rel="stylesheet" href="/<?=$url;?>/roblox.css" />
		<link rel="stylesheet" href="/<?=$url;?>/roblox1.css" />
		<link rel="stylesheet" href="/<?=$url;?>/Style.css" />
		<link rel="stylesheet" href="/<?=$url;?>/CSS/Admi3.css" />

		<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
		<meta https-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta https-equiv="Content-Language" content="en-us" />
		<meta name="author" content="<?=$company;?>" />

		<link rel="stylesheet" href="/<?=$url;?>/Admin.css" />
		<link rel="stylesheet" href="/<?=$url;?>/Admin2.css" />
	</head>
	<body class="pageStyle">
		<div id="image-retry-data" data-image-retry-max-times="10" data-image-retry-timer="1500"></div>
		<div id="https-retry-data" data-https-retry-max-timeout="8000" data-https-retry-base-timeout="1000"></div>

		<script type="text/javascript">
			if (top.location != self.location) {
				top.location = self.location.href;
			}
		</script>
		<form name="aspnetForm" method="post" action="Thumbs.aspx" id="aspnetForm">
			<div>
				<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
				<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
				<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="" />
				<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="" />
			</div>

			<div>
				<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="38D9001F" />
				<input type="hidden" name="__VIEWSTATEENCRYPTED" id="__VIEWSTATEENCRYPTED" value="" />
				<input
					type="hidden"
					name="__EVENTVALIDATION"
					id="__EVENTVALIDATION"
					value="7NalTW4BTk4skUSx/dH0WRg5S/QEEy9/hIhFPSuw+MiyN0v9vIUHEMecFGjemFq+VikBi5zORaAw84TWAxCbtAkA8ctUj3ZWwK3YSxauoo9MOIazRzyWvj1GwfMVdSjSDKzKNHIDG8yUzEgdt2xIAtpDZ4zwofWImR4zAodmW2XVK5Tt5+G2ZcDqdpCVwDLpVJ9HIS6lj+BJX7Xdvtmstw8TywIFVGrRl+oTmj+sIiY+y9RAX++Nmnab0biL5HR/rG6+yKRPmbN8vUKqIWsMYDrMLAROqVyoaPXx3fP3/hlC7cseLQmWrLddzcobW7k01cjkiqc4TCad8HrZGk018LHjZ6q/vDZKl0JVuUxiL2GarmqdRDg8qDend4v+xjJ30I+0vUxnQYTQ2tmjO5my6qQdJpq7g8FP/8mX1KQSOekUch9sTtioKaWOatNh0s8MxA2eQp+T+t/M9cpcnK94dvvJ9CQDGbkp3BsKIA8fZlw2+sQ3oQ3E0cU+uluhhJhEYwqdXi/Pem8348kmRjpPfKEjQUlFF9Wz/aU5SieObUexvZ0mi05nRQIyJ+tElVDxzlFYgygidhtOpyZ/ir4JSeWaVPQxHycWQBItVR8uFY/pjZ0IS8er9cwSbeEh9pKF3hlBZ4yKG7s3vrJEoiSQwbHQ0CopnfCJZTBbjxVhjyto5VvCm0V6JgWQndDUyz+PV6oog6H8qMmddb3S8d/v73htrhZkyuHYt7tQfZaW9nwus5szn4ozydVoLAvgD3sH9z5bgIfOBjXKprWrkBmA9tV0YaD6CmfJjdqhi4Li0Vd9P9tA88JhGCz4DqHr27pEKgdSeJw/2Rry1rciYmYqwkj3WA80q4wXDESJR5eblmNi9HickRBy3LuxIBSXch7M6t4cgXfkiNJlnVmphPoLWuRTIDVKEIVZ6qJLct5YzICVYUNL"
				/>
			</div>
			<div id="fb-root"></div>
			
			<div id="Container">
				<div id="sidebar">
					<div style="padding-left: 11px">
						<div style="padding-right: 11px; padding-top: 11px">
							<div class="logo_spacer" style="width: auto; height: 50px; padding-right: 4px">
								<a href="/" style="display: block; margin-left: auto; margin-right: auto; width: 106px; height: 28px">
									<img width="106px" height="28px" src="/images/logo-1.png" />
								</a>
							</div>
							<div>
								<div>
									<div><a>Configs</a> | <a>Machines</a>: <b>N/A</b>% of <b>N/A</b></div>
									<div><a>Cores</a>: <b>N/A</b>% in use of <b>N/A</b></div>
									<div><b>N/A</b> running, <b>N/A</b> waiting</div>
									<div>
										<b>N/A</b> <a>players</a> in <b>N/A</b>
										<a href="Games/Default.aspx">games</a>
									</div>
									<div><b>N/A</b> <a href="Thumbs.aspx">thumb requests</a></div>
								</div>
								<div>
									<hr />
									<div>
										<h6><b>N/A</b> <a href="Moderation/Default.aspx">abuse reports</a>,</h6>
										<h6><b>N/A</b> <a href="Moderation/AssetReview.aspx">images</a>,</h6>
										<h6><b>N/A</b> <a>videos</a>,</h6>
										<h6><b><?=$usercount;?></b> <a href="/Admi/Users/ModerateUser.aspx">users</a></h6>
									</div>
									<div><a href="/"><?=$sitename;?></a>, <a href="Users/Find.aspx">FindUser</a></div>
								</div>
							</div>
						</div>
						<div style="padding-right: 2px">
							<hr />
							<div style="padding-right: 6px">
								<div>
									<a>Change Theme</a>
								</div>
								<div><a>RBX1</a> <a>RBX2</a> <a>RBX3</a> <a>OBC1</a> <a>OBC2</a></div>
							</div>
						</div>
						<div class="right" style="padding-right: 10px; width: 100%; text-align: right">
							<a class="highlight">Stop Chat</a>&nbsp;&nbsp;&nbsp; <a class="highlight">Pause Polling</a>
						</div>
					</div>
					<div class="AdminNavigation">
						<div style="border: dotted 1px grey">
							<div id="ctl00_cphRoblox_AdminNavigationTree"></div>
						</div>
					</div>
				</div>

<div style="margin-left: 196px">
<div class="Panel" style="padding-top: 10px; border: none">
<div class="adminContent" style="margin-top: 0; padding-top: 1.6em">

