<?php
include '../core/config.php';
$title = $sitename." - Buy ".$robuxname;
include '../core/header.php';
include '../core/nav.php';
?>
<font face="Verdana">
    <div id="Body" style="border:1px solid black;">
<div id="info" style="position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(100,100,100,0.25);">
    <div style="position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
        <div id="UserBadgesPane" style="width: 400px;">
            <div id="UserBadges">
                <h4><font face="Comic sans MS" size="3"><?=$robuxname;?></font></h4>
                <p style="margin-top: 15px;">This page is just for show and is non-functional</p>
                <p>We are not actually selling any form of membership or currency</p>
                <p>We apologize for any inconvenience</p>
                <div style="margin-bottom: 20px;" id="PurchaseButton">
                    <a class="Button" onclick="document.getElementById('info').hidden = true">OK</a>
                </div>
                <table cellspacing="0" border="0" align="Center"> 
                </table>
            </div>
        </div>
    </div>
</div>
        <div id="JoinBuildersClubNow">
            <a id="RobloxCentralBank" title="<?=$sitename;?> Central Bank" style="display:inline-block;"><img title="<?=$sitename;?> Central Bank" src="/images/RobloxCentralBank.png" border="0"></a>
        </div>
        <div class="StandardBox">
            <div id="ctl00_cphRoblox_BuildersClubContainer" class="BuyRobuxOptions">
                <p style="text-align: center; font-size: large;">Click a link below to choose the quantity of <?=$robuxname;?> you wish to purchase.</p>
                <p style="text-align: center; color: Red;">NOTE: Please allow up to 5 minutes for your account to be credited.</p>
                <div id="OptionsMatrix" style="margin: 10px 0;">
                    <table cellpadding="7" style="margin: 0 auto;">
                        <tbody>
                            <tr>
                                <td align="center"><strong>Price</strong></td>
                                <td align="center"><strong>Standard Members</strong></td>
                                <td align="center"><strong>Builders Club Members</strong></td>
                            </tr>
                            <tr>
                                <td align="center">$2.5 USD</td>
                                <td align="center">
                                    Not Available
                                </td>
                                <td align="center">
                                    450 <?=$robuxname;?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">$5 USD</td>
                                <td align="center">
                                    Not Available
                                </td>
                                <td align="center">
                                    1,000 <?=$robuxname;?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">$12.5 USD</td>
                                <td align="center">
                                    <a id="ctl00_cphRoblox_Tier3StandardHyperLink" href="#" onclick="document.getElementById('info').hidden = false">2,000 <?=$robuxname;?></a>
                                </td>
                                <td align="center">
                                    2,750 <?=$robuxname;?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">$25 USD</td>
                                <td align="center">
                                    <a id="ctl00_cphRoblox_Tier4StandardHyperLink" href="#" onclick="document.getElementById('info').hidden = false">4,500 <?=$robuxname;?></a>
                                </td>
                                <td align="center">
                                    6,000 <?=$robuxname;?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">$50 USD</td>
                                <td align="center">
                                    <a id="ctl00_cphRoblox_Tier5StandardHyperLink" href="#" onclick="document.getElementById('info').hidden = false">10,000 <?=$robuxname;?></a>
                                </td>
                                <td align="center">
                                    15,000 <?=$robuxname;?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">$100 USD</td>
                                <td align="center">
                                    <a id="ctl00_cphRoblox_Tier6StandardHyperLink" href="#" onclick="document.getElementById('info').hidden = false">22,500 <?=$robuxname;?></a>
                                </td>
                                <td align="center">
                                    35,000 <?=$robuxname;?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p style="text-align: center; color: Red;">* For higher quantities, please e-mail us at info@<?=$_SERVER['SERVER_NAME'];?></p>
            </div>
            <div id="ctl00_cphRoblox_rbxGetBCPane_GetBCPanel" class="RightColumnBox">
                <a href="BuildersClub.aspx" style="text-decoration:none; cursor: pointer">
                    <img style="float:left; vertical-align:top; border: none;" src="/images/HardHatBullet.png" width="32px" height="32px">
                    <h1>Builders Club!</h1>
                </a>
                <p style="clear: left">
                    <?=$sitename;?> is free to play, but you can upgrade your account for greater enjoyment.  Take a look at all the fabulous benefits your receive when you join <a href="BuildersClub.aspx">Builders Club</a>!
                </p>
            </div>
        </div>
        <br clear="all">
    </div>
</font>
<?php
include '../core/footer.php';
?>
