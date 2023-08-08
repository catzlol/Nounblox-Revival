<?php
include '../core/config.php';
$title = $sitename.' Download';
include '../core/header.php';
include '../core/nav.php';
if($_POST["ButtonDownload"]){header("Location: ".$clientdownloadlink);}

if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}
?>
<style>.Navigation{display:none!important;}#Alerts{display:none!important;}#Authentication{display:none!important;}#Settings{display:none!important;}</style>

<div id="Body">
					
    
    
    <div>
        
        
        
        
    </div>
    
    <p id="ctl00_cphRoblox_SystemRequirements1_OS" align="center" style="color: red">Currently, <?=$sitename;?> is only available on PCs running the Windows&reg; operating system</p>

    <div style="margin-top: 12px; margin-bottom: 12px">
        <div id="AlreadyInstalled" style="display: none">
            <p><?=$sitename;?> is already installed on this computer. If you want to try installing it again then follow the instructions below. Otherwise, you can just <a href="javascript:goBack()">continue</a>.</p>
        </div>
        <img id="ctl00_cphRoblox_Image3" class="Bullet" src="/images/bullet1V2.png" border="0"/>
        <div id="InstallStep1" style="padding-left: 60px">
            <h2>Download <?=$sitename;?></h2>
            <p><form action="" method="POST"><input type="submit" name="ButtonDownload" value="Install <?=$sitename;?>" id="ctl00_cphRoblox_ButtonDownload" class="BigButton"/>&nbsp;(Total download about 10Mb)</form></p>
        </div>
        <img id="ctl00_cphRoblox_Image4" class="Bullet" src="/images/bullet2V2.png" border="0"/>
        <div id="InstallStep2" style="padding-left: 60px">
            <h2>Run the Installer</h2>
            <p>A window will open asking what you want to do with a file called Setup.exe.</p>
            <p>Click 'Run'. You might see a confirmation message, asking if you're sure you want to run this software. Click 'Run' again.</p>
            <p><img id="ctl00_cphRoblox_Image1" src="/images/Install/DownloadPrompt.PNG" border="0"/></p>
        </div>
        <img id="ctl00_cphRoblox_Image5" class="Bullet" src="/images/bullet3V3.png" border="0"/>
        <div id="InstallStep3" style="padding-left: 60px">
            <h2>Follow the Setup Wizard</h2>
            <p>When the download has finished, the <?=$sitename;?> Setup Wizard will appear and guide you through the rest of the installation.</p>
            <p><img id="ctl00_cphRoblox_Image2" src="/images/Install/Good.png" border="0"/></p>
        </div>
    </div>

    <script type="text/javascript">
        function isInstalled()
        {
		    try
		    { 
			    var robloxClient = new ActiveXObject("RobloxInstall.Updater"); 
			    return true;
		    }
		    catch (e)
		    { 
		        return false;
		    } 
        }
        function goBack()
        {
 		    window.history.back();
        }
		function checkInstall() 
		{ 
			if (isInstalled())
			{ 
				// If we didn't fail, then we can move on
				document.getElementById("ctl00_cphRoblox_ButtonDownload").disabled = true;
				urchinTracker("InstallSuccess");
                Roblox.Install.Service.InstallSucceeded();
				goBack();
			}
			else
			{
				// Try again later 
				window.setTimeout("checkInstall()", 2000); 
			} 
		} 
    </script>
    <script type="text/javascript">
		if (isInstalled())
		{
		    AlreadyInstalled.style.display="block";
		}
		else
		{
		    window.setTimeout("checkInstall()", 1000);
		}
    </script>

				</div>

<?
include '../core/footer.php';
?>