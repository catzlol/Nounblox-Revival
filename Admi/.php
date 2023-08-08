<?php
session_start();
include("./includes/prestart.php");
?>
<div style="margin: 1em 0 0 17em; background: ivory; border: 1px solid #333; padding: 1em;">
                
    <div>
        <br>
        User's <a id="ctl00_cphRoblox_UserHomePageHyperLink" href="User.aspx?ID=97067">home page</a><br>
        <br>
        <a href="#ctl00_cphRoblox_ViewMenu_SkipLink"><img alt="Skip Navigation Links" src="/web/20090317200356im_/http://www.roblox.com/WebResource.axd?d=VD_Slylu6hlyEOuc5rdjWw2&amp;t=633527605112930887" width="0" height="0" border="0"></a><table id="ctl00_cphRoblox_ViewMenu" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFBD6">
	<tbody><tr>
		<td onmouseover="Menu_HoverStatic(this)" onmouseout="Menu_Unhover(this)" onkeyup="Menu_Key(event)" id="ctl00_cphRoblox_ViewMenun0"><table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody><tr>
				<td nowrap="nowrap"><a href="javascript:__doPostBack('ctl00$cphRoblox$ViewMenu','0')"><font face="Verdana" color="#990000">Details</font></a></td>
			</tr>
		</tbody></table></td><td width="3"></td><td onmouseover="Menu_HoverStatic(this)" onmouseout="Menu_Unhover(this)" onkeyup="Menu_Key(event)" id="ctl00_cphRoblox_ViewMenun1"><table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFCC66">
			<tbody><tr>
				<td nowrap="nowrap"><a href="javascript:__doPostBack('ctl00$cphRoblox$ViewMenu','1')"><font face="Verdana" color="#990000">Actions</font></a></td>
			</tr>
		</tbody></table></td>
	</tr>
</tbody></table><a id="ctl00_cphRoblox_ViewMenu_SkipLink"></a>
        <br>
        
                <input type="submit" name="ctl00$cphRoblox$PurgeForumPostsButton" value="Purge Forum Posts" id="ctl00_cphRoblox_PurgeForumPostsButton"><br>
                <br>
                Account State override:<br>
                <span id="ctl00_cphRoblox_PunishmentOptionsRadioButtonList"><input id="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_0" type="radio" name="ctl00$cphRoblox$PunishmentOptionsRadioButtonList" value="1" checked="checked"><label for="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_0">None</label><br><input id="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_1" type="radio" name="ctl00$cphRoblox$PunishmentOptionsRadioButtonList" value="2"><label for="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_1">Remind</label><br><input id="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_2" type="radio" name="ctl00$cphRoblox$PunishmentOptionsRadioButtonList" value="3"><label for="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_2">Warn</label><br><input id="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_3" type="radio" name="ctl00$cphRoblox$PunishmentOptionsRadioButtonList" value="4"><label for="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_3">Ban 1 Day</label><br><input id="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_4" type="radio" name="ctl00$cphRoblox$PunishmentOptionsRadioButtonList" value="5"><label for="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_4">Ban 3 Days</label><br><input id="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_5" type="radio" name="ctl00$cphRoblox$PunishmentOptionsRadioButtonList" value="6"><label for="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_5">Ban 7 Days</label><br><input id="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_6" type="radio" name="ctl00$cphRoblox$PunishmentOptionsRadioButtonList" value="7"><label for="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_6">Ban 14 Days</label><br><input id="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_7" type="radio" name="ctl00$cphRoblox$PunishmentOptionsRadioButtonList" value="8"><label for="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_7">Delete</label><br><input id="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_8" type="radio" name="ctl00$cphRoblox$PunishmentOptionsRadioButtonList" value="9"><label for="ctl00_cphRoblox_PunishmentOptionsRadioButtonList_8">Poison</label></span>
                <p>Moderation Note: <input name="ctl00$cphRoblox$AccountStateModerationNoteTextBox" type="text" id="ctl00_cphRoblox_AccountStateModerationNoteTextBox"></p>
                <p>Message to User: <input name="ctl00$cphRoblox$AccountStateMessageToUserTextBox" type="text" id="ctl00_cphRoblox_AccountStateMessageToUserTextBox"></p>
                <input type="submit" name="ctl00$cphRoblox$OverrideAccountStateButton" value="Submit" id="ctl00_cphRoblox_OverrideAccountStateButton"><br>
                <br>
                
                <div>
	<table id="ctl00_cphRoblox_UserPunishmentsGridView" cellspacing="0" cellpadding="4" border="0" bgcolor="White">
		<tbody><tr>
			<td colspan="5"><font color="#333333">
                        There are no punishments against this user.
                    </font></td>
		</tr>
	</tbody></table>
</div>
            
        <br>
    </div>

            </div>